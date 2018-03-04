<?php
    abstract class User{
        protected $user;
        protected $pwd;
        public function __construct($arr){
            $this->user = $arr['user'];
            $this->pwd = $arr['pwd'];
        }
        abstract public function checkData();
    }