<?php

namespace App\Controller\Admin;

use App\Entity\Course;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

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
            ImageField::new('image', 'Image du cours')->setUploadDir('public/images/')->setBasePath('images/'),
            DateTimeField::new('created_at', 'Date de création')
                ->hideOnForm()
                ->setFormTypeOption('disabled', true),
        ];
    }
}
