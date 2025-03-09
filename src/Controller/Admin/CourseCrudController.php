<?php

namespace App\Controller\Admin;

use App\Entity\Course;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class CourseCrudController extends AbstractCrudController {
    public static function getEntityFqcn(): string {
        return Course::class;
    }

public function configureFields(string $pageName): iterable {
    return [
        TextField::new('title', 'Titre du cours'),
        TextareaField::new('description', 'Description')->setHelp('Ajoutez une description détaillée'),
        ChoiceField::new('language', 'Langue')->setChoices([
            'Français' => 'fr',
            'Allemand' => 'de',
            'Italien' => 'it',
        ]),
        ChoiceField::new('difficulty', 'Difficulté')->setChoices([
            'Difficile' => 'Hard',
            'Moyen' => 'Medium',
            'Facile' => 'Easy',
        ]),
        IntegerField::new('duration', 'Durée du cours')->setHelp('Entrez la durée en nombre entier'),
        ChoiceField::new('durationUnit', 'Unité du cours')->setChoices([
            'Minutes' => 'min',
            'Heures' => 'h',
        ])
        ->setRequired(true),
        ImageField::new('image', 'Image du cours')->setUploadDir('public/images/')->setBasePath('images/'),
        DateTimeField::new('created_at', 'Date de création')
            ->hideOnForm()
            ->setFormTypeOption('disabled', true),
        BooleanField::new('is_published', 'Publié'),
    ];
}

public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void {
    if (!$entityInstance instanceof Course) return;

    if (!$entityInstance->getCreatedAt()) {
        $entityInstance->setCreatedAt(new \DateTimeImmutable());
    }

    $request = $this->getContext()->getRequest();
    $formData = $request->request->all();

    $unit = $formData['Course']['durationUnit'] ?? 'h';
    $entityInstance->setDurationUnit($unit);

    $entityManager->persist($entityInstance);
    $entityManager->flush();
}

public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void {
    $this->persistEntity($entityManager, $entityInstance);
}

}
