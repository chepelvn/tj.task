<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 01.06.2020
 * Time: 22:14
 */

class TweetsFactory extends \Factory
{
    const DB = 'tweets';
    const DB_CATEGORY = 'categories';

    /**
     * @return \Categories\Category[]
     */
    static public function GetTweetCategories(){
        $q = parent::DB()->prepare("SELECT * FROM ".self::DB_CATEGORY);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        return $q->fetchAll(PDO::FETCH_CLASS, "Categories\Category");
    }
}