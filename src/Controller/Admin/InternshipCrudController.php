<?php

namespace App\Controller\Admin;

use App\Entity\Internship;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Vich\UploaderBundle\Form\Type\VichImageType;

#[IsGranted('ROLE_ADMIN')]
class InternshipCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Internship::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre du stage'),

            TextareaField::new('description', 'Description')->setHelp('Ajoutez une description détaillée'),

            DateTimeField::new('date_start', 'Date de début'),

            DateTimeField::new('date_end', 'Date de fin'),

            TextField::new('main_image_file_internship', 'Image principale du stage')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                    'download_uri' => false,
                    'image_uri' => true,
                    'asset_helper' => true,
                ]),

            TextField::new('image_first_file_internship', 'Première image du stage')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                    'download_uri' => false,
                    'image_uri' => true,
                    'asset_helper' => true,
                ])
                ->hideOnIndex(),

            TextField::new('image_second_file_internship', 'Deuxième image du stage')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                    'download_uri' => false,
                    'image_uri' => true,
                    'asset_helper' => true,
                ])
                ->hideOnIndex(),

            TextField::new('image_third_file_internship', 'Troisième image du stage')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                    'download_uri' => false,
                    'image_uri' => true,
                    'asset_helper' => true,
                ])
                ->hideOnIndex(),
            
            DateTimeField::new('updated_at', 'Date de mise à jour')
                ->hideOnForm()
                ->setFormTypeOption('disabled', true),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Internship) return;

        if (!$entityInstance->getUpdatedAt()) {
            $entityInstance->setUpdatedAt(new \DateTimeImmutable());
        }

        $entityManager->persist($entityInstance);
        $entityManager->flush();
    }

    public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        $this->persistEntity($entityManager, $entityInstance);
    }
}
