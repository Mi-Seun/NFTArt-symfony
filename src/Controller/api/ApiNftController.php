<?php 

namespace App\Controller\api;

use App\Entity\Nft;
use App\Repository\NftRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/api/")]
class ApiNftController extends AbstractController{


    #[Route("nft" , methods:["GET"])]
public function allNfts(NftRepository $nftRepository):Response{

    $nfts = $nftRepository->findAll();
    return $this->json($nfts , context:["groups" => "nfts"]);


}

#[Route("nft/{id}", methods: ["GET"])]
public function getNft(Nft $nft){

    return $this->json($nft , context:["groups"=>"nfts"]);

}

#[Route("nft/update/{id}" , methods:["POST"])]
public function updateNft(NftRepository $nftRepository , int $id):Response{

    $nft = $nftRepository->find($id);
    dd($nft);


}


}