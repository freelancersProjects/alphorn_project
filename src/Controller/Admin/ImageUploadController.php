<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class ImageUploadController extends AbstractController
{
    #[Route('/admin/upload-image', name: 'upload_image', methods: ['POST'])]
    public function uploadImage(Request $request): Response
    {
        $image = $request->files->get('file');

        if ($image) {
            $uploadDir = $this->getParameter('kernel.project_dir') . '/public/images/uploads';
            $imageName = uniqid() . '.' . $image->guessExtension();

            try {
                $image->move($uploadDir, $imageName);

                return new JsonResponse(['url' => '/images/uploads/' . $imageName], Response::HTTP_OK);
            } catch (FileException $e) {
                return new JsonResponse(['error' => 'Upload error'], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        return new JsonResponse(['error' => 'No file uploaded'], Response::HTTP_BAD_REQUEST);
    }
}
