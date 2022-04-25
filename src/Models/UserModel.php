<?php

namespace Mvc\Models;

use Config\Model;
use PDO;

class UserModel extends Model
{
    public function createUser(string $firstname, string $lastname, string $email, string $password)
    {
        $statement = $this->pdo->prepare('INSERT INTO `user`(`firstname`, `lastname`, `email`, `password`) VALUES (:firstname, :lastname, :email, :password)');
        $statement->execute([
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $email,
            'password' => $password
        ]);
    }

    public function findOneByEmail(string $email)
    {
        $statement = $this->pdo->prepare('SELECT * FROM `user` WHERE `email` = :email');
        $statement->execute([
            'email' => $_POST['email']
        ]);

        return $statement->fetch(PDO::FETCH_ASSOC);
    }
}