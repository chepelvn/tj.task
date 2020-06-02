<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 01.06.2020
 * Time: 22:14
 */

class TweetAdd extends TweetsFactory
{
    public function action(){
        $CategoryId = $_POST['CategoryId'];
        $Username = $_POST['Username'];
        $Content = $_POST['Content'];

        $result = true;
        try{
            $PDO = parent::DB();
            $q = $PDO->prepare("INSERT INTO ".self::DB." (Username, CategoryId, Content, CreatedAt) VALUES(:Username, :CategoryId, :Content, NOW())");
            $q->execute([':Username' => $Username, ':CategoryId' => $CategoryId, ':Content' => $Content]);

            parent::setMQ($PDO->lastInsertId());

        } catch (PDOException $e){
            $result = false;
            echo $e->getMessage();
        }

        jsonDisplay([
            'result' => $result
        ]);
        exit();
    }
}