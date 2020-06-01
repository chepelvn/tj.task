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

    public function AddTweet(){
        $CategoryId = $_POST['CategoryId'];
        $Username = $_POST['Username'];
        $Content = $_POST['Content'];

        $result = true;
        try{
            $q = parent::DB()->prepare("INSERT INTO ".self::DB." (Username, CategoryId, Content, CreatedAt) VALUES(:Username, :CategoryId, :Content, NOW())");
            $q->execute([':Username' => $Username, ':CategoryId' => $CategoryId, ':Content' => $Content]);
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