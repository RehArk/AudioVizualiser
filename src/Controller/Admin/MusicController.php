<?php

namespace App\Controller\Admin;

use App\Entity\Music;
use App\Entity\MusicStyle;
use App\Form\Music\MusicFormType;
use App\Repository\Music\MusicRepository;
use App\Repository\Music\MusicStyleRepository;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MusicController extends AbstractController
{

    private function getUplaoadDir(Request $request) :string {
        return $request->server->get("DOCUMENT_ROOT").'file';
    }

    #[Route('/admin/music/page-{page}', name: 'app_admin_music')]
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

        return $this->render('admin/music/indexMusic.html.twig', [
            'page_name' => 'Musique',
            'musics' => $musicRepository->findNameWithLimit($musicName, $musicPerPage, $offset),
            'numberOfPage' => $numberOfPage
        ]);
    }

    #[Route('/admin/music/add', name: 'app_admin_music_add')]
    public function addMusic(
        Request $request, 
        EntityManagerInterface $manager, 
        FileUploader $fileUploader,
        MusicStyleRepository $musicStyleRepository): Response
    {

        $music = new Music();
        $form = $this->createForm(MusicFormType::class);
        $form->handleRequest($request);

        
        
        if ($form->isSubmitted() && $form->isValid()) {

            $musicStyles = $musicStyleRepository->findManyByIds(
                $form->get('music_styles')->getData()
            );


            $file = $form->get('file')->getData();
            $fileUploader->setTargetDirectory($this->getUplaoadDir($request));
            $fileName = $fileUploader->upload($file);

            $currentDate = new \DateTime();
            $publicIdentifier = $currentDate->format('YmdHis');

            $music->setName($form->get('name')->getData());
            $music->setPublicIdentifier($publicIdentifier);
            $music->setFile($fileName);
            $music->setMusicStyles($musicStyles);

            $manager->persist($music);
            $manager->flush();
        
            return $this->redirectToRoute('app_admin_music', ['page' => 1]);
        }

        return $this->render('admin/music/addMusic.html.twig', [
            'page_name' => 'MusicController',
            'form' => $form->createView()
        ]);
    }

    #[Route('/admin/music/delete/{id}', name: 'app_admin_music_delete')]
    public function deleteMusic(Request $request, EntityManagerInterface $manager, FileUploader $fileUploader): Response
    {
        $music = $manager->getRepository(Music::class)->find($request->attributes->get('id'));

        $fileUploader->removeUpload($this->getUplaoadDir($request), $music->getFile().'.mp3');

        $manager->remove($music);
        $manager->flush();

        return $this->redirectToRoute('app_admin_music', ['page' => 1]);
    }
}
