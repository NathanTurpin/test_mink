<?php

namespace App\Service\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\Length;

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

    if (!$this->validateEmail($email)) {
      throw new \InvalidArgumentException('Invalid email ');
    }

    if ($this->isEmailTaken($email)) {
      throw new \LogicException(' user already exists');
    }

    if (!$this->validatePassword($password)) {
      throw new \InvalidArgumentException('Pwd not long enougth');
    }

    $user = new User();
    $user->setEmail($email);
    $user->setRoles($roles);

    $hashedPwd = $this->passwordHasher->hashPassword($user, $password);
    $user->setPassword($hashedPwd);

    $this->entityManager->persist($user);
    $this->entityManager->flush();

    return $user;
  }

  private function validateEmail(string $email): bool
  {
    $validator = Validation::createValidator();
    $violations = $validator->validate($email, new Email());

    return count($violations) === 0;
  }

  private function isEmailTaken(string $email): bool
  {
    $existingUser = $this->entityManager->getRepository(User::class)->findOneBy(['email' => $email]);

    return $existingUser !== null;
  }

  private function validatePassword(string $password): bool
  {
    $validator = Validation::createValidator();
    $violations = $validator->validate($password, [
      new Length(['min' => 6]) // Minimum 6 caractères pour le mot de passe
    ]);

    return count($violations) === 0;
  }
}
