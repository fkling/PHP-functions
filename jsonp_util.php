<?php

function jsonp_decode($jsonp, $assoc = false) { // PHP 5.3 adds depth as third parameter to json_decode
    if($jsonp[0] !== '[' && $jsonp[0] !== '{') { // we have JSONP
       $jsonp = substr($jsonp, strpos($jsonp, '('));
    }
    return json_decode(trim($jsonp,'();'), $assoc);
}

function jsonp_encode($value, $function_name = 'cb') { // 5.3 adds options as second parameter to json_encode
    return sprintf('%s(%s);', trim($function_name, '();'), json_encode($value));;
}
