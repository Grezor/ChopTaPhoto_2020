<?php

namespace App\Controllers;


use App\Class\Session;
use App\Class\Validator;
use App\Database\Database;
use App\Entities\User;
use App\Responses\HttpResponse;

class AuthController
{
    private $db;
    private array $errors = [];

    // public function __construct()
    // {
    //     $this->db = $db;
    // }

    public function showLogin(): HttpResponse
    {
        return new HttpResponse(200, 'Auth/Login', 'Front');
    }

    public function login()
    {

    }

    public function showRegister(): HttpResponse
    {
        return new HttpResponse(200, 'Auth/Register', 'Front');
    }

    public function register(): HttpResponse
    {
        $db = Database::getDatabase();
        
        $validator = new Validator($_POST);
        $validator->alphaNumeriQ('name', "Votre nom n'est pas disponible");
        $validator->uniq('name', $db, 'client', 'ce pseudo est déja pris');

        $validator->uniq('firstname', $db, 'client', 'ce firstname est déja pris');

        $validator->email('email', "cette email est déja pris");
        $validator->uniq('email', $db, 'client', 'ce email est déja pris pour un autre compte');

        $validator->confirmedPassword('password', 'Vous devez rentrer un mot de passe valide');

        if ($validator->isValid()) {
            $auth = new User();
            $user_id = $auth->insertRegister($db, $_POST['name'], $_POST['firstname'], $_POST['password'], $_POST['email']);
            
            Session::getInstance()->messageFlash('success', 'Un email de vérification vous a été envoyé, merci de cliquer sur le lien pour 
            confirmer votre adresse email');
            return new HttpResponse(200, 'Auth/Login', 'login', []);
            exit();
        } else {
            $errors = $validator->errors();
            return $errors;
        }
    }

    public function confirmEmail($db, int $user_id, $token, $session)
    {
        $user = $db->query('SELECT * FROM client WHERE id = ?', [$user_id])->fetch();

        if ($user && $user->confirmation_token = $token) {
            $db->query('UPDATE client SET confirmation_token = null, confirmed_at = NOW() WHERE id = ?', [
                $user_id
            ]);
            $session->write('auth', $user);
            return true;
        }
        return false;
    }


    public function restriction($session)
    {
        if (!$session->read('auth')) {
           $session->setFlash('danger', "Vous n'avez pas les droits");
           return new HttpResponse(200, 'Auth/Login', 'login', []);
           exit();
        }
    }
}
