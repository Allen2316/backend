<?php

class SuccessMessages{

    //const SUCCESS_ADMIN_NEWCATEGORY_EXISTS = "278ac1ef34d5efb05f9f7d2c2ff26e62";
    const PRUEBA = "278ac1ef34d5efb05f9f7d2c2ff26e62";
    const SUCCESS_SIGNUP_NEWUSER = "838ac1ef34d5efb05f9f7d2c2ff26eac";

    private $successList = [];

    public function __construct()
    {
        $this->successList = [
            //SuccessMessages::SUCCESS_ADMIN_NEWCATEGORY_EXISTS => "El nombre de la categoría ya existe"
            SuccessMessages::PRUEBA => "Este es un mensaje de exito",
            SuccessMessages::SUCCESS_SIGNUP_NEWUSER => "Nuevo usuario registrado correctamente"
        ];
    }

    public function get($hash){
        return $this->successList[$hash];
    }

    public function existKey($key){
        if (array_key_exists($key, $this->successList)) {
            return true;
        }else{
            return false;
        }
    }
}