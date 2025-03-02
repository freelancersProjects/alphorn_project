<?php

namespace App\Controller\Admin;

use App\Entity\Translation;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
class TranslationCrudController extends AbstractCrudController
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public static function getEntityFqcn(): string
    {
        return Translation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('key_word', 'Variable')->setHelp('Ex: welcome_message'),

            TextField::new('value', 'Texte en Français')
                ->setHelp('Ce texte sera traduit automatiquement'),

            FormField::addPanel('Traduction automatique'),
            TextField::new('translate_button', 'Traduire automatiquement')
                ->onlyOnForms()
                ->renderAsHtml()
                ->setFormTypeOptions([
                    'mapped' => false,
                    'attr' => [
                        'class' => 'btn btn-primary translate-button',
                        'data-action' => 'translate',
                        'readonly' => true,
                    ],
                ]),
        ];
    }

    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof Translation) {
            return;
        }

        $keyWord = $entityInstance->getKeyWord();
        $valueFr = $entityInstance->getValue();

        $existingTranslation = $entityManager->getRepository(Translation::class)->findOneBy([
            'key_word' => $keyWord,
            'locale' => 'fr'
        ]);

        if ($existingTranslation) {
            parent::persistEntity($entityManager, $entityInstance);
            return;
        }

        $translations = [
            'fr' => $valueFr,
            'it' => null,
            'de' => null,
        ];

        foreach ($translations as $locale => $value) {
            $translation = new Translation();
            $translation->setKeyWord($keyWord);
            $translation->setLocale($locale);
            $translation->setValue($value);

            $entityManager->persist($translation);
        }

        $entityManager->flush();

        $translatedValues = $this->getTranslationsFromApi($valueFr);

        foreach ($translatedValues as $locale => $translatedValue) {
            $translation = $entityManager->getRepository(Translation::class)->findOneBy([
                'key_word' => $keyWord,
                'locale' => $locale
            ]);

            if ($translation) {
                $translation->setValue($translatedValue);
                $entityManager->persist($translation);
            }
        }

        $entityManager->flush();
    }

    private function getTranslationsFromApi(string $text): array
    {
        $languages = ['it', 'de'];
        $translations = [];

        foreach ($languages as $lang) {
            $response = $this->httpClient->request('GET', 'https://api.mymemory.translated.net/get', [
                'query' => [
                    'q' => $text,
                    'langpair' => 'fr|' . $lang,
                ],
            ]);

            $data = $response->toArray();
            $translatedText = $data['responseData']['translatedText'] ?? null;

            if ($translatedText) {
                $translations[$lang] = $translatedText;
            }
        }

        return $translations;
    }
}
