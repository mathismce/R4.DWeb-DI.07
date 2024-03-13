<?php


/* indique où "vit" ce fichier */

namespace App\Controller;


/* indique l'utilisation du bon bundle pour gérer nos routes */

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use stdClass;
use App\Entity\Lego;
use App\Entity\Collection;
use App\Entity\LegoCollection;
use App\Repository\LegoRepository;
use App\Repository\LegoCollectionRepository;
use App\Service\CreditsGenerator;
use App\Service\DatabaseInterface;
use Doctrine\ORM\EntityManagerInterface;


/* le nom de la classe doit être cohérent avec le nom du fichier */

class LegoController extends AbstractController
{
    // L’attribute #[Route] indique ici que l'on associe la route
    // "/" à la méthode home pour que Symfony l'exécute chaque fois
    // que l'on accède à la racine de notre site.

    #[Route('/me',)]
    public function me()
    {
        die("Mathis");
    }

    // #[Route('/test')]
    // public function test(EntityManagerInterface $entityManager): Response
    // {
    //     $l = new Lego(1234);
    //     $l->setName("un beau Lego");
    //     $l->setDescription("nino lpb");
    //     $l->setPrice("100");
    //     $l->setPieces("13855");
    //     $l->setBoxImage("rhfbrifbrbfi");
    //     $l->setLegoImage("bdeuofbuoefuo");
        
    //     $entityManager->persist($l);

    //     // actually executes the queries (i.e. the INSERT query)
    //     $entityManager->flush();

    //     return new Response('Saved new product with id '.$l->getId());
    // }



    #[Route('/',)]
    public function home(LegoRepository $legoRepository) : Response
    {
     
        return $this->render('lego.html.twig', [
            'legos' => $legoRepository->findAll()
        ]);
    }




    //    #[Route('/creator', )]
    //    public function creator()
    //    {

    //     return $this->render('lego.html.twig', ['legos' => array_filter($this->legos, function($lego) { return $lego->getCollection() === "Creator" ; }) ]);
    //    }

    //    #[Route('/star_wars', )]
    //    public function starwars()
    //    {

    //     return $this->render('lego.html.twig', ['legos' => array_filter($this->legos, function($lego) { return $lego->getCollection() === "Star Wars" ; }) ]);
    //    }


    //    #[Route('/creator_expert', )]
    //    public function creatorExpert()
    //    {

    //     return $this->render('lego.html.twig', ['legos' => array_filter($this->legos, function($lego) { return $lego->getCollection() === "Creator Expert" ; }) ]);
    //    }

    #[Route('/{name}', name: 'filter_by_collection', requirements: ['name' => '(creator|star_wars|harry_potter|creator_expert)'])]
    public function filter(LegoCollection $collection,LegoCollectionRepository $legoCollectionRepository ): Response
    {

        return $this->render('lego.html.twig', ['legos' => $collection->getLegos(), 
        'collections'=> $legoCollectionRepository->findAll()]);
    }

    #[Route('/test/{id}', 'test')]
    public function test(LegoCollection $collection): Response
    {
        dd($collection);
    }




    

    #[Route('/credits', 'credits')]
    public function credits(CreditsGenerator $credits): Response
    {
        return new Response($credits->getCredits());
    }

}
