<?php 

namespace App\Entity;

class Lego
{
    private int $id;
    private string $name;
    private string $collection;
    private string $description;
    private float $price;
    private int $pieces;
    private string $boxImage;
    private string $legoImage;
    

    public function __construct(int $id, string $name, string $collection)
    {
        $this->id = $id;
        $this->name = $name;
        $this->collection = $collection;
        
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getCollection(): string
    {
        return $this->collection;
    }

    public function setCollection(string $collection)
    {
        $this->collection = $collection;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description)
    {
        $this->description = $description;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price)
    {
        $this->price = $price;
    }

    public function getPieces(): int
    {
        return $this->pieces;
    }

    public function setPieces(int $pieces)
    {
        $this->pieces = $pieces;
    }

    public function getBoxImage(): string
    {
        return $this->boxImage;
    }

    public function setBoxImage(string $boxImage)
    {
        $this->boxImage = $boxImage;
    }

    public function getlegoImage(): string
    {
        return $this->legoImage;
    }

    public function setlegoImage(string $legoImage)
    {
        $this->legoImage = $legoImage;
    }

}


 
 ?>