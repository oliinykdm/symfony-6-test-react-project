<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontPageController extends AbstractController
{
   /**
    * @Route("/{reactRouting}", name="home", defaults={"reactRouting": null})
    */
    public function index(): Response
    {
        return $this->render('shortmessages/frontpage.html.twig');
    }
}