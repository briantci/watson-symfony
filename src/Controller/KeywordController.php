<?php

namespace App\Controller;

use App\Entity\Keyword;
use App\Form\KeywordType;
use App\Repository\KeywordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/keyword')]
final class KeywordController extends AbstractController
{
    #[Route(name: 'app_keyword_index', methods: ['GET'])]
    public function index(KeywordRepository $keywordRepository): Response
    {
        return $this->render('keyword/index.html.twig', [
            'keywords' => $keywordRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_keyword_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $keyword = new Keyword();
        $form = $this->createForm(KeywordType::class, $keyword);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($keyword);
            $entityManager->flush();

            return $this->redirectToRoute('app_keyword_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('keyword/new.html.twig', [
            'keyword' => $keyword,
            'form' => $form,
        ]);
    }
}
