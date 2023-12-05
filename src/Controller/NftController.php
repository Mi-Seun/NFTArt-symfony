<?php

namespace App\Controller;

use App\Entity\Nft;
use App\Form\NftType;
use App\Repository\NftRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

// Contrôleur gérant les actions liées aux NFT
#[Route('/admin/nft')]
class NftController extends AbstractController
{
    public function __construct(
        private UserRepository $userRepository
    ){}

    // Affiche la liste des NFT
    #[Route('/', name: 'app_nft_index', methods: ['GET'])]
    public function index(NftRepository $nftRepository): Response
    {
        return $this->render('nft/index.html.twig', [
            'nfts' => $nftRepository->findAll(),
        ]);
    }

    // Crée un nouveau NFT
    #[Route('/new', name: 'app_nft_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger, UserRepository $userRepository): Response
    {
        $uploadDirectory = $this->getParameter("upload_file");
        $nft = new Nft();
        $users = $userRepository->findAll();
        $form = $this->createForm(NftType::class, $nft);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get("file")->getData();
            if ($file) {
                // Gestion de l'upload du fichier et ajout du chemin dans l'entité NFT
                $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFileName = $slugger->slug($originalFileName);
                $newFileName = $safeFileName . "-" . uniqid() . "." . $file->guessExtension();
                try {
                    $file->move($uploadDirectory, $newFileName);
                    $nft->setPathUrl($newFileName);
                } catch (FileException $e) {
                    // Gestion des exceptions en cas d'échec de l'upload
                }
    
                $entityManager->persist($nft);
                $entityManager->flush();
                return $this->redirectToRoute('app_nft_index', [], Response::HTTP_SEE_OTHER);
            }
        }
        return $this->render('nft/new.html.twig', [
            'nft' => $nft,
            'form' => $form,
            'users' => $users,
        ]);
    }

    // Affiche les détails d'un NFT
    #[Route('/{id}', name: 'app_nft_show', methods: ['GET'])]
    public function show(Nft $nft): Response
    {
        // Récupère les utilisateurs associés à ce NFT
        $users = $this->userRepository->getQbUseDe1Nft($nft->getId());
        //var_dump($users);
        return $this->render('nft/show.html.twig', [
            'nft' => $nft,
            'users' => $users,
        ]);
    }

    // Modifie un NFT existant
    #[Route('/{id}/edit', name: 'app_nft_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Nft $nft, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NftType::class, $nft);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistre les modifications du NFT
            $entityManager->flush();

            return $this->redirectToRoute('app_nft_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('nft/edit.html.twig', [
            'nft' => $nft,
            'form' => $form,
        ]);
    }

    // Supprime un NFT
    #[Route('/{id}', name: 'app_nft_delete', methods: ['POST'])]
    public function delete(Request $request, Nft $nft, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$nft->getId(), $request->request->get('_token'))) {
            // Supprime le NFT de la base de données
            $entityManager->remove($nft);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_nft_index', [], Response::HTTP_SEE_OTHER);
    }
}
