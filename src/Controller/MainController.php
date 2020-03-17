<?php

namespace App\Controller;

use App\Service\Parameter;
// use App\Entity\Parameter\H1;
// use App\Entity\Parameter\Title;
// use App\Entity\Parameter\Header;
// use App\Entity\Parameter\PresentationText;
use App\Entity\Parameter\Head;
use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(Parameter $parameter, ArticleRepository $articleRepository)
    {
        // $titleData = new Title();
        // $titleData->title = $parameter->get('title');

        // $headerData = new Header();
        // $headerData->headerPicture = $parameter->get('headerPicture');

        // $h1Data = new H1();
        // $h1Data->h1 = $parameter->get('h1');

        // $presentationTextData = new PresentationText();
        // $presentationTextData->presentationText = $parameter->get('presentationText'); 
        
        $headData = new Head();
        $headData->title = $parameter->get('title');
        $headData->headerPicture = $parameter->get('headerPicture');
        $headData->h1 = $parameter->get('h1');
        $headData->presentationText = $parameter->get('presentationText');


        return $this->render('main/index.html.twig', [
            'title' => $headData->title,
            'header' => $headData->headerPicture,
            'h1' => $headData->h1,
            'presentationText' => $headData->presentationText,
            'articles' => $articleRepository->findAll()
        ]);
    }
}
