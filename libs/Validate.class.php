<?php
    class Validate{
        public function isNumber($str){
            $preg = '/^[0-9]+$/';
            return preg_match($preg,$str);
        }
        public function isString($str){
            $preg = '/^[a-z A-Z]+$/';
            return preg_match($preg,$str);
        }
        public function isEmail($str){
            $preg = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
            return preg_match($preg,$str);
        }
    }