<?php

namespace App\Controller\Parameter;

use App\Entity\Parameter\Parameter;
use App\Form\Parameter\ParameterType;
use App\Repository\ParameterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/parameter/parameter")
 */
class ParameterController extends AbstractController
{
    /**
     * @Route("/", name="parameter_parameter_index", methods={"GET"})
     */
    public function index(ParameterRepository $parameterRepository): Response
    {
        return $this->render('parameter/parameter/index.html.twig', [
            'parameters' => $parameterRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="parameter_parameter_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $parameter = new Parameter();
        $form = $this->createForm(ParameterType::class, $parameter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($parameter);
            $entityManager->flush();

            return $this->redirectToRoute('parameter_parameter_index');
        }

        return $this->render('parameter/parameter/new.html.twig', [
            'parameter' => $parameter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parameter_parameter_show", methods={"GET"})
     */
    public function show(Parameter $parameter): Response
    {
        return $this->render('parameter/parameter/show.html.twig', [
            'parameter' => $parameter,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="parameter_parameter_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Parameter $parameter): Response
    {
        $form = $this->createForm(ParameterType::class, $parameter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('parameter_parameter_index');
        }

        return $this->render('parameter/parameter/edit.html.twig', [
            'parameter' => $parameter,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="parameter_parameter_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Parameter $parameter): Response
    {
        if ($this->isCsrfTokenValid('delete'.$parameter->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($parameter);
            $entityManager->flush();
        }

        return $this->redirectToRoute('parameter_parameter_index');
    }
}
