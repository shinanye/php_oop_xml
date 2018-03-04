<?php
class Xml{
    private static $xmlInstance;
    private $xmlFilename;
    public $xml;
    public $xmlContent = <<<XML
<?xml version="1.0" encoding="utf-8"?>
<root></root>
XML;

    public static function getXmlInstance(){
        if(!self::$xmlInstance){
            self::$xmlInstance = new Xml();
        }
        return self::$xmlInstance;
    }

    public function __construct(){
        $this->xmlFilename = "xml/user.xml";
        if(!is_file($this->xmlFilename)){//判断文件是否存在
            //文件不存在 创建文件
            file_put_contents($this->xmlFilename,$this->xmlContent);
        }else{
            //文件存在 读取文件
            $this->xml = simplexml_load_file($this->xmlFilename);
        }
    }

    public function addUser($tagname,$result){//等价于一个数据库中的表
        // $tag = $this->xml->addChild("user","lishi");//添加元素节点
        // $tag->addAttribute("name",1);//添加节点属性
        // $this->xml->user[0]="李四";//修改指定节点值
        // $this->xml->user[0]->attributes()->id= "alter";//修改元素节点属性id
        if(count($result)>0){
            foreach($result as $items){
               foreach($items as $key=>$value){
                    // 'username' => string '王五' (length=6)//xml数据类型格式
                    // 'pwd' => string '328231' (length=6)
                    // 'email' => string '23434355@qq.com' (length=15)
                    if($key=="username"||$key=="user"){
                        $tag = $this->xml->addChild($tagname,$value);
                    }
                    if($key=="pwd"){
                            $tag->addAttribute($key,$value);
                    }
                    if($key=="email"){
                        $tag->addAttribute($key,$value);
                    }
               }
            }
        }
        $this->xml->saveXML($this->xmlFilename);
    }
    
}