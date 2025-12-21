<?php

namespace App\Controller;

use App\Repository\LinkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')]
    public function index(LinkRepository $linkRepository): Response
    {
        $links = $linkRepository->getLast(3);

        return $this->render('home_page/index.html.twig', [
            'controller_name' => 'HomePageController',
            'links' => $links,
        ]);
    }
}
