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
use App\Service\CreditsGenerator;
use App\Service\DatabaseInterface;


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


    #[Route('/',)]
    public function home(DatabaseInterface $databaseInterface) : Response
    {
     
        return $this->render('lego.html.twig', [
            'legos' => $databaseInterface->getAllLegos(), 
            'collections'=> $databaseInterface->getAllCollections()
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

    #[Route('/{collection}', name: 'filter_by_collection', requirements: ['collection' => '(creator|star_wars|harry_potter|creator_expert)'])]
    public function filter(DatabaseInterface $databaseInterface, $collection): Response
    {

        $collectionMAJ = str_replace('_',' ', strtolower($collection));

        
        return $this->render('lego.html.twig', ['legos' => $databaseInterface->getLegosByCollection($collectionMAJ), 
        'collections'=> $databaseInterface->getAllCollections()]);
    }

    #[Route('/credits', 'credits')]
    public function credits(CreditsGenerator $credits): Response
    {
        return new Response($credits->getCredits());
    }

}
