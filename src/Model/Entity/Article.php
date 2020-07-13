<?php

// src/Model/Entity/Article.php
namespace App\Model\Entity;

// class used, inherited from
use Cake\ORM\Entity;

class Article extends Entity
{
    // related to "mass assignment" 
    protected $_accessible = [
        '*' => true,
        'id' => false,
        'slug' => false,
    ];
}

