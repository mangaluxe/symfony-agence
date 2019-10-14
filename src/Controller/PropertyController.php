<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request; // Ajouté pour filtre
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\PropertySearch; // Ajouté pour filtre
use App\Form\PropertySearchType; // Ajouté pour filtre
use App\Entity\Property; // Ajouté pour recup données dans BDD
use Symfony\Component\Routing\Annotation\Route; // Pour Routes
use App\Repository\PropertyRepository; // Utiliser injection de dépendance
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Pour class extends
use Symfony\Component\HttpFoundation\Response; // Que pour les textes. Plus besoin pour $this->render('property/index.html.twig');

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
     * ========================================= Affiche liste de biens (sans pagination) =========================================
     * @Route("/biens", name="property.index_all")
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
        // $property = $this->repository->findAll(); // findAll() est natif dans Symfony

        // $property = $this->repository->findOneBy(['floor' => 4]);
        // $property = $this->repository->find(3);
        // $property = $this->repository->findLatest(); // Fonctions qu'on a créé dans Repository\PropertyRepository.php

        $property = $this->repository->findAllVisible(); // Fonction qu'on a créé dans Repository\PropertyRepository.php
        // dump($property);

        // $property[0]->setSold(true); // Changer le premier bien en vendu (une des méthodes possibles)
        // $this->em->flush();
        
        return $this->render('property/index_all.html.twig', [
            'properties' => $property
        ]);
    }





    /**
    * ======================================== Affiche liste de biens avec Pagination ========================================
    * @Route("/biens/pages/{page<\d+>?1}", name="property.index")
    * // Regex : d pour nombre, + pour un ou plusieurs, ? pour optionnel, 1 pour valeur par défaut
    */
    public function index_pagination($page = 1)
    // public function index_pagination($page = 1)
    {

        // ------ Pagination -----

        $property = $this->repository->findAllVisible(); // Fonction qu'on a créé dans src\Repository\PropertyRepository.php

        $limit = 4;
        $start = $page * $limit - $limit;
        // 1*10 - 10 = 0
        // 2*10 - 10 = 10 // Explique pourquoi $start = $page * $limit - $limit;
        $total = count($property);
        $pages = ceil($total / $limit); // ceil arrondit au nb supérieur

        return $this->render('property/index_pagination.html.twig', [
            'properties' => $this->repository->findBy([], [], $limit, $start),
            'pages' => $pages,
            'page' => $page
        ]);

    }





    /**
    * ======================================== Affiche liste de biens avec Filtre ========================================
    * @Route("/biens/filtre", name="property.index_filtre")
    * @return Response
    */
    public function index_filtre(Request $request): Response
    {

        // ------ Filtre -----

        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);


        $properties = $this->repository->findAllVisibleQuery($search)->getResult(); // Fonction qu'on a créé dans Repository\PropertyRepository.php

        dump($properties);


        return $this->render('property/index_filtre.html.twig', [
            'properties' => $properties,
            'form' => $form->createView() // Ajouté pour Filtre
        ]);

    }





    /**
    * ======================================== Affiche liste de biens avec Pagination + Filtre (ne marche pas) ========================================
    * @Route("/biens/pagefiltre/{page<\d+>?1}/filtre", name="property.index_pagination_filtre")
    * // Regex : d pour nombre, + pour un ou plusieurs, ? pour optionnel, 1 pour valeur par défaut
    */
    public function index_pagination_filtre($page = 1, Request $request)
    // public function index_pagination($page = 1)
    {

        // ------ Filtre -----

        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class, $search);
        $form->handleRequest($request);

        // ------ Pagination -----

        // $property = $this->repository->findAllVisible(); // Fonction qu'on a créé dans src\Repository\PropertyRepository.php

        // ------ Filtre + Pagination -----

        $property = $this->repository->findAllVisibleQuery($search)->getResult(); // Fonction qu'on a créé dans src\Repository\PropertyRepository.php pour Filtre

        dump($property);

        $limit = 4;
        $start = $page * $limit - $limit;
        $total = count($property);
        $pages = ceil($total / $limit);

        return $this->render('property/index_pagination_filtre.html.twig', [
            'form' => $form->createView(), // Ajouté pour Filtre
            // 'properties' => $this->repository->findBy([], [], $limit, $start),
            'properties' => $property,
            'pages' => $pages,
            'page' => $page
        ]);

    }





    /**
     * ========================================= Affiche 1 bien (avec slug) =========================================
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
        ]);
    }


}