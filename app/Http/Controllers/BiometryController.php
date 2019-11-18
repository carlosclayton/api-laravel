<?php

namespace ApiVue\Http\Controllers;

use ApiVue\Contact;
use ApiVue\Helpers\BiometryHelper;
use http\Exception;
use Illuminate\Http\Request;

class BiometryController extends Controller
{
    public function index(){
        return Contact::all();
    }


    public function store(Request $request){
        //$message = "01+RD+00+D]" . $matricula;
        $sByteInicial = "02 ";
        $sTamanhoMensagem = BiometryHelper::gerarTamanhoString($request->get('message') );
        $sMensagem = BiometryHelper::stringParaHex($request->get('message'));
        $sCheckSun = BiometryHelper::gerarCheckSum($request->get('message'));
        $sByteFinal = " 03";
        $string = $sByteInicial . $sTamanhoMensagem . $sMensagem . $sCheckSun . $sByteFinal;
        $formatString = str_replace(" ", "", $string);
        $msg = BiometryHelper::hex2str($formatString);

        try {

            $ret = BiometryHelper::sendToServer($msg, '10.155.152.113');


            $lista = explode("0{", $ret);
            $hexaPart = explode(" ", BiometryHelper::stringParaHex($lista[1]));
            $bio_hash = implode(" ", array_slice($hexaPart, 0, count($hexaPart) - 2));

            return $bio_hash;
        }catch (Exception $ex) {
            dd($ex);
        }
    }

    public function catraca(Request $request){
        //$message = "01+RD+00+D]" . $matricula;
        $sByteInicial = "02 ";
        $sTamanhoMensagem = BiometryHelper::gerarTamanhoString($request->get('message') );
        $sMensagem = BiometryHelper::stringParaHex($request->get('message'));
        $sCheckSun = BiometryHelper::gerarCheckSum($request->get('message'));
        $sByteFinal = " 03";
        $string = $sByteInicial . $sTamanhoMensagem . $sMensagem . $sCheckSun . $sByteFinal;
        $formatString = str_replace(" ", "", $string);
        $msg = BiometryHelper::hex2str($formatString);

        try {
            $ret = BiometryHelper::sendToServer($msg, '10.155.152.113');
            return $ret;
        }catch (Exception $ex) {
            dd($ex);
        }
    }

    public function saveBiometry(Request $request){

            $cod_msg = "01+ED+00+D]" . $request->get('people') . "}1}0{";
            //$message = $cod_msg . BiometryHelper::hex2str2(trim($request->get('biometry')));

            $sByteInicial = "02 ";
            $sTamanhoMensagem = BiometryHelper::gerarTamanhoString($request->get('biometry'));
            $sMensagem = BiometryHelper::stringParaHex($request->get('biometry'));
            $sCheckSun = BiometryHelper::gerarCheckSum($request->get('biometry'));
            $sByteFinal = " 03";
            $string = $sByteInicial . $sTamanhoMensagem . $sMensagem . $sCheckSun . $sByteFinal;

            $formatString = str_replace(" ", "", $string);
            $msg = BiometryHelper::hex2str($formatString);

            try {

                $ret = BiometryHelper::sendToServer($msg, '10.155.152.113');
                return $ret;
            } catch (Exception $ex) {
                Return 'Error: ' . $ex->getMessage();
            }
    }

}
