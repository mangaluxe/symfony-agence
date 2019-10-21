<?php

namespace App\Controller;

use App\Entity\User; // Ajouté pour recup données dans BDD
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ProfilController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repo;

    public function __construct(UserRepository $repo)
    {
        $this->repo = $repo;
    }

    public function profil($username): Response
    {
        // return new Response('Bonjour !');
        // return new Response($this->twig->render('security/profil.html.twig'));

        $profil = $this->repo->find($username);

        return $this->render('security/profil.html.twig', [
            'prof' => $profil
        ]);
    }
}