<?php


/* indique où "vit" ce fichier */

namespace App\Controller;


/* indique l'utilisation du bon bundle pour gérer nos routes */

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;
use stdClass;
use App\Entity\Lego;

/* le nom de la classe doit être cohérent avec le nom du fichier */

class LegoController extends AbstractController
{
    // L’attribute #[Route] indique ici que l'on associe la route
    // "/" à la méthode home pour que Symfony l'exécute chaque fois
    // que l'on accède à la racine de notre site.

    private array $legos;

    public function __construct()
    {
        $this->legos = [];
        $data = file_get_contents("../src/data.json");
        $tab = json_decode($data);


        foreach ($tab as $legoData) {

            $legoModel = new Lego($legoData->id, $legoData->name, $legoData->collection);
            $legoModel->setDescription($legoData->description);
            $legoModel->setCollection($legoData->collection);
            $legoModel->setPrice($legoData->price);
            $legoModel->setPieces($legoData->pieces);
            $legoModel->setBoxImage($legoData->images->box);
            $legoModel->setlegoImage($legoData->images->bg);

            array_push($this->legos, $legoModel);
        }
    }
    #[Route('/me',)]
    public function me()
    {
        die("Mathis");
    }


    #[Route('/',)]
    public function home()
    {

        return $this->render('lego.html.twig', ['legos' => $this->legos]);
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

    #[Route('/{collection}', name: 'filter_by_collection', requirements: ['collection' => '(creator|star_wars|creator_expert)'])]
    public function filter($collection): Response
    {

        
        return $this->render('lego.html.twig', [
            'legos' => array_filter($this->legos, function ($legoData) use ($collection) {
                
                return strtolower($legoData->getCollection()) == str_replace('_', ' ', strtolower($collection));
            })
        ]);
    }
}
