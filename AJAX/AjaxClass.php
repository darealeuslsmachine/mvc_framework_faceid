<?php

require "../classes/DB/DB.php";

class AjaxClass

{
    private function connectDB() {

        $DB = new DB;

        return $DB->connect();
    }

    public function getAdminUsers()
    {
        $DB = $this->connectDB();

        $sql = "SELECT
                user.id,
                user.lastname,
                user.firstname,
                user.patronymic,
                user.login,
                user.password,
                role.name AS role
                
                FROM
                users AS user
                
                JOIN role AS role ON (user.roleid = role.id)
                
                WHERE
                user.deleted = 0";
        $query = $DB->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();

        echo json_encode($result);
    }

    public function deleteUser($userid) {
        $DB = $this->connectDB();

        $sql = "UPDATE
        users
        SET
        users.deleted = 1  
        WHERE
        users.id = :userid";
        $query = $DB->prepare($sql);
        $result = $query->execute(array('userid' => $userid));

        echo json_encode($result);
    }

    public function editAdminUser($userid, $firstname,$lastname,$patronymic,$login,$password,$roleid) {

        $DB = $this->connectDB();

        $sql = "UPDATE
                users
                SET
                users.firstname = :firstname,
                users.lastname = :lastname,
                users.patronymic = :patronymic,
                users.login = :login,
                users.password = :password,
                users.roleid = :roleid
                WHERE
                users.id = :userid";
        $query = $DB->prepare($sql);
        $result = $query->execute(
            array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'patronymic' => $patronymic,
                'login' => $login,
                'password' => $password,
                'roleid' => $roleid,
                'userid' => $userid
            )
        );

        echo json_encode($result);
    }

    public function getUserInfo($userid) {

        $DB = $this->connectDB();

        $sql = "SELECT
                user.id,
                user.lastname,
                user.firstname,
                user.patronymic,
                user.login,
                user.password,
                role.name AS role,                
                user.roleid AS roleid
        
                FROM
                users AS user
                
                JOIN role AS role ON (user.roleid = role.id)
                
                WHERE
                user.id = :userid";
        $query = $DB->prepare($sql);
        $query->execute(array('userid' => $userid));
        $result = $query->fetchAll();

        echo json_encode($result);
    }

    public function getPostTable() {

        $DB = $this->connectDB();

        $sql = "SELECT
                *                
                FROM
                post";
        $query = $DB->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();

        echo json_encode($result);
    }

    public function getPostSearch($input_search) {

        $input_search = '%' . $input_search . '%';

        $DB = $this->connectDB();

        $sql = "SELECT
                *                
                FROM
                post AS post
                WHERE
                post.name LIKE :input_search";
        $query = $DB->prepare($sql);
        $query->bindParam(':input_search', $input_search);
        $query->execute();
        $result = $query->fetchAll();

        echo json_encode($result);
    }

    public function getParentSearch($input_search) {

        $input_search = '%' . $input_search . '%';

        $DB = $this->connectDB();

        $sql = "SELECT
                user.id,
                user.roleid,
                CONCAT(user.firstname, ' ', user.lastname) AS fullname
                              
                FROM
                users AS user
                WHERE
                user.roleid = 2
                AND 
                ((user.lastname LIKE :input_search)
                OR
                (user.firstname LIKE :input_search))";
        $query = $DB->prepare($sql);
        $query->bindParam(':input_search', $input_search);
        $query->execute();
        $result = $query->fetchAll();

        echo json_encode($result);
    }

    public function getAllPostTable() {

        $DB = $this->connectDB();

        $sql = "SELECT
                *                
                FROM
                post";
        $query = $DB->prepare($sql);
        $query->execute();
        $result = $query->fetchAll();

        echo json_encode($result);
    }

    public function deleteParent($id) {

        $DB = $this->connectDB();

        $sql = "DELETE FROM
                subordination
                WHERE
                id = :id";
        $query = $DB->prepare($sql);
        $query->bindParam(':id', $id);
        $result = $query->execute();

        echo json_encode($result);
    }

    public function addParent($userid, $parentid, $postid) {

        $DB = $this->connectDB();

        $sql = 'INSERT INTO subordination(userid, parentid, postid)
                VALUES (:userid, :parentid, :postid)';

        $query = $DB->prepare($sql);

        $query->bindParam(':userid', $userid);
        $query->bindParam(':parentid', $parentid);
        $query->bindParam(':postid', $postid);

        $result = $query->execute();

        echo json_encode($result);
    }

    public function editSubordination($subid, $userid, $parentid, $postid) {

        $DB = $this->connectDB();

        $sql = 'UPDATE
                subordination
                SET
                userid = :userid,
                parentid = :parentid,
                postid = :postid
                
                WHERE
                id = :subid';

        $query = $DB->prepare($sql);

        $query->bindParam(':subid', $subid);
        $query->bindParam(':userid', $userid);
        $query->bindParam(':parentid', $parentid);
        $query->bindParam(':postid', $postid);

        $result = $query->execute();

        echo json_encode($result);
    }

    public function getContractorUsers($contractorid)
    {
        $DB = $this->connectDB();

        $sql = "SELECT
                user.id,
                user.lastname,
                user.firstname,
                user.patronymic,
                IF(user.img IS NULL,0,1) AS img,
                post.name AS postname
                
                FROM
                users AS user
                               
                JOIN subordination AS sub ON (sub.userid = user.id)
                JOIN post AS post ON (post.id = sub.postid) 
                
                WHERE
                sub.parentid = :contractorid
                AND
                user.deleted = 0";
        $query = $DB->prepare($sql);

        $query->bindParam(':contractorid', $contractorid);

        $query->execute();
        $result = $query->fetchAll();

        echo json_encode($result);
    }

    public function getManageUserInfo($userid) {

        $DB = $this->connectDB();

        $sql = "SELECT
                user.id,
                user.lastname,
                user.firstname,
                user.patronymic,
                user.login,
                user.password,
                post.name AS postname,
                post.id AS postid                
        
                FROM
                users AS user
                
                JOIN subordination AS sub ON (sub.userid = user.id)
                JOIN post AS post ON (post.id = sub.postid) 
                
                WHERE
                user.id = :userid";
        $query = $DB->prepare($sql);
        $query->execute(array('userid' => $userid));
        $result = $query->fetchAll();

        echo json_encode($result);
    }

    public function editManageUser($userid, $firstname,$lastname,$patronymic,$login,$password, $postid) {

        $DB = $this->connectDB();

        $sql = "UPDATE
                users
                JOIN subordination AS sub ON (sub.userid = users.id)
                JOIN post AS post ON (post.id = sub.postid) 
                SET
                users.firstname = :firstname,
                users.lastname = :lastname,
                users.patronymic = :patronymic,
                users.login = :login,
                users.password = :password,
                sub.postid = :postid
                WHERE
                users.id = :userid";
        $query = $DB->prepare($sql);
        $result = $query->execute(
            array(
                'firstname' => $firstname,
                'lastname' => $lastname,
                'patronymic' => $patronymic,
                'login' => $login,
                'password' => $password,
                'postid' => $postid,
                'userid' => $userid
            )
        );

        echo json_encode($result);
    }
}