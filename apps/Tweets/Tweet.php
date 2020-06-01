<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 01.06.2020
 * Time: 22:11
 */

namespace Tweets;

use Categories\Category;

class Tweet extends \TweetsFactory
{
    public $Id;

    public $Username;

    public $Content;

    public $CategoryId;

    public $CreatedAt;

    /**
     * @var $Category Category
     */
    public $Category;

    public function __construct()
    {
        $this->setCategory(Category::findById($this->CategoryId));
    }

    /**
     * @param $Category Category
     */
    private function setCategory($Category){
        $this->Category = $Category;
    }

    public function getCategory(){
        return $this->Category;
    }

    public function getId(){
        return $this->Id;
    }

    public function getContent(){
        return $this->Content;
    }

    public function getCreatedAt(){
        return $this->CreatedAt;
    }

    public function getUsername(){
        return $this->Username;
    }

    /**
     * @param $Id
     * @return $this
     */
    static public function findById($Id){
        $q = parent::DB()->prepare("SELECT * FROM ".parent::DB." WHERE Id = ?");
        $q->execute([$Id]);
        return $q->fetchAll(PDO::FETCH_CLASS, __CLASS__)[0];
    }
}