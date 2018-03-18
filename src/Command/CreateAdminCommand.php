<?php

namespace App\Command;

use App\Entity\Admin;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

/**
 * Class CreateAdminCommand.
 */
class CreateAdminCommand extends Command
{
    /**
     * @var UserPasswordEncoder
     */
    private $passwordEncoder;
    /**
     * @var Registry
     */
    private $doctrine;

    /**
     * CreateAdminCommand constructor.
     *
     * @param UserPasswordEncoder $passwordEncoder
     * @param Registry            $doctrine
     */
    public function __construct(UserPasswordEncoder $passwordEncoder, Registry $doctrine)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->doctrine = $doctrine;

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:admin:create')
            ->setDescription('Create new admin for admin side')
            ->addArgument('username', InputArgument::REQUIRED, 'The username of the admin.')
            ->addArgument('password', InputArgument::REQUIRED, 'The password of the admin.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $admin = new Admin();
        $admin
            ->setUsername($input->getArgument('username'))
            ->setPassword($this->passwordEncoder->encodePassword($admin, $input->getArgument('password')));

        $this->doctrine->getManager()->persist($admin);
        $this->doctrine->getManager()->flush();

        $io->writeln('Done.');
    }
}
