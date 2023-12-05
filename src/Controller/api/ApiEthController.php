<?php 

namespace App\Controller\api;

use App\Repository\EthRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ApiEthController extends AbstractController{

    #[Route("api/eth" , methods:["GET"])]
    public function index(EthRepository $EthRepository){

        $values = $EthRepository->getQball()
                ->orderBy("e.date_eth", "DESC")
                ->setMaxResults(7)
                ->getQuery()
                ->getResult();

        return $this->json($values , context:["groups"=>["eth"]]);
    }
}