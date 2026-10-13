<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
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

    #[Route('/', name: 'liste_utilisateur', methods: ['GET'])]
    public function index(): Response
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();
      
        return $this->render('utilisateur/index.html.twig', [
            'users' => $users,
            'controller_name' => 'UtilisateurController',
        ]);
    }

    // #[Route('/{id}', name: 'show_utilisateur')]
    // public function OneValue(User $user): Response
    // {
    //     return $this->render('utilisateur/index.html.twig', [
    //         'user' => $user,
    //         'controller_name' => 'UtilisateurController',
    //     ]);
    // }

    public function form(
        User $user,
        Request $request,
        EntityManagerInterface $em,
        UserPasswordHasherInterface $passwordHasher): Response
    {
        $isCreation = $user->getId() === null;
        $form = $this->createForm(UserType::class, $user, [
            'is_creation' => $isCreation,
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
            {
                $plainPassword = $form->get('password')->getData();
                if($plainPassword !== null) {
                    $user->setPassword(
                        $passwordHasher->hashPassword($user, $plainPassword)
                    );
                }
                $now = new \DateTimeImmutable();
                $user->setCreatedAt($now);
                $user->setUpdatedAt($now);

                $em->persist($user);
                $em->flush();

                return $this->redirectToRoute('liste_utilisateur');
            }

        return $this->render('utilisateur/form.html.twig', [
            'controller_name' => 'UtilisateurController',
            'form' => $form
        ]);
    }

    #[Route('/add', name:'add_user')]
    public function ajout(Request $request,EntityManagerInterface $em,UserPasswordHasherInterface $passwordHasher  ): Response
    {
        $user = new User();
        return $this->form($user,$request, $em, $passwordHasher);
    }

    #[Route('/update/{id}', name:'update_user')]
    public function update(User $user, Request $request,EntityManagerInterface $em,UserPasswordHasherInterface $passwordHasher): Response
    {
        return $this->form($user,$request, $em, $passwordHasher);
    }

    #[Route('/delete/{id}', name:'delete_user', methods:['DELETE','GET'])]
    public function delete(User $user, Request $request, EntityManagerInterface $em): Response
    {
        if (!$this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            throw $this->createAccessDeniedException('Jeton CSRF invalide.');
        }

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('liste_utilisateur');
    }
}
