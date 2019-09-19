<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response; // Que pour les textes. Plus besoin pour $this->render('property/index.html.twig');
use App\Repository\PropertyRepository; // Utiliser injection de dépendance
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Property; // Ajouté pour recup données dans BDD
use Symfony\Component\Routing\Annotation\Route; // Pour Routes
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Pour class extends

class PropertyController extends AbstractController
{

    // ------ Contructeur pour Injection de dépendance : -----
    /**
     * @var PropertyRepository
     */
    private $repository;

    /**
     * @var ObjectManager
     */
    private $em;

    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
        $this->repository = $repository;
        $this->em = $em;
    }
    // -----------


    /**
     * ========================================= Affiche liste de biens =========================================
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(): Response
    {

        // // ---------- 1er méthode (sans injection de dépendance) : ----------
        // $repository = $this->getDoctrine()->getRepository(Property::class);
        // dump($repository);
        // $property = $repository->findAllVisible();
        // dump($property);

        // // ---------- 2e méthode (avec injection de dépendance dans constructeur) : ----------
        // $property = $this->repository->find(1);
        // $property = $this->repository->findAll();
        // $property = $this->repository->findOneBy(['floor' => 4]);

        $property = $this->repository->findAllVisible();
        // dump($property);

        // $property[0]->setSold(true); // Changer le premier bien en vendu (une des méthodes possibles)
        // $this->em->flush();
        
        return $this->render('property/index.html.twig', [
            'properties' => $property
        ]);
    }

    
    /**
     * ========================================= Affiche 1 bien =========================================
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @ Property $property
     */
    public function show(Property $property, string $slug)
    {
        if ($property->getSlug() !== $slug) {
            return $this->redirectToRoute('property.show', [
                'id' => $property->getId(),
                'slug' => $property->getSLug()
            ], 301);
        }

        // $property = $this->repository->find($id);

        return $this->render('property/show.html.twig', [
            'property' => $property,
            // 'current_menu' => 'properties'
        ]);
    }






}