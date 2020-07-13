<?php

// src/Model/Entity/User.php
namespace App\Model\Entity;

// class used, inherited from
use Cake\Auth\DefaultPasswordHasher; 
use Cake\ORM\Entity;

class User extends Entity
{

    // provides possibility for password hashing
    protected function _setPassword($value)
    {
        if (strlen($value)) {
            $hasher = new DefaultPasswordHasher();

            return $hasher->hash($value);
        }
    }    

}

