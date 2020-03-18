<?php

namespace App\Controller\Backend;

use App\Service\Parameter;
use App\Entity\Parameter\Foot;
use App\Entity\Parameter\Head;
use App\Form\Parameter\FootType;
use App\Form\Parameter\HeadType;
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
    public function index(ParameterRepository $parameterRepository)
    {
        return $this->render('backend/parameter/index.html.twig', [
            'parameters' => $parameterRepository->findAll(),
        ]);
    }

    /**
     * @Route("/head", name="head")
     */
    public function Head(Parameter $parameter, Request $request, EntityManagerInterface $em)
    {
        $headData = new Head();
        //on recupere les données existante
        $headData->title = $parameter->get('title');
        $headData->headerPicture = $parameter->get('headerPicture');
        $headData->h1 = $parameter->get('h1');
        $headData->presentationText = $parameter->get('presentationText');
        //creation du formulaire
        $form = $this->createForm(HeadType::class, $headData);
        $form->handleRequest($request);
        //si valid, on set les données du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $parameter->set("title", $headData->title);
            $parameter->set("headerPicture", $headData->headerPicture);
            $parameter->set("h1", $headData->h1);
            $parameter->set("presentationText", $headData->presentationText);

            $em->flush();
            //flash confirmation de sauvegarde
            $this->addFlash(
                'confirmation',
                "Le head à été sauvegardé."
            );
            return $this->redirectToRoute('backend_parameter_head');
        };
        return $this->render('backend/parameter/head.html.twig', [
            'head' => $headData,
            'headForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/foot", name="foot")
     */
    public function Foot(Parameter $parameter, Request $request, EntityManagerInterface $em)
    {
        $footData = new Foot();
        //on recupere les données existante
        $footData->contact = $parameter->get('contact');
        $footData->socialNetwork = $parameter->get('socialNetwork');
        $footData->aboutUs = $parameter->get('aboutUs');
        $footData->aboutF = $parameter->get('aboutF');
        //creation du formulaire
        $form = $this->createForm(FootType::class, $footData);
        $form->handleRequest($request);
        //si valid, on set les données du formulaire
        if ($form->isSubmitted() && $form->isValid()) {
            $parameter->set("contact", $footData->contact);
            $parameter->set("socialNetwork", $footData->socialNetwork);
            $parameter->set("aboutUs", $footData->aboutUs);
            $parameter->set("aboutF", $footData->aboutF);

            $em->flush();
            //flash confirmation de sauvegarde
            $this->addFlash(
                'confirmation',
                "Le Foot à été sauvegardé."
            );
            return $this->redirectToRoute('backend_parameter_foot');
        };
        return $this->render('backend/parameter/foot.html.twig', [
            'foot' => $footData,
            'footForm' => $form->createView()
        ]);
    }
}