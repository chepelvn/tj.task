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
        render('tweets');
    }

    public function GetTweets(){
        $q = parent::DB()->prepare("SELECT * FROM ".parent::DB." ORDER BY CreatedAt DESC");
        $q->execute();
        $items = $q->fetchAll(PDO::FETCH_CLASS, "Tweets\Tweet");

        foreach ($items as $item)
            $item->CreatedAt = date('d.m.Y H:i', strtotime($item->CreatedAt));

        jsonDisplay([
            'result' => compact('items')
        ]);
    }
}