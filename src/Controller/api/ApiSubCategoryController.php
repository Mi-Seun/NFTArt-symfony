<?php 

namespace App\Controller\api;

use App\Repository\SubcategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class ApiSubCategoryController extends AbstractController{

    #[Route('/api/sub-category')]
    public function index(SubcategoryRepository $subcategoryRepository){

        $subCategories = $subcategoryRepository->findAll();

        return $this->json($subCategories , context:[ "groups" => ["subcategory"]]);

    }
}