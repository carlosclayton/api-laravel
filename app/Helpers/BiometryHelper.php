<?php

namespace ApiVue\Helpers;

class BiometryHelper
{

//    CONST HOST = "10.155.152.110";
    CONST PORT = 3000;

    public static function gerarTamanhoString($sString)
    {
        $nTamanhoString = strlen($sString);
        $nHex1 = $nTamanhoString % 256;

        $nHex16 = (int)($nTamanhoString / 256);

        $nHex1 = dechex($nHex1);
        if (strlen($nHex1) === 1)
            $nHex1 = "0" . $nHex1;

        $nHex16 = dechex($nHex16);
        if (strlen($nHex16) === 1)
            $nHex16 = "0" . $nHex16;

        $sResultado = $nHex1 . " " . $nHex16;

        return strtoupper($sResultado);
    }

    public static function stringParaHex($sString)
    {
        $sHex = "";
        $vString = str_split($sString);
        foreach ($vString as $sCharactere)
            $sHex .= " " . str_pad(dechex(ord($sCharactere)), 2, "0", STR_PAD_LEFT);
        return strtoupper($sHex);
    }

    public static function gerarCheckSum($sString)
    {
        $nTamanhoString = strlen($sString);

        $sXor = 0;
        $vString = str_split($sString);

        for ($x = 0; $x < count($vString); $x++) {
            $sXor ^= ord($vString[$x]);
        }

        $sXor ^= $nTamanhoString % 256;
        $sXor ^= $nTamanhoString / 256;

        $nHex1 = $sXor % 16;
        $nHex16 = (int)($sXor / 16);

        $sResultado = " " . dechex($nHex16) . dechex($nHex1);

        return strtoupper($sResultado);
    }

    public static function hex2str($hex)
    {
        $str = '';
        for ($i = 0; $i < strlen($hex) - 1; $i += 2) {
            $str .= chr(hexdec(substr($hex, $i, 2)));
        }
        return $str;
    }

    public static function hex2str2($hex){
        $str = '';
        $hex = explode(" ", $hex);

        for ($i=0; $i < count($hex) -1; $i++){

            //echo chr(hexdec(substr($hex,$i,2)));
            //hexdec(substr($hex,$i,2)); // Convertendo pra decimal
            //echo "<br />";
            $str .= chr(hexdec($hex[$i])); // COnvertendo pra ASCII
        }
        return $str;
    }

    public static function sendToServer($msg, $host)
    {
        try{
            $socket = socket_create(AF_INET, SOCK_STREAM, 0) or die("Could not create socket\n");
            socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => 1, 'usec' => 0));
            socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array('sec' => 1, 'usec' => 0));
            $result = socket_connect($socket, $host, BiometryHelper::PORT) or die("Could not connect to server\n");
            socket_write($socket, $msg, strlen($msg)) or die("Could not send data to server\n");
            $msg1 = socket_read($socket, 8192);

//        echo "<br>sent to server:$msg<br> response from server was:" . $msg1 . "<br>";
//        echo "<br>Bytes send to server:" . BiometryHelper::stringParaHex($msg) . "<br> Bytes response from server was:" . BiometryHelper::stringParaHex($msg1) . "<br>";


            socket_close($socket);
            return $msg1;
        }catch (\Exception $ex){
            dd('ERROR: ' . $ex);
        }

    }
}