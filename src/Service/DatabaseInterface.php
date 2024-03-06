<?php


// Là ou la classe est déclarée (où son fichier se trouve)
namespace App\Service;


use PDO;

use App\Entity\Lego;
use App\Entity\Collection;
class DatabaseInterface
{
    public function createLego($data): array 
    {
        $result = [];
        
        foreach ($data as $legoData) {
            $legoModel = new Lego($legoData['id'], $legoData['name'], $legoData['collection']);
            $legoModel->setDescription($legoData['description']);
            $legoModel->setPrice($legoData['price']);
            $legoModel->setPieces($legoData['pieces']);
            $legoModel->setBoxImage($legoData['imagebox']);
            $legoModel->setlegoImage($legoData['imagebg']);


            array_push($result, $legoModel);
        }

        return $result;
        

    }

    public function createCollection($data): array 
    {
        $result = [];
        
        foreach ($data as $legoCol) {
            $name = $legoCol['collection'];
            $link = str_replace(' ','_', strtolower($legoCol['collection']));
            $collection = new Collection($name, $link);

            array_push($result, $collection);
            
        }

        return $result;
        

    }


    public function getAllLegos(): array
    {
        $pdo = new PDO("mysql:host=mysql;dbname=lego_store", 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->query("SELECT * FROM lego");
        $statement->execute();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = $this->createLego($data);

        return $result;

    }

    public function getLegosByCollection($collection): array
    {
        $pdo = new PDO("mysql:host=tp-symfony-mysql;dbname=lego_store", 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->prepare("SELECT * FROM lego WHERE collection = :collection");
        $statement->bindParam(':collection', $collection);
        $statement->execute();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = $this->createLego($data);

        return $result;
    }

    public function getAllCollections(): array
    {

        $pdo = new PDO("mysql:host=mysql;dbname=lego_store", 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $statement = $pdo->query("SELECT DISTINCT collection FROM lego");
        $statement->execute();

        $data = $statement->fetchAll(PDO::FETCH_ASSOC);

        $result = $this->createCollection($data);

        return $result;

        
    }
}
