<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user')]
final class UserController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    #[Route('', name: 'app_utilisateur')]
    public function index(): Response
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();
        

        return $this->render('utilisateur/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/{id}', name: 'app_utilisateur')]
    public function OneValue(User $user): Response
    {
        return $this->render('utilisateur/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/user/add', name:'add_user')]
    public function ajout(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $nom = $data["nom"];
        $prenom = $data["prenom"];
        $age = $data["age"];
        $roles = $data["roles"] ?? ["ROLE_USER"];
        $passwd = $data["password"];

        $user = new User();

        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setAge($age);
        $user->setRoles($roles);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $passwd
        );

        $user->setPassword($hashedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    #[Route('/user/update/{id}', name:'update_user')]
    public function update(User $user, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $nom = $data["nom"];
        $prenom = $data["prenom"];
        $age = $data["age"];
        $roles = $data["roles"] ?? ["ROLE_USER"];
        $passwd = $data["password"];

        $user->setNom($nom);
        $user->setPrenom($prenom);
        $user->setAge($age);
        $user->setRoles($roles);

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $passwd
        );

        $user->setPassword($hashedPassword);

        $this->entityManager->flush();

        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }
}
