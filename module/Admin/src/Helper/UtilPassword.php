<?php

namespace Admin\Helper;

class UtilPassword {

    public static function generatePassword($password){
        return md5($password);
    }

}