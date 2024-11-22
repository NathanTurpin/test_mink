<?php

namespace App\Command;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(
    name: 'create-user',
    description: 'create a user',
)]
class CreateUserCommand extends Command
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'The email of the user')
            ->addArgument('password', InputArgument::REQUIRED, 'The password of the user')
            ->addArgument('roles', InputArgument::IS_ARRAY, 'Roles for the user (separate multiple roles with a space)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title("Create a new user !");

        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $roles = $input->getArgument('roles');

        if ($email) {
            $io->note(sprintf('You passed an email: %s', $email));
        }

        if ($password) {
            $io->note(sprintf('You passed an password: %s', $password));
        }

        if ($roles) {
            $io->note('You passed an roles: ');
            $io->listing($roles);
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $output->writeln('<error>Invalid email address.</error>');

            return Command::FAILURE;
        }

        $userRepository = $this->entityManager->getRepository(User::class);

        if ($userRepository->findOneBy(['email' => $email])) {
            $output->writeln('<error>User with this email already exists.</error>');

            return Command::FAILURE;
        }



        $user = new User();
        $user->setEmail($email);
        $user->setRoles($roles);
        $user->setPassword($password);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $output->writeln('<info>User successfully created!</info>');

        return Command::SUCCESS;
    }
}
