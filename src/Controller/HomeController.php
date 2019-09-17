<?php
namespace App\Controller;

// use Symfony\Component\HttpFoundation\Response; // Que pour les textes. Plus besoin pour $this->render('property/index.html.twig');
use App\Repository\PropertyRepository;
use Symfony\Component\Routing\Annotation\Route; // Pour Routes
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Pour class extends

class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     * @param PropertyRepository $repository
     */
    public function index(PropertyRepository $repository)
    {
        $properties = $repository->findLatest();

        return $this->render('pages/home.html.twig', [
            'properties' => $properties
        ]);
    }
    
}