<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response; // Que pour les textes. Plus besoin pour $this->render('pages/index.html.twig');
use Symfony\Component\Routing\Annotation\Route; // Pour Routes
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Pour class extends
use App\Repository\PropertyRepository; // Pour l'injection de dépendance


class HomeController extends AbstractController
{

    /**
     * ========================================= Affiche les derniers biens =========================================
     * @Route("/", name="home")
     * @param PropertyRepository $repository
     */
    public function index(PropertyRepository $repository) // Sans constructeur pour l'injection de dépendance, on ajoute "PropertyRepository $repository" en paramètre de la fonction
    {
        $properties = $repository->findLatest(); // findAllVisible(); findAll();

        return $this->render('pages/home.html.twig', [
            'properties' => $properties
        ]);
    }
    
}