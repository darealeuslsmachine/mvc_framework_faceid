<?php


class User
{

    /**
     * Проверяет имя: не меньше, чем 2 символа
     */
    public static function checkLogin($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет имя: не меньше, чем 6 символов
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Проверяем существует ли пользователь с заданными $email и $password
     * @param string $login
     * @param string $password
     * @return mixed : integer user id or false
     */
    public static function checkUserData($login, $password, $admin = false)
    {
        $DB = new DB;
        $DBh = $DB->connect();

        if ($admin === false) {
            $sql = 'SELECT id FROM users WHERE login = :login AND password = :password';

            $query = $DBh->prepare($sql);
            $query->execute(array('login'=>$login,'password'=>$password));

            $user = $query->fetch();
            if ($user) {
                $userinfo = new stdClass();
                $userinfo->userid = $user['id'];
                $userinfo->admin = false;
                return $userinfo;
            }

            return false;
        } else {
            $sql = 'SELECT id FROM users WHERE login = :login AND password = :password AND roleid = 1';

            $query = $DBh->prepare($sql);
            $query->execute(array('login'=>$login,'password'=>$password));

            $user = $query->fetch();

            if ($user) {
                $userinfo = new stdClass();
                $userinfo->userid = $user['id'];
                $userinfo->admin = true;
                return $userinfo;
            }

            return false;
        }

    }

    /**
     * Запоминаем пользователя
     * @param string $email
     * @param string $password
     */
    public static function auth($userdata)
    {
        session_start();

        $_SESSION['user'] = $userdata;

        $timenow = time();

        $DB = new DB;
        $DBh = $DB->connect();

        $sqlGetFirstacc = "SELECT
                        id,
                        firstaccess
                        FROM
                        users
                        WHERE
                        id = :userid";

        $queryFirstacc = $DBh->prepare($sqlGetFirstacc);
        $queryFirstacc->bindParam(':userid', $userdata->userid);
        $queryFirstacc->execute();
        $userFirstacc = $queryFirstacc->fetch();

        if($userFirstacc['firstaccess'] == 0) {
            $sqlSetFirstacc =  "UPDATE
                                users
                                SET
                                firstaccess = :timenow
                                WHERE
                                id = :userid";

            $query = $DBh->prepare($sqlSetFirstacc);

            $query->bindParam(':timenow', $timenow);
            $query->bindParam(':userid', $userdata->userid);

            $query->execute();
        }

        $sqlUpdateLastacc =    "UPDATE
                                users
                                SET
                                lastaccess = :timenow
                                WHERE
                                id = :userid";

        $query = $DBh->prepare($sqlUpdateLastacc);

        $query->bindParam(':timenow', $timenow);
        $query->bindParam(':userid', $userdata->userid);

        $query->execute();
    }

    public static function checkLogged($admin = false)
    {
        session_start();

        if ($admin === false) {
            if (isset($_SESSION['user'])) {
                return $_SESSION['user'];
            }
        } else {
            if (isset($_SESSION['user'])) {
                if ($_SESSION['user']->admin === true) {
                    return $_SESSION['user'];
                } else {
                    header("Location: /faceid/user/login");
                }
            }
        }

        header("Location: /faceid/user/login");
    }

    public static function getUser($id)
    {
        $DB = new DB;
        $DBh = $DB->connect();

        $sql = "SELECT
                user.id,
                user.firstname,
                user.lastname,
                user.patronymic,
                user.email,
                user.login,
                user.password,
                user.img,
                user.phone,
                user.firstaccess,
                user.lastaccess,
                user.country,
                user.roleid AS roleid,
                role.name AS role
                FROM
                users AS user
                JOIN role AS role ON (role.id = user.roleid) 
                WHERE
                user.id = :id";

        $query = $DBh->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        $user = $query->fetch();

        if ($user['img'] !== null) {
            $user['img_b64'] = base64_encode($user['img']);
        } else {
            $user['img_b64'] = null;
        }

        if ($user['phone'] == 0) {
            $user['phone'] = '';
        }

        $sqlSubordination = "SELECT
                             sub.id AS subid,
                             sub.parentid,
                             sub.userid,
                             sub.postid,
                             user.lastname AS parentlastname,
                             user.firstname AS parentfirstname,
                             user.patronymic AS parentpatronymic,
                             post.name AS postname
                             
                             FROM
                             subordination AS sub
                             JOIN users AS user ON (user.id = sub.parentid)
                             JOIN post AS post ON (post.id = sub.postid)
                             WHERE
                             sub.userid = :userid
                             ";
        $querySubordination = $DBh->prepare($sqlSubordination);
        $querySubordination->bindParam(':userid', $id);
        $querySubordination->execute();
        $subs = $querySubordination->fetchAll();

        $user['subs'] = [];
        if ($subs) {
            foreach ($subs AS $sub) {
                array_push($user['subs'], array(
                    'subid' => $sub['subid'],
                    'parentid' => $sub['parentid'],
                    'parentfullname' => $sub['parentlastname'] . ' ' .  $sub['parentfirstname'] . ' ' . $sub['parentpatronymic'],
                    'postid' => $sub['postid'],
                    'postname' => $sub['postname']
                ));
            }
        }

        return $user;
    }

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
                users
                SET
                firstname = :firstname,
                lastname = :lastname,
                patronymic = :patronymic,
                email = :email,
                login = :login,
                password = :password,";

        if ($userprofile->img !== null) $sql .= "img = :img,";
        if ($_SESSION['user']->admin === true) $sql .= "roleid = :roleid,";

        $sql .= "phone = :phone
                WHERE
                id = :id";

        $query = $DBh->prepare($sql);

        $query->bindParam(':id', $userprofile->id);
        $query->bindParam(':firstname', $userprofile->firstname);
        $query->bindParam(':lastname', $userprofile->lastname);
        $query->bindParam(':patronymic', $userprofile->patronymic);
        $query->bindParam(':email', $userprofile->email);
        $query->bindParam(':login', $userprofile->login);
        $query->bindParam(':password', $userprofile->password);
        if ($userprofile->img !== null) $query->bindParam(':img', $userprofile->img);
        if ($_SESSION['user']->admin === true) $query->bindParam(':roleid', $userprofile->roleid);
        $query->bindParam(':phone', $userprofile->phone);

        if ($query->execute() === true) {
            return true;
        } else {
            return false;
        }
    }

    public static function getSystemRole () {

        $DB = new DB;
        $DBh = $DB->connect();

        $sql = "SELECT 
                *
                FROM
                role
                ";
        $query = $DBh->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }
}