<?php

namespace App\Controller\Backend;

use App\Service\Parameter;
use App\Entity\Parameter\Title;
use App\Form\TitleType;
use App\Repository\ParameterRepository;
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
    public function Title(Parameter $parameter, ParameterRepository $parameterRepository, Request $request, EntityManagerInterface $em)
    {
        $titleData = new Title();
        //on recupere les données existante
        $titleData->title = $parameter->get("title");
        //creation du formulaire
        $form = $this->createForm(TitleType::class, $titleData);
        $form->handleRequest($request);
        //si valid, on set les données du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $parameter->set("title", $titleData->title);

            $em->flush();
            //flash confirmation de sauvegarde
            $this->addFlash(
                'confirmation',
                "Le titre à été sauvegardé."
            );
            return $this->redirectToRoute('backend_parameter_title');
        };
        return $this->render('backend/parameter/index.html.twig', [
            'title' => $titleData,
            'titleForm' => $form->createView()
        ]);
    }
}
