<?php
class Register extends User{
    private $email;
    public $return;
    public function __construct($arr){
        parent::__construct($arr);
        $this->email = $arr["email"];
    }

    public function checkData(){
        $xml = Xml::getXmlInstance();
        if(!is_file("xml/user.xml")){
            $xml->addUser("user",$this->result);
        }
        $userTag = $xml->xml->user;//xml中数据库

        for($i=0;$i<$userTag->count();$i++){
            $item = $userTag[$i];//等价于username
            $attr = $item->attributes();

            if($item==$_POST["user"]){
                $returnArr = array(
                    "msg"=>"用户名已被注册",
                    "code"=>false
                );
                return $returnArr;
            }

            if($attr->pwd==$_POST["pwd"]){
                $returnArr = array(
                    "msg"=>"密码已被使用",
                    "code"=>false
                );
                return $returnArr;
            }

            if($attr->email==$_POST["email"]){
                $returnArr = array(
                    "msg"=>"邮箱已被注册",
                    "code"=>false
                );
                return $returnArr;
            }
        }

        $returnArr = array(//密码、用户名都没有被使用
            "msg"=>"注册成功",
            "code"=>true
        );
        setcookie("username", $this->user);
        $postArr = array($_POST);
        $xml->addUser("user",$postArr);
        return $returnArr;
    }
}