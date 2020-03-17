<?php

namespace App\Controller\Backend;

use App\Form\H1Type;
use App\Form\TitleType;
use App\Service\Parameter;
use App\Entity\Parameter\H1;
use App\Entity\Parameter\Title;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/backend/parameter", name="backend_parameter_")
 */
class ParameterController extends AbstractController
{
    /**
     * @Route("/", name="parameter")
     */
    public function index()
    {
        return $this->render('parameter/index.html.twig', [
            'controller_name' => 'ParameterController',
        ]);
    }

    /**
     * @Route("/title", name="title")
     */
    public function Title(Parameter $parameter, Request $request, EntityManagerInterface $em)
    {
        $titleData = new Title();
        //on recupere les données existante
        $titleData->title = $parameter->get('title');
        //creation du formulaire
        $form = $this->createForm(TitleType::class, $titleData);
        $form->handleRequest($request);
        //si valid, on set les données du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $parameter->set('title', $titleData->title);

            $em->flush();
            //flash confirmation de sauvegarde
            $this->addFlash(
                'confirmation',
                "Le titre de l'onglet de page à été sauvegardé."
            );
            return $this->redirectToRoute('backend_parameter_title');
        };
        return $this->render('backend/parameter/title.html.twig', [
            'title' => $titleData,
            'titleForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/h1", name="h1")
     */
    public function H1(Parameter $parameter, Request $request, EntityManagerInterface $em)
    {
        $h1Data = new H1();
        //on recupere les données existante
        $h1Data->h1 = $parameter->get('h1');
        //creation du formulaire
        $form = $this->createForm(H1Type::class, $h1Data);
        $form->handleRequest($request);
        //si valid, on set les données du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $parameter->set("h1", $h1Data->h1);

            $em->flush();
            //flash confirmation de sauvegarde
            $this->addFlash(
                'confirmation',
                "Le titre h1 à été sauvegardé."
            );
            return $this->redirectToRoute('backend_parameter_h1');
        };
        return $this->render('backend/parameter/h1.html.twig', [
            'h1' => $h1Data,
            'h1Form' => $form->createView()
        ]);
    }
}
