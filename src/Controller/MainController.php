<?php

namespace App\Controller;

use App\Repository\Music\MusicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(MusicRepository $musicRepository): Response
    {
        return $this->render('main/index.html.twig', [
            'app_name' => 'AudioVizualiser',
            'musics' => $musicRepository->findWithLimit(10)
        ]);
    }
}
