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


    /**
     * @Route("/biens", name="property.index")
     * @return Response
     */
    public function index(): Response
    {
        // // Une des méthodes pour ajouter des données dans la BDD (juste pour ajouter une donnée pour tester la récup de données):
        // $property = new Property();
        // $property->setTitle('Mon 2e bien')
        //     ->setPrice(200000)
        //     ->setRooms(4)
        //     ->setBedrooms(3)
        //     ->setDescription('Une petite description')
        //     ->setSurface(60)
        //     ->setFloor(4)
        //     ->setHeat(1)
        //     ->setCity('Montpellier')
        //     ->setAddress('15 Boulevard Gambetta')
        //     ->setPostalCode('34000');
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($property);
        // $em->flush();



        // // ========== 1er méthode : ========== 
        // $repository = $this->getDoctrine()->getRepository(Property::class);
        // dump($repository);
        // $property = $repository->findAllVisible();
        // dump($property);

        // // ========== 2e méthode (avec injection dans constructeur) : ========== 
        // $property = $this->repository->find(1);
        // $property = $this->repository->findAll();
        // $property = $this->repository->findOneBy(['floor' => 4]);

        $property = $this->repository->findAllVisible();
        dump($property);

        // $property[0]->setSold(true);

        // $this->em->flush();
        
        return $this->render('property/index.html.twig', [
            'current_menu' => 'properties' // A quoi sert ce paramètre ???
        ]);
    }

    
    /**
     * @Route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
     * @ Property $property
     * @return Response
     */
    public function show(Property $property, string $slug): Response
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
            'current_menu' => 'properties' // A quoi sert ce paramètre ???
        ]);
    }






}