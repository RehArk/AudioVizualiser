<?php

namespace App\Controller\Admin;

use App\Entity\MusicStyle;
use App\Form\Music\MusicStyleFormType;
use App\Repository\Music\MusicStyleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusicStyleController extends AbstractController
{
    #[Route('/admin/music-style/page-{page}', name: 'app_admin_music_style')]
    public function index(Request $request, MusicStyleRepository $musicRepository): Response
    {
        $musicStyleName = $request->request->get('musicStyleName') ?? "";
        
        $totalMusicStyle = $musicRepository->countStyleNameLike($musicStyleName);
        $musicStylePerPage = 10;
        $numberOfPage = (int)($totalMusicStyle / $musicStylePerPage) + ($totalMusicStyle % $musicStylePerPage != 0 ? 1 : 0);
        
        if(
            $request->attributes->get('page') < 0 ||
            $request->attributes->get('page') > $numberOfPage
        ) {
            $request->attributes->set('page', 1);
        }
            
        $curentPage = $request->attributes->get('page');
        $offset = ($curentPage - 1) * $musicStylePerPage;

        return $this->render('admin/music/indexStyle.html.twig', [
            'page_name' => 'Style de musique',
            'musicsStyle' => $musicRepository->findStyleNameWithLimit($musicStyleName, $musicStylePerPage, $offset),
            'numberOfPage' => $numberOfPage
        ]);
    }

    #[Route('/admin/music-style/add', name: 'app_admin_music_style_add')]
    public function addMusicStyle(Request $request, EntityManagerInterface $manager): Response
    {

        $musicStyle = new MusicStyle();

        $form = $this->createForm(MusicStyleFormType::class, $musicStyle);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) { 
            $manager->persist($musicStyle);
            $manager->flush();
        
            return $this->redirectToRoute('app_admin_music_style', ['page' => 1]);
        }

        return $this->render('admin/music/addStyle.html.twig', [
            'page_name' => 'MusicController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/music-style/delete/{id}', name: 'app_admin_music_style_delete')]
    public function deleteMusicStyle(Request $request, EntityManagerInterface $manager): Response
    {

        $musicStyle = $manager->getRepository(MusicStyle::class)->find($request->attributes->get('id'));        
        $manager->remove($musicStyle);
        $manager->flush();

        return $this->redirectToRoute('app_admin_music_style', ['page' => 1]);
    }
}
