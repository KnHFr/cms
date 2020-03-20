<?php

namespace App\Controller\Backend;

use App\Entity\Article;
use App\Entity\Picture;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

/**
 * @Route("/backend/article", name="backend_")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="article_index", methods={"GET"})
     */
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="article_new", methods={"GET","POST"})
     */
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $picture =  $form->get('picturePath')->getData();
            $originalImagename = pathinfo($picture->getClientOriginalName(), PATHINFO_FILENAME);
            $safeImagename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalImagename);
            $newImageName = $safeImagename.'-'.uniqid().'.'.$picture->guessExtension();
            $picture->move(
                $this->getParameter('upload_picture_directory'),
                $newImageName
            );
            $article->setPicturePath($newImageName);

            // parcours $picturefiles
            // si pas d'image envoyé, on garde les images précédentes
            $images = $form->get('pictures')->getData();
            // dd($image);
                //on parcours le tableau $image, pour chaque on transforme son nom
            foreach($images as $i)
            {
                if ($i) {
                $originalImagename = pathinfo($i->getClientOriginalName(), PATHINFO_FILENAME);
                $safeImagename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalImagename);
                $newImagename = $safeImagename.'-'.uniqid().'.'.$i->guessExtension();
                //on déplace le fichier dans le bon dossier
                    try {
                        $i->move(
                        $this->getParameter('upload_picture_directory'), $newImagename
                        );
                        //
                // dd($event->picturefiles);
                        //creation d'une nouvelle image avec toutes ses données
                        $picture = new Picture();
                        $picture->setPath($newImagename);
                        $picture->setArticle($article);
                        $em->persist($picture);
                        // dd($picture);
                        //on enregistre le nom dans event
                        $article->addPicture($picture);
                        
                
                        } catch (FileException $e) {

                        }
                }
            }
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash(
                'confirmation',
                "L'Article' à été sauvegardé"
            );

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            return $this->redirectToRoute('backend_article_index');
        }

        return $this->render('article/new.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_show", methods={"GET"})
     */
    public function show(Article $article): Response
    {
        return $this->render('article/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="article_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('backend_article_index');
        }

        return $this->render('article/edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="article_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Article $article): Response
    {
        if ($this->isCsrfTokenValid('delete'.$article->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($article);
            $entityManager->flush();
        }

        return $this->redirectToRoute('backend_article_index');
    }
}
