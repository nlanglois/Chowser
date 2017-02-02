<?php

/**
 * Created by PhpStorm.
 * User: nlangloi10
 * Date: 2/1/17
 * Time: 10:56 PM
 */

namespace app\components;

class MyHelpers
{

    static public function convertM2MobjectsToString($array, $attribute) {

        $string = "";
        foreach ($array as $itemObject) {
            $string .= $itemObject->$attribute . ", ";
        }

        return $string = substr($string, 0, -2);

    }

}