<?php

namespace App\Controller\Music;

use App\Repository\Music\MusicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusicController extends AbstractController
{
    #[Route('/music/{publicIdentifier}', name: 'app_music')]
    public function index(Request $request, MusicRepository $musicRepository): Response
    {
        $music = $musicRepository->findOneBy(['publicIdentifier' => $request->get('publicIdentifier')]);

        return $this->render('music/index.html.twig', [
            'music' => $music,
        ]);
    }
}
