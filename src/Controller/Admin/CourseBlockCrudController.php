<?php

namespace App\Controller\Admin;

use App\Entity\CourseBlock;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Asset;

#[IsGranted('ROLE_ADMIN')]
class CourseBlockCrudController extends AbstractCrudController {
    public static function getEntityFqcn(): string {
        return CourseBlock::class;
    }

    public function configureFields(string $pageName): iterable {
        return [
            AssociationField::new('course', 'Cours associé')->setRequired(true),
            IntegerField::new('page_number', 'Numéro de page')->setHelp('Numéro de la page dans le cours'),
            TextEditorField::new('content', 'Contenu')->addCssClass('wysiwyg'),
        ];
    }

    public function configureAssets(Assets $assets): Assets
    {
        return $assets
            ->addJsFile(Asset::new('/js/app.js'));
    }
}
