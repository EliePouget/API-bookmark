<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class GetMeController extends AbstractController
{
    #[Route('/get/me', name: 'app_get_me')]
    public function __invoke(): UserInterface
    {
        if (null != $this->getUser()) {
            return $this->getUser();
        } else {
            throw $this->createNotFoundException('error 404');
        }
    }
}
