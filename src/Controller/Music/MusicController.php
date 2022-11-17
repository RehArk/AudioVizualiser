<?php

namespace App\Controller\Music;

use App\Repository\Music\MusicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusicController extends AbstractController
{

    #[Route('/music/page-{page}', name: 'app_music')]
    public function index(Request $request, MusicRepository $musicRepository): Response
    {

        $musicName = $request->request->get('musicName') ?? "";
        
        $totalMusic = $musicRepository->countNameLike($musicName);
        $musicPerPage = 10;
        $numberOfPage = (int)($totalMusic / $musicPerPage) + ($totalMusic % $musicPerPage != 0 ? 1 : 0);
        
        if(
            $request->attributes->get('page') < 0 ||
            $request->attributes->get('page') > $numberOfPage
        ) {
            $request->attributes->set('page', 1);
        }
            
        $curentPage = $request->attributes->get('page');
        $offset = ($curentPage - 1) * $musicPerPage;

        return $this->render('music/index.html.twig', [
            'app_name' => 'AudioVizualiser',
            'musics' => $musicRepository->findNameWithLimit($musicName, $musicPerPage, $offset),
            'numberOfPage' => $numberOfPage
        ]);
    }

    #[Route('/music/{publicIdentifier}', name: 'app_music_display')]
    public function displayMusic(Request $request, MusicRepository $musicRepository): Response
    {
        $music = $musicRepository->findOneBy(['publicIdentifier' => $request->get('publicIdentifier')]);

        return $this->render('music/displayMusic.html.twig', [
            'music' => $music,
        ]);
    }
}
