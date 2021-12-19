<?php

class conexao
{
    public  static function criar(): PDO
    {
        $env = parse_ini_file(".env");
        $databasetype = $env["databasetype"];
        $database = $env["database"];
        $server = $env["server"];
        $user = $env["user"];
        $pass = $env["pass"];

        if ($databasetype === "mysql") {
            $database = "host=$server;dbname=$database";
        }
        return new PDO("$databasetype:$database", $user, $pass);
    }
}
