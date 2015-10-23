<?php
defined('BASEPATH') or exit('No direct script access allowed');


function encodeString($text)
{

    $CI   =& get_instance();
    $encrypted_string   = $CI->encrypt->encode($text);
    return $encrypted_string;
}

function decodeString($text)
{

    $CI   =& get_instance();
    $plaintext_string = $CI->encrypt->decode($text);
    return $plaintext_string;
}
