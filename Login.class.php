<?php
class Login extends User{
    public $result;
    public function checkData(){
        
        //验证码是否正确
        $returnArr = Tool::validate();
        if(!$returnArr["code"]){
            return $returnArr;
        }
        
        $xml = Xml::getXmlInstance();//xml替代数据库
        $xmlContent = $xml->xml->user;//回去xml/user.xml内容
        print_r($xmlContent);
        echo "<br>";
        echo $xmlContent[0];
        for($i=0;$i<count($xmlContent);$i++){
            $item=$xmlContent[$i];
            
            
            if($_POST["user"]==$item){
                if($item["pwd"]==$_POST["pwd"]){
                    $returnArr = array(//密码、用户名正确
                        "msg"=>"登陆成功",
                        "code"=>true
                    );
                    setcookie("username", $this->user);
                    if(in_array("on",$_POST)){
                        echo "<script> sessionStorage.setItem('username','$this->user');</script>";
                    }
                    return $returnArr;
                }else{
                    $returnArr = array(
                        "msg"=>"密码不正确",
                        "code"=>false
                    );
                    return $returnArr;
                }
            }else{
                $returnArr = array(
                    "msg"=>"用户名不存在",
                    "code"=>false
                );
                return $returnArr;
            }

        }
    }

function getCookie(){
    if(isset($_COOKIE["validate"])){
        return $_COOKIE["validate"];
    }
    return false;
    }
}