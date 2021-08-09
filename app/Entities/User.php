<?php

namespace App\Entities;

use App\Class\Session;
use App\Database\Database;
use PDO;

class User
{
    public const ROLE_ADMIN = 1;
    public const ROLE_BUYER = 2;
  

    private int $id;
    private string $name;
    private string $firstname;
    private string $email;
    private string $password;
    private int $role;
    private string $errors;
    private $data;
    private Database $db;

    // public function __construct(Database $db) {
    //     $this->db = $db;
    // }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    /**
     * generate token
     *
     * @param int $length
     * @return string
     */
    static function strRandom($length): string
    {
        $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
        return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
    }

    /**
     * Insert to Database
     *
     * @param string $name
     * @param string $password
     * @param string $email
     * @return void
     */
    public function insertRegister($db, string $name, string $firstname, string $password, string $email)
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $token = User::strRandom(60);

         $db->query("INSERT INTO client SET name = ?, firstname = ?, email = ?, password = ?, email_token = ?, register_at = now(), role = '2'", 
         [
            $name,
            $_POST['firstname'],
            $email,
            $password,
            $token,
        ]);
        
        $user_id = $this->db->getPDO()->lastInsertId();

        $subject = 'le sujet';
        $message = "Afin de valider votre compte \n\nhttp://localhost:3000/confirm/$user_id/$token";
        $headers = 'From: webmaster@example.com' . "\r\n" .
        'Reply-To: webmaster@example.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();
   
        mail($email, $subject, $message, $headers);
        // mail($email, 'confirmation de votre compte', "");
    }

}
