<?php
namespace App\Twig;

use App\Service\TranslationService;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TranslationExtension extends AbstractExtension
{
    private $translationService;

    public function __construct(TranslationService $translationService)
    {
        $this->translationService = $translationService;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('trans', [$this->translationService, 'translate']),
        ];
    }
}
