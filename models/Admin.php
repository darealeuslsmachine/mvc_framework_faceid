<?php

class Admin
{
    public static function addPostRole ($newpostrole) {

        $DB = new DB;
        $DBh = $DB->connect();

        $sqlValidation = "SELECT 
                            *
                            FROM
                            post
                            WHERE 
                            name = :name";
        $queryValidation = $DBh->prepare($sqlValidation);
        $queryValidation->bindParam(':name', $newpostrole->name);

        $queryValidation->execute();

        $post = $queryValidation->fetch();

        if ($post) {
            return false;
        }

        $sql = "INSERT INTO post(name)
                VALUES (:name)";

        $query = $DBh->prepare($sql);
        $query->bindParam(':name', $newpostrole->name);

        if ($query->execute() === true) {
            return true;
        } else {
            return false;
        }
    }

    public static function addUser($userprofile)
    {
        $DB = new DB;
        $DBh = $DB->connect();

        //Img logic
        if ($userprofile->img !== null) {

            $IMG = new Image();

            if ($IMG->checkValid($userprofile->img) === true) {
                $userprofile->img = file_get_contents($userprofile->img['tmp_name']);
            } else {
                return false;
            }
        }

        //Insert user to DB
        $sql = 'INSERT INTO users(firstname, lastname, patronymic, email, login, password, img, roleid, phone)
                VALUES (:firstname, :lastname, :patronymic, :email, :login, :password, :img, :roleid, :phone)';

        $query = $DBh->prepare($sql);

        $query->bindParam(':firstname', $userprofile->firstname);
        $query->bindParam(':lastname', $userprofile->lastname);
        $query->bindParam(':patronymic', $userprofile->patronymic);
        $query->bindParam(':email', $userprofile->email);
        $query->bindParam(':login', $userprofile->login);
        $query->bindParam(':password', $userprofile->password);
        $query->bindParam(':img', $userprofile->img);
        $query->bindParam(':roleid', $userprofile->roleid);
        $query->bindParam(':phone', $userprofile->phone);

        if ($query->execute() === true) {
            return true;
        } else {
            return false;
        }
    }
};