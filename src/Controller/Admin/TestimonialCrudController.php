<?php

namespace App\Controller\Admin;

use App\Entity\Testimonial;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Vich\UploaderBundle\Form\Type\VichImageType;

#[IsGranted('ROLE_ADMIN')]
class TestimonialCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Testimonial::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre du témoignage'),
            
            TextareaField::new('description', 'Description')->setHelp('Ajoutez une description détaillée'),

            TextField::new('main_image_file_testimonial', 'Image principale du témoignage')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                    'download_uri' => false,
                    'image_uri' => true,
                    'asset_helper' => true,
                ]),

            TextField::new('image_first_file_testimonial', 'Première image du témoignage')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                    'download_uri' => false,
                    'image_uri' => true,
                    'asset_helper' => true,
                ])
                ->hideOnIndex(),

            TextField::new('image_second_file_testimonial', 'Deuxième image du témoignage')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                    'download_uri' => false,
                    'image_uri' => true,
                    'asset_helper' => true,
                ])
                ->hideOnIndex(),

            TextField::new('image_third_file_testimonial', 'Troisième image du témoignage')
                ->setFormType(VichImageType::class)
                ->setFormTypeOptions([
                    'allow_delete' => false,
                    'download_uri' => false,
                    'image_uri' => true,
                    'asset_helper' => true,
                ])
                ->hideOnIndex(),
            
            AssociationField::new('fk_id_user', 'Utilisateurs')
                ->formatValue(function ($value, $entity) {
                    return $entity->getFkIdUser() ? ($entity->getFkIdUser()->getFirstname() . ' ' . $entity->getFkIdUser()->getLastname()) : 'Utilisateur inconnu';
                })
                ->setFormTypeOptions(['disabled' => true]),

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
        if (!$entityInstance instanceof Testimonial) return;

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
