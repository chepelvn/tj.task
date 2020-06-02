<?php

/**
 * Created by PhpStorm.
 * User: 1
 * Date: 01.06.2020
 * Time: 22:13
 */
class Factory
{
    /**
     * @var $_redis Redis
     */
    static $_redis;
    /**
     * @var $_connect PDO
     */
    static $_connect;

    /**
     * @return PDO
     */
    static protected function DB(){
        if(!(self::$_connect instanceof PDO)){
            $userName = config('mysql.user');
            $password = config('mysql.pass');
            $host =     config('mysql.host');
            $dataBase = config('mysql.db');
            $dsn = "mysql:dbname=$dataBase;host=$host";
            self::$_connect = new \PDO($dsn, $userName, $password);
            self::$_connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$_connect;
    }

    /**
     * @return Redis
     */
    static protected function Redis(){
        if(!(self::$_redis instanceof Redis)){
            $host = config('redis.host');
            $port = config('redis.port');
            self::$_redis = new Redis();
            self::$_redis->connect($host, $port);
        }
        return self::$_redis;
    }
}