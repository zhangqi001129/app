<?php
use App\Model\KeyModel;
//加密
 function encode($content)
 {
     $key = KeyModel::first();
     $encryptData = "";//秘钥字符串
     openssl_public_encrypt($content, $encryptData, $key['public']);
     $mima = base64_encode($encryptData);
     return $mima;
 }
 //解密
function dncode($mima){
    $key=KeyModel::first();
    $data = base64_decode($mima);
    openssl_private_decrypt($data,$go,$key['private']);
    echo $go;
}
?>