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
        $q = parent::DB()->prepare("SELECT * FROM ".parent::DB);
        $q->execute();
        $items = $q->fetchAll(PDO::FETCH_CLASS, "Tweets\Tweet");

        render('tweets', compact('items'));
    }
}