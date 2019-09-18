<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager; // Ajouté
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityController extends AbstractController
{

    // ------ Contructeur pour Injection de dépendance : -----
    private $repo;
    private $em;

    public function __construct(ObjectManager $em)
    {
        $this->em = $em;
    }
    // -----------



    /**
     * @Route("/inscription", name="inscription")
     */
    public function registration(Request $request, UserPasswordEncoderInterface $encoder)
    // public function registration(Request $request, ObjectManager $em, UserPasswordEncoderInterface $encoder)
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() and $form->isValid()) {

            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
        
            // Ajouter ceci dans config\packages\security.yaml :
            // security:
            //     encoders:
            //         App\Entity\User:
            //             algorithm: bcrypt

            // Ajouter ceci dans src\Entity\User.php :
            // use Symfony\Component\Security\Core\User\UserInterface; // Ajouté pour cryptage de mot de passe de l'utilisateur
            // class User implements UserInterface

            // public function getSalt() {}
            // public function getRoles()
            // {
            //     return ['ROLE_USER'];
            // }
            // public function eraseCredentials() {}



            // ------ Sans injection de dépendance -----

            // $em = $this->getDoctrine()->getManager();
            // $em->persist($user);
            // $em->flush();

            // ------ Avec injection de dépendance -----

            $this->em->persist($user);
            $this->em->flush();



            return $this->redirectToRoute('connexion');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
    * @Route("/connexion", name="connexion")
    */
    public function login() {
        return $this->render('security/login.html.twig');
    }


    /**
    * @Route("/deconnexion", name="deconnexion")
    */
    public function logout() {}

        
        
}
