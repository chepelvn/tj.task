<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 01.06.2020
 * Time: 22:12
 */

class Tweets extends TweetsFactory
{
    public function action(){
        $q = parent::DB()->prepare("SELECT * FROM ".parent::DB_CATEGORY);
        $q->execute();
        $q->setFetchMode(PDO::FETCH_ASSOC);
        $items = $q->fetchAll();

        return render('tweets');
    }
}