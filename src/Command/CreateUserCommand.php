<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\User\UserManager;

#[AsCommand(
    name: 'create-user',
    description: 'create a user',
)]
class CreateUserCommand extends Command
{

    private UserManager $userManager;

    public function __construct(UserManager $userManager)
    {
        parent::__construct();
        $this->userManager = $userManager;
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

        try {
            $this->userManager->createUser($email, $password, $roles);
            $output->writeln('<info>User successfully created!</info>');
        } catch (\InvalidArgumentException $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        } catch (\LogicException $e) {
            $output->writeln('<error>' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        } catch (\Exception $e) {
            $output->writeln('<error>Something went wrong: ' . $e->getMessage() . '</error>');
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
