<?php

namespace App\Controller;

use App\Service\Parameter;
use App\Entity\Parameter\Foot;
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
        $headData = new Head();
        $headData->title = $parameter->get('title');
        $headData->headerPicture = $parameter->get('headerPicture');
        $headData->h1 = $parameter->get('h1');
        $headData->presentationText = $parameter->get('presentationText');

        $footData = new Foot();
        $footData->contact = $parameter->get('contact');
        $footData->socialNetwork = $parameter->get('socialNetwork');
        $footData->aboutUs = $parameter->get('aboutUs');
        $footData->aboutF = $parameter->get('aboutF');


        return $this->render('main/index.html.twig', [
            'title' => $headData->title,
            'header' => $headData->headerPicture,
            'h1' => $headData->h1,
            'presentationText' => $headData->presentationText,
            'articles' => $articleRepository->findAll(),
            'contact' => $footData->contact,
            'socialNetwork' => $footData->socialNetwork,
            'aboutUs' => $footData->aboutUs,
            'aboutF' => $footData->aboutF
        ]);
    }
}
