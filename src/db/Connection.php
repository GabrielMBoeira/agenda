<?php

class Connection {

    public static function connectionDB() {

        $envPath = realpath(dirname(__FILE__) . '/../env.ini');
        $env = parse_ini_file($envPath);

        $conn_string = "host=" . $env['host'] . " port=" . $env['port'] . 
        " dbname=" . $env['database'] . " user=" . $env['user'] . " password=" . $env['password'] . "";
        $conn = pg_connect($conn_string);

        if (!$conn) {
            echo "Error " . pg_last_error();
        }

        return $conn;
    }
}