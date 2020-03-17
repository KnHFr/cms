<?php

namespace App\Controller;

use App\Service\Parameter;
use App\Entity\Parameter\Title;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(Parameter $parameter)
    {
        $titleData = new Title();
        $titleData->title = $parameter->get("title");
        return $this->render('main/index.html.twig', [
            'title' => $titleData,
            'controller_name' => 'MainController',
        ]);
    }
}
