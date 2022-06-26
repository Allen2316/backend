<?php

use ErrorMessages as GlobalErrorMessages;

class ErrorMessages
{

    //ERROR_CONTROLLER_METHOD_ACTION
    //const ERROR_ADMIN_NEWCATEGORY_EXISTS = "278ac1ef34d5efb05f9f7d2c2ff26e62";
    const PRUEBA = "278ac1ef34d5efb05f9f7d2c2ff26e62";
    const ERROR_SIGNUP_NEWUSER = "238ac9cf34d5efb05f9a7d2cbff26e62";
    const ERROR_SIGNUP_NEWUSER_EMPTY = "97cbe9cf34d5efb05f9a7d2cbff268cd";
    const ERROR_SIGNUP_NEWUSER_EXISTS = "76ace9cf34d5efb05f9aa32cbff438dd";
    const ERROR_LOGIN_AUTHENTICATE_EMPTY = "12aae9cf34d5efb05f9aa32cbff4aa12";
    const ERROR_LOGIN_AUTHENTICATE_DATA = "13bbe9cf34d5efb05f9aa32cbff4bb13";
    const ERROR_LOGIN_AUTHENTICATE = "14cce9cf34d5efb05f9aa32cbff4cc14";

    private $errorList = [];

    public function __construct()
    {
        $this->errorList = [
            //ErrorMessages::ERROR_ADMIN_NEWCATEGORY_EXISTS => "El nombre de la categoría ya existe"
            ErrorMessages::PRUEBA => "ESTE ES UN MENSAJE DE ERROR",
            ErrorMessages::ERROR_SIGNUP_NEWUSER => "Hubo un error al interntar procesar la solicitud",
            ErrorMessages::ERROR_SIGNUP_NEWUSER_EMPTY => "Llena los campos de usuario y password",
            ErrorMessages::ERROR_SIGNUP_NEWUSER_EXISTS => "Ya existe ese nombre de usuario escoge otro",
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE_EMPTY => "Llena los campos de usuario y password",
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE_DATA => "Nombre de usuario y/o password incorrectos",
            ErrorMessages::ERROR_LOGIN_AUTHENTICATE => "No se puede procesar la solicitud. Ingresa usuario y contraseña"
        ];
    }

    public function get($hash)
    {
        return $this->errorList[$hash];
    }

    public function existKey($key)
    {
        if (array_key_exists($key, $this->errorList)) {
            return true;
        } else {
            return false;
        }
    }
}
