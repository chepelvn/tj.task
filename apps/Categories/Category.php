<?php

/**
 * Created by PhpStorm.
 * User: 1
 * Date: 01.06.2020
 * Time: 22:49
 */
namespace Categories;

class Category
{
    public $Id;

    public $Title;

    public function getId(){
        return $this->Id;
    }

    public function getTitle(){
        return $this->Title;
    }
}