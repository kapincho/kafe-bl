<?php
class Validate{
    public static function get( $nameOfVariable, $validate = 'string', $defaultValue = null ){
        return self::doValidate($_GET, $nameOfVariable, $validate, $defaultValue);
    }

    public static function post($nameOfVariable, $validate = 'string', $defaultValue = null){
        return self::doValidate($_POST, $nameOfVariable, $validate, $defaultValue);
    }
    public static function doValidate($InputList, $nameOfVariable, $validate, $defaultValue = null){
        if(isset($InputList[$nameOfVariable])){

            $value = $InputList[$nameOfVariable];

            if($validate == 'string'){
                return strip_tags($value);
            } else if($validate == 'number'){
                return $value * 1;
            }

        } else {
            return $defaultValue;
        }
    }
}