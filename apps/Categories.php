<?php

/**
 * Created by PhpStorm.
 * User: 1
 * Date: 02.06.2020
 * Time: 0:30
 */
class Categories extends Factory
{
    const DB = 'categories';
    /**
     * @return \Categories\Category[]
     */
    static public function GetCategories(){
        $q = parent::DB()->prepare("SELECT * FROM ".self::DB);
        $q->execute();
        return $q->fetchAll(PDO::FETCH_CLASS, "Categories\Category");
    }

}