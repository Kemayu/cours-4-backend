<?php

namespace App\Command;

use App\Entity\Batiment;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Personne;

#[AsCommand(
    name: 'insertdata',
    description: 'Add a short description for your command',
)]
class InsertdataCommand extends Command
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);


        $p1 = new Personne();
        $p1->setNom("Demirci");
        $p1->setPrenom("Mirac");
        $p1->setAge(19);

        $b1 = new Batiment();
        $b1->setNom("batiment1");
        $b1->setHauteur(120);

        $p1->setBatiment($b1);

        $b1->addPersonne($p1);



        $this->em->persist($p1);
        $this->em->persist($b1);
        $this->em->flush();

        $io->success(sprintf('Données ajoutées'));

        return Command::SUCCESS;
    }
}
