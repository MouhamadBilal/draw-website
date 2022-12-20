<?php

namespace App\Controller;

use App\Repository\DrawRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Draw;
use App\Form\DrawFormType;
use Doctrine\ORM\EntityManagerInterface;


use Twig\Environment;

class DrawController extends AbstractController
{

    private EntityManagerInterface $entityManager;
    private Environment $twig;

    public function __construct(Environment $twig, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->twig = $twig;
    }

    #[Route('/draw', name: 'app_draw')]
    public function index(Environment $twig, Request $request, string $drawDir): Response
    {
        $draw = new Draw();
        $form = $this->createForm(DrawFormType::class, $draw);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $draw->setPost($draw);
            if ($drawing = $form['post']->getData()) {
                $post = bin2hex(random_bytes(6)) . '.' . $drawing->guessExtension();
                try {
                    $drawing->move($drawDir, $post);

                } catch (fileException $e) {
                    //unable to upload your draw
                }

                $draw->setPost($post);
            }

            $this->entityManager->persist($draw);
            $this->entityManager->flush();

            return $this->redirectToRoute('published_draws');
        }

        return new Response($twig->render('draw/index.html.twig', [
            'draw' => $draw,
            'controller_name' => 'Draw-Website',
            'draw_form' => $form->createView(),
        ]));
    }

    #[Route('/', name: 'published_draws')]
    public function listPublishedDraws(Environment $twig, DrawRepository $drawRepository)
    {
        $draws = $drawRepository->findAll();
        return new Response($twig->render('draw/show.html.twig', [
            'draws' => $draws
        ]));
    }

}
