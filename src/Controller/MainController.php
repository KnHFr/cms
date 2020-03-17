<?php

namespace App\Controller;

use App\Service\Parameter;
use App\Entity\Parameter\H1;
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
        $titleData->title = $parameter->get('title');

        $h1Data = new H1();
        $h1Data->h1 = $parameter->get('h1');
        return $this->render('main/index.html.twig', [
            'h1' => $h1Data,
            'title' => $titleData,
            'controller_name' => 'MainController',
        ]);
    }
}
