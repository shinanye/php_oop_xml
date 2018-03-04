<?php
    // require "Main.class.php";
    function __autoload($fileName){
        $fileName = $fileName.".class.php";
        require $fileName;
    }
    $main = new Main();
    if(!empty($_POST)){
        $main->dataHandler();
    }else{
        $main->viewHandler();
    }



