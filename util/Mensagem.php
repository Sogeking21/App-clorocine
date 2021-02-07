<?php

class Mensagem{
    public static function mostar(){
        session_start();
        if (isset($_SESSION["msg"])){
            $msg = $_SESSION["msg"];
            unset($_SESSION["msg"]);
            return "<script>
                M.toast({
                    html: '$msg'
                });
                    </script>
            ";
        }
    }
}