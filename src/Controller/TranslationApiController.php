<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpFoundation\Request;

class TranslationApiController extends AbstractController
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    #[Route('/admin/translate-api', name: 'admin_translate_api', methods: ['POST'])]
    public function translateAuto(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $frValue = $data['fr_value'] ?? null;

        if (!$frValue) {
            return new JsonResponse(['error' => 'Texte français manquant'], 400);
        }

        $languages = ['it', 'de'];
        $translations = [];

        foreach ($languages as $lang) {
            $response = $this->httpClient->request('GET', 'https://api.mymemory.translated.net/get', [
                'query' => [
                    'q' => $frValue,
                    'langpair' => 'fr|' . $lang,
                ],
            ]);

            $responseData = $response->toArray();
            $translatedText = $responseData['responseData']['translatedText'] ?? null;

            if ($translatedText) {
                $translations[$lang] = $translatedText;
            }
        }

        return new JsonResponse(['translations' => $translations]);
    }
}
