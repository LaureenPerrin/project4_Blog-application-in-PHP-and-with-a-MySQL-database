<?php

namespace projet4\services;

//Service pour vérifier le password et le pseudo de l'admin lors de la connexion à l'espace administrateur :
class PasswordVerificationService
{
    public static function isPasswordCorrect($passwordByPost, $passwordDataBaseAdmin)
    {
        return password_verify($passwordByPost, $passwordDataBaseAdmin);
    }

    public static function isPseudoCorrect($pseudoByPost, $pseudoDataBaseAdmin){
        return $pseudoByPost == $pseudoDataBaseAdmin;
    }
}
