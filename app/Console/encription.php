<?php

namespace App\Console;

class encription
{
    public static function encryptdata($plain)
    {
        $aeskey="A3BB18B5E19B1ACBE661AFFC228A01B4";
        $ivkey="3AF472DB3BF7DCCB";
        return bin2hex(openssl_encrypt($plain, "aes-128-cbc", $aeskey, OPENSSL_RAW_DATA,$ivkey));
    }

    public static function decryptdata($encriptedData)
    {
        $aeskey="A3BB18B5E19B1ACBE661AFFC228A01B4";
        $ivkey="3AF472DB3BF7DCCB";
        $ciphertext = hex2bin($encriptedData);
        return openssl_decrypt($ciphertext, "aes-128-cbc",$aeskey, OPENSSL_RAW_DATA, $ivkey);
    }
}
