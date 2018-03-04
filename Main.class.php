<?php
class Main{
    public function viewHandler(){
        $url = "html/index.html";
        if(isset($_GET["type"])){
            $type = $_GET["type"];
            $filename = "html/".$type.".html";
            $url = is_file($filename)?$filename:"html/index.html";
        }
        include $url;
    }

    public function dataHandler(){
        $className = ucfirst($_GET["type"]);
        $isThat =new $className($_POST);
        $ifSuccess = $isThat->checkData();

        if(!$ifSuccess["code"]){
            Tool::alert($ifSuccess["msg"],"index.php?type=".$_GET["type"]);
        }else{
            Tool::alert($ifSuccess["msg"],"index.php?type=member");
        }

    }
}