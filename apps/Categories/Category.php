<?php

/**
 * Created by PhpStorm.
 * User: 1
 * Date: 01.06.2020
 * Time: 22:49
 */
namespace Categories;

class Category extends \Categories
{
    public $Id;

    public $Title;

    public function getId(){
        return $this->Id;
    }

    public function getTitle(){
        return $this->Title;
    }

    /**
     * @param $id
     * @return \Categories\Category
     */
    static public function findById($id){
        $q = parent::DB()->prepare("SELECT * FROM categories WHERE Id = ?");
        $q->execute([$id]);
        return $q->fetchAll(\PDO::FETCH_CLASS, __CLASS__)[0];
    }
}