<?php

namespace App\Service\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserManager
{
  private EntityManagerInterface $entityManager;
  private UserPasswordHasherInterface $passwordHasher;

  public function __construct(EntityManagerInterface $entityManager,  UserPasswordHasherInterface $passwordHasher)
  {
    $this->entityManager = $entityManager;
    $this->passwordHasher = $passwordHasher;
  }

  public function createUser(string $email, string $password, array $roles): User
  {
    $user = new User();
    $user->setEmail($email);
    $user->setRoles($roles);

    $hashedPwd = $this->passwordHasher->hashPassword($user, $password);
    $user->setPassword($hashedPwd);

    $this->entityManager->persist($user);
    $this->entityManager->flush();

    return $user;
  }
}
