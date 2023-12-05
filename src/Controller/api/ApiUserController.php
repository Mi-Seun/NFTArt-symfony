<?php 

namespace App\Controller\api;

use App\Repository\NftRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiUserController extends AbstractController{

    public function __construct(
        private UserRepository $userRepository
    ){

    }

    #[Route('/api/user')]
    public function getUserInfo()
    {

        return $this->json($this->getUser(), context: ['groups' => ['user']]);

    }

    #[Route('/api/user/all')]
    public function getAllUsers()
    {
        $users = $this->userRepository->findAll();



        return $this->json($users , context: ['groups' => ['user']]);

    }


}