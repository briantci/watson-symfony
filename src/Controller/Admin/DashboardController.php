<?php

namespace App\Controller\Admin;

use App\Repository\LinkRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
final class DashboardController extends AbstractController
{
    #[Route('/admin/dashboard', name: 'app_admin_dashboard')]
    public function index(
        LinkRepository $linkRepository,
        UserRepository $userRepository
    ): Response
    {
        return $this->render('admin/dashboard/index.html.twig', [
            'links' => $linkRepository->findAll(),
            'users' => $userRepository->findAll(),
        ]);
    }
}
