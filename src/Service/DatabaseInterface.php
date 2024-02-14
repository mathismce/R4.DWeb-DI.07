<?php


// Là ou la classe est déclarée (où son fichier se trouve)
namespace App\Service;

use PDO;

use App\Entity\Lego;

class DatabaseInterface
{
    public function getAllLegos(): array
    {

        $pdo = new PDO("mysql:host=mysql;dbname=lego_store", 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $pdo->query("SELECT * FROM lego")->fetchAll(PDO::FETCH_ASSOC);
        return $result;

        
    }

    public function getLegosByCollection(): array
    {
        $pdo = new PDO("mysql:host=mysql;dbname=lego_store", 'root', 'root');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $result = $pdo->query("SELECT * FROM lego WHERE ")->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
