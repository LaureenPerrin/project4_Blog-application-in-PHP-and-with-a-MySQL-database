<?php

namespace projet4\services;

//Service pour vérifier si l'admin est bien connecter à la session :
class CheckSessionLoginService
{
    public static function IdSessionVerification($idSession, $idSessionDataBase)
    {
        return $idSession == $idSessionDataBase;
    }
}
