<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetAvatarController extends AbstractController
{
    public function __invoke(User $data): Response
    {
        return new Response(
            stream_get_contents($data->getAvatar(),-1,0),
            Response::HTTP_OK,
            ['content-type' => 'image/png']
        );
    }
}
