<?php

namespace App\Controller\Admin;

use App\Entity\Accessories;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Vich\UploaderBundle\Form\Type\VichImageType;

#[IsGranted('ROLE_ADMIN')]
class AccessoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Accessories::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre de l\'accessoire'),

            TextareaField::new('description', 'Description')->setHelp('Ajoutez une description détaillée'),

            TextField::new('main_image_file_accessories', 'Image principale de l\'accessoire')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                    'download_uri' => false,
                    'image_uri' => true,
                    'asset_helper' => true,
                ]),

            TextField::new('image_first_file_accessories', 'Première image de l\'accessoire')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                    'download_uri' => false,
                    'image_uri' => true,
                    'asset_helper' => true,
                ])
                ->hideOnIndex(),

            TextField::new('image_second_file_accessories', 'Deuxième image de l\'accessoire')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                    'download_uri' => false,
                    'image_uri' => true,
                    'asset_helper' => true,
                ])
                ->hideOnIndex(),

            TextField::new('image_third_file_accessories', 'Troisième image de l\'accessoire')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                    'download_uri' => false,
                    'image_uri' => true,
                    'asset_helper' => true,
                ])
                ->hideOnIndex(),

            DateTimeField::new('date', 'Date de création')
                ->hideOnForm()
                ->setFormTypeOption('disabled', true),

            DateTimeField::new('updated_at', 'Date de mise à jour')
                ->hideOnForm()
                ->setFormTypeOption('disabled', true),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Accessories) return;

        if (!$entityInstance->getDate()) {
            $entityInstance->setDate(new \DateTimeImmutable());
        }

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
