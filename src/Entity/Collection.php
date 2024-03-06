<?php 

namespace App\Entity;


class Collection {
    private string $link;
    private string $name;

    public function __construct($name, $link)
    {
        $this->name = $name;
        $this->link = $link;
        
    }

    

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function setLink(string $link)
    {
        $this->link = $link;
    }
}

 
 ?>