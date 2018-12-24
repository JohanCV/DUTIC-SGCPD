<?php
class Database{
    public static function connect(){
        $database = new mysqli('localhost'
                              ,'root'
                              ,''
                              ,'sgcpd');
        $database->query("SET NAMES 'utf8'");

        return $database;
    }
    public static function connectmoodle(){
        $databasemoodle = new mysqli('190.119.213.85'
                              ,'reportes'
                              ,'reportes'
                              ,'moodle');
        $databasemoodle->query("SET NAMES 'utf8'");

        return $databasemoodle;
    }
}

?>
