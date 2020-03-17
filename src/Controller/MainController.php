<?php

namespace App\Controller;

use App\Service\Parameter;
use App\Entity\Parameter\H1;
use App\Entity\Parameter\Title;
use App\Entity\Parameter\Header;
use App\Entity\Parameter\PresentationText;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(Parameter $parameter)
    {
        $titleData = new Title();
        $titleData->title = $parameter->get('title');

        $headerData = new Header();
        $headerData->headerPicture = $parameter->get('headerPicture');

        $h1Data = new H1();
        $h1Data->h1 = $parameter->get('h1');

        $presentationTextData = new PresentationText();
        $presentationTextData->presentationText = $parameter->get('presentationText');
        return $this->render('main/index.html.twig', [
            'title' => $titleData,
            'header' => $headerData,
            'h1' => $h1Data,
            'presentationText' => $presentationTextData,
            'controller_name' => 'MainController',
        ]);
    }
}
