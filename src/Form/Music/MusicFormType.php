<?php

// src/Form/Type/Music.php
namespace App\Form\Music;

use App\Entity\MusicStyle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File as ConstraintsFile;
use Symfony\Component\Validator\Constraints\NotBlank;

class MusicFormType extends AbstractType
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $musicStyleRepository = $this->entityManager->getRepository(MusicStyle::class);

        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez nommer la musique.',
                    ])
                ],
            ])
            ->add('file', FileType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez lié un fichier.',
                    ]),
                    new ConstraintsFile([
                        'maxSize' => '8192k',
                        'mimeTypes' => [
                            'audio/mpeg'
                        ],
                        'mimeTypesMessage' => 'Vous devez uplaod un fichier MP3 de max 8mo',
                    ])
                ],
            ])
            ->add('music_styles', ChoiceType::class, [
                'choices' => array_flip($this->musicStyle($musicStyleRepository)),
                'expanded' => true,
                'multiple'=>'true',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Vous devez choisir le/les type(s) de musique.',
                    ])
                ],
            ])
        ;

    }

    public function musicStyle($musicStyleRepository) {
        $style = [];
        foreach($musicStyleRepository->findAll() as $key => $value) {
            $styles[$value->getId()] = $value->getName();
        }
        return $styles;
    }
}