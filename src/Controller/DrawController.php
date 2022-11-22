<?php

namespace App\Controller;

use App\Repository\DrawRepository;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Draw;
use App\Form\DrawFormType;
use Doctrine\ORM;

use Twig\Environment;

class DrawController extends AbstractController
{
    #[Route('/draw', name: 'app_draw')]
    public function index(Environment $twig ): Response
    {



        $draw = new Draw();
        $form = $this->createForm(DrawFormType::class, $draw);

        return new Response($twig->render('draw/index.html.twig', [
            'draw' => $draw,
            'controller_name' => 'Draw-Website',
            'draw_form' => $form->createView()
        ]));

    }

}
