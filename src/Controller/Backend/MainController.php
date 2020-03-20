<?php

namespace App\Controller\Backend;

use App\Repository\ParameterRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/backend", name="backend")
 */
class MainController extends AbstractController
{
    /**
     * @Route("/", name="backend")
     */
    public function index(ParameterRepository $parameterRepository)
    {
        return $this->render('backend/index.html.twig', [
            'parameters' => $parameterRepository->findAll(),
        ]);
    }

    public function navBackend()
    {
        return $this->render('/backend/nav_backend.html.twig');
    }
}