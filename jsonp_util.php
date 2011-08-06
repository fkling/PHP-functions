<?php
/**
 * @author Felix Kling
 */

/**
 * Decodes a JSONP string and falls back to JSON decoding in case
 * the value passed is not JSONP.
 * 
 * Provides the same interface as the built-in json_decode function
 *
 * @param string $jsonp
 * @param bool $assoc
 *
 * @return mixed
 */
function jsonp_decode($jsonp, $assoc = false) { // PHP 5.3 adds depth as third parameter to json_decode
    $jsonLiterals = array('true' => 1, 'false' => 1, 'null');
    if(preg_match('/^[^[{"\d]/', $jsonp) && !isset($jsonLiterals[$jsonp])) { // we have JSONP
       $jsonp = substr($jsonp, strpos($jsonp, '('));
    }
    return json_decode(trim($jsonp,'();'), $assoc);
}

/**
 * Encodes the value as JSONP with the given function name.
 *
 * @param mixed $value
 * @param string $function_name
 *
 * @return string
 */
function jsonp_encode($value, $function_name = 'cb') { // 5.3 adds options as second parameter to json_encode
    return sprintf('%s(%s);', $function_name, json_encode($value));;
}
