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
    const KEY_QUEUE = 'newTweets';

    static protected function setMQ($value){
        $r = parent::Redis();
        $messages = json_decode($r->get(self::KEY_QUEUE), true);
        $messages[] = $value;
        $r->set(self::KEY_QUEUE, json_encode($messages));
    }

    static protected function getMQ(){
        return (array)json_decode(parent::Redis()->get(self::KEY_QUEUE), true);
    }

    static protected function removeMQ(){
        $r = parent::Redis();
        $r->set(self::KEY_QUEUE, "[]");
    }
}