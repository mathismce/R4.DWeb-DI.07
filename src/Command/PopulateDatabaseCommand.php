<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Lego;

#[AsCommand(
    name: 'app:populate-database',
    description: 'Add a short description for your command',
)]
class PopulateDatabaseCommand extends Command
{

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $jsonData = file_get_contents('./src/Data/data.json');

        $legoData = json_decode($jsonData, true);

        foreach ($legoData as $item){
            $l = new Lego($item['id']); 
            $l->setName($item['name']);
            $l->setDescription($item['description']);
            $l->setPrice($item['price']);
            $l->setPieces($item['pieces']);
            $l->setBoxImage($item['images']['box']); 
            $l->setLegoImage($item['images']['bg']);
            
        
            $this->entityManager->persist($l);

            // actually executes the queries (i.e. the INSERT query)
            $this->entityManager->flush();

            
        }

        return Command::SUCCESS;
    }
}
