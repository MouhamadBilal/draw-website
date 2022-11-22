<?php

namespace App\Controller;

use App\Repository\DrawRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Draw;
use App\Form\DrawFormType;
use Doctrine\ORM;
use Doctrine\ORM\EntityManagerInterface;

use Twig\Environment;

class DrawController extends AbstractController
{

    private EntityManagerInterface $entityManager;
    private Environment $twig;
    public function __construct(Environment $twig, EntityManagerInterface $entityManager )
    {
        $this->entityManager = $entityManager;
        $this->twig= $twig;
    }

    #[Route('/draw', name: 'app_draw')]
    public function index(Environment $twig, Request $request ): Response
    {

        $draw = new Draw();
        $form = $this->createForm(DrawFormType::class, $draw);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->entityManager->persist($draw);
            $this->entityManager->flush();

            return $this->redirectToRoute('/draw');
        }

        return new Response($twig->render('draw/index.html.twig', [
            'draw' => $draw,
            'controller_name' => 'Draw-Website',
            'draw_form' => $form->createView()
        ]));



    }

}
