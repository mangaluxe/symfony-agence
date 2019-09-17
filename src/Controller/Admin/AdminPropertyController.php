<?php
namespace App\Controller\Admin;

use App\Entity\Property;
use App\Form\PropertyType; // Ajouté pour form
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route; // Pour Routes
use Symfony\Component\HttpFoundation\Request; // Ajouté pour form
use App\Repository\PropertyRepository; // Utiliser injection de dépendance
use Doctrine\Common\Persistence\ObjectManager; // Ajouté
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController; // Pour class extends

class AdminPropertyController extends AbstractController
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
     * @Route("/admin", name="admin.property.index")
     */
    public function index()
    {
        $properties = $this->repository->findAll();

        return $this->render('admin/property/index.html.twig', compact ('properties'));
    }




    /**
     * @Route("/admin/property/create", name="admin.property.new")
     */
    public function new(Request $request)
    {
        $property = new Property();

        $form = $this->createForm(PropertyType::class, $property); // On n'oublie pas le "use App\Form\PropertyType;" en haut pour appeler PropertyType

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
                    
            $this->em->persist($property);
            $this->em->flush();

            $this->addFlash('success', 'Bien créé !');

            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('admin/property/new.html.twig', [
            'property' => $property, // Paramètres. On utilise property.id, property.title pour afficher dans fichiers twig
            'form' => $form->createView()
        ]);

    }





    /**
     * @Route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST") // Ici, on dit qu'on accepte que les requetes GET et POST pour distinguer avec DELETE
     * @param Property $property
     * @param Request $request
     */
    public function edit(Property $property, Request $request)
    {
        $form = $this->createForm(PropertyType::class, $property); // On n'oublie pas le "use App\Form\PropertyType;" en haut pour appeler PropertyType

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {
                    
            // $this->em->persist($property); // Pas besoin ici
            $this->em->flush();

            $this->addFlash('success', 'Modifié !');

            return $this->redirectToRoute('admin.property.index');
        }


        return $this->render('admin/property/edit.html.twig', [
            'property' => $property,
            'form' => $form->createView()
        ]);
    }






    /**
     * @Route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
     * @param Property $property
     * @param Request $request
     */
    public function delete(Property $property, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $property->getId(), $request->get('_token'))) // Token créé manuellement pour Delete
        {
            // return new Response('Suppression ok !'); // Pour tester

            $this->em->remove($property);
            $this->em->flush();

            $this->addFlash('success', 'Supprimé !');
        }
        return $this->redirectToRoute('admin.property.index');

    }







}