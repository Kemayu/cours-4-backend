<?php

namespace App\Command;

use App\Entity\Batiment;
use App\Entity\Personne;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Faker\Factory;


#[AsCommand(
    name: 'Insertdatafaker',
    description: 'Add a short description for your command',
)]
class InsertdatafakerCommand extends Command
{
    private EntityManagerInterface $em;
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();

        $this->em = $em;
    }

    protected function configure(): void
    {
        $this->addArgument('nbBatiments', InputArgument::OPTIONAL, 'Nombre de bâtiments à créer');
        $this->addArgument('nbPersonnes', InputArgument::OPTIONAL, 'Nombre de personnes par bâtiment');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $faker = Factory::create();
        $io = new SymfonyStyle($input, $output);
        
        $nbPersonnes = (int) ($input->getArgument('nbPersonnes') ?? 100);
        $nbBatiments = (int) ($input->getArgument('nbBatiments') ?? 10);

        for ($i = 0; $i < $nbBatiments; $i++) {
            $b1 = new Batiment();
            $b1->setNom("Batiment$i");
            $b1->setHauteur($faker->numberBetween(10, 1000));
           
           
            for ($j = 0; $j < $nbPersonnes; $j++) {
                   $p1 = new Personne();
                   $p1->setNom($faker->lastName());
                   $p1->setPrenom($faker->firstName());
                   $p1->setAge($faker->numberBetween(18,80));
                   $p1->setBatiment($b1);
                   $b1->addPersonne($p1);
                   
                   $this->em->persist($p1);
                   
             }
            $this->em->persist($b1);
              
        }


        $this->em->flush();

        $io->success(sprintf('Données ajoutées'));
        return Command::SUCCESS;
    }
}
