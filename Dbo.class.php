<?php
    class DBO{
       private $servername = "localhost";   //服务器
       private $username = "root";     //用户名
       private $password = "root";    //密码
       private $dbname="backstage"; 
       private $conn;
       private static $instance;//单例

       public function __construct(){
            $this->getConnection();
       }
       public static function getInstance(){
           if(!self::$instance){
                self::$instance = new DBO();
           }
           return self::$instance;
       }
       public function getConnection(){
            $params = array(
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\'' ,   //设置字符集 保证中文不乱码
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,           //设置当前pdo的错误处理方式
            );

            try{
                $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password, $params);
            }catch(PDOException $e){
                echo $e->getMessage();
            }
        }
     
        public function inquire($sql,$arr,$type="fetchAll"){
            $prep = $this->conn->prepare($sql);
            $prep->execute($arr);
            $result = $prep->$type(PDO::FETCH_ASSOC);
            return $result;
        }

        public function insert($sql,$arr)
        {
            $prep = $this->conn->prepare($sql);
            $prep->execute($arr);
        }
    }