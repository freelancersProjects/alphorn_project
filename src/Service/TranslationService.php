<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Cache\CacheInterface;
use App\Entity\Translation;

class TranslationService {

    private $em;
    private $cache;

    public function __construct(EntityManagerInterface $em, CacheInterface $cache)
    {
        $this->em = $em;
        $this->cache = $cache;
    }

   public function translate(string $key_word, string $locale): string
{
    $translation = $this->cache->get("translation_{$key_word}_{$locale}", function () use ($key_word, $locale) {
        return $this->em->getRepository(Translation::class)->findOneBy([
            'key_word' => $key_word,
            'locale' => $locale,
        ]);
    });

    if ($translation) {
        return $translation->getValue();
    }

    if ($locale !== 'fr') {
        $fallbackTranslation = $this->cache->get("translation_{$key_word}_fr", function () use ($key_word) {
            return $this->em->getRepository(Translation::class)->findOneBy([
                'key_word' => $key_word,
                'locale' => 'fr',
            ]);
        });

        if ($fallbackTranslation) {
            return $fallbackTranslation->getValue();
        }
    }

    // Gestion d'erreur : retourne une valeur explicite si aucune traduction n'existe
    return "[MISSING TRANSLATION: {$key_word} ({$locale})]";
}

}

?>

