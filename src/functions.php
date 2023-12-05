<?php
    function find_user_by_email(string $email) {

        $sql = 'SELECT email password
                FROM users
                WHERE email=:email';

        $statement =db()->prepare($sql);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);
        $statement->execute();

        return $statement->fetch(PDO::FETCH_ASSOC);
    }






?>