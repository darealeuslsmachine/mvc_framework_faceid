<?php


class Manage
{

    public static function editUser($userprofile)
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
        $sql = "UPDATE
                users,
                subordination
                SET
                users.firstname = :firstname,
                users.lastname = :lastname,
                users.patronymic = :patronymic,
                users.email = :email,
                users.login = :login,
                users.password = :password,
                users.phone = :phone,
                subordination.postid = :postid
                ";
       if ($userprofile->img !== null) $sql .= ",img = :img ";

        $sql .= "WHERE
                 users.id = :userid
                 AND
                 subordination.parentid = :parentid
                 AND              
                 subordination.userid = users.id
                 ";

        $query = $DBh->prepare($sql);

        $query->bindParam(':firstname', $userprofile->firstname);
        $query->bindParam(':lastname', $userprofile->lastname);
        $query->bindParam(':patronymic', $userprofile->patronymic);
        $query->bindParam(':email', $userprofile->email);
        $query->bindParam(':login', $userprofile->login);
        $query->bindParam(':password', $userprofile->password);
        $query->bindParam(':phone', $userprofile->phone);
        $query->bindParam(':postid', $userprofile->postid);
        if ($userprofile->img !== null) $query->bindParam(':img', $userprofile->img);

        $query->bindParam(':userid', $userprofile->id);
        $query->bindParam(':parentid', $userprofile->parentid);

        if ($query->execute() === true) {
            return true;
        } else {
            return false;
        }
    }





    public static function getPosts () {

        $DB = new DB;
        $DBh = $DB->connect();

        $sql = "SELECT 
                *
                FROM
                post
                ";
        $query = $DBh->prepare($sql);
        $query->execute();

        return $query->fetchAll();
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

        $userprofile->roleid = 3;//Нужно сделать получение Id роли из БД

        //Insert user to DB
        $sql = 'START TRANSACTION;
                INSERT INTO users (firstname, lastname, patronymic, email, login, password, img, roleid, phone)
                    VALUES (:firstname, :lastname, :patronymic, :email, :login, :password, :img, :roleid, :phone);
                SET @User_ID := LAST_INSERT_ID();
                INSERT INTO subordination (userid, parentid, postid)
                    VALUES (@User_ID, :parentid, :postid);
                COMMIT;';

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
        $query->bindParam(':parentid', $userprofile->parentid);
        $query->bindParam(':postid', $userprofile->postid);

        if ($query->execute() === true) {
            return true;
        } else {
            return false;
        }
    }
}