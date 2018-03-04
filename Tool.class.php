<?php
    class Tool{
        //验证码
        public static function validate(){
            if(!$_COOKIE["validate"]){
                $returnArr = array(
                    "msg"=>"",
                    "code"=>false
                );
                return $returnArr;
            }else{
               if(!($_POST["validate"]==$_COOKIE["validate"])){
                    $returnArr = array(
                        "msg"=>"验证码不正确",
                        "code"=>false
                    );
                    return $returnArr;
                }else{
                    $returnArr = array(
                        "code"=>true
                    );
                    return $returnArr;
                }
            }
            
        }

        //弹出框
        public static function alert($msg="",$href=""){
            # code...
            if($href==""||$msg==""){
                echo "<script>alert('$msg')</script>";
            }else{
                echo "<script>alert('$msg');location.href = '$href';</script>";
            }
        }


        //二维数组中判断是否有某个字段
        public static function deep_in_array($val,$arr){
            foreach($arr as $item){
                if(in_array($val,$item)){
                    return true;
                }
            }
            return false;
        }
    }
