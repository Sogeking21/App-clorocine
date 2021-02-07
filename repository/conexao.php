<?php

class conexao{
    public  static function criar(){
        return new PDO ("sqlite:filmes.db");
    }
}