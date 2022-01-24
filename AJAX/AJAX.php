<?php

require_once 'AjaxClass.php';

$AJAX = new AjaxClass();

if(isset($_POST['method'])) {
    switch ($_POST['method']) {

        // getAdminUsers
        case 'getAdminUsers':

            $AJAX->getAdminUsers();

            break;

        // deleteAdminUser
        case 'deleteUser':

            $userid = $_POST['userid'];

            $AJAX->deleteUser($userid);
            break;

        // editAdminUser
        case 'editAdminUser':

            $userid = $_POST['userid'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $patronymic = $_POST['patronymic'];
            $login = $_POST['login'];
            $password = $_POST['password'];
            $roleid = $_POST['roleid'];

            $AJAX->editAdminUser(
                $userid,
                $firstname,
                $lastname,
                $patronymic,
                $login,
                $password,
                $roleid
            );
            break;

        // getUserInfo
        case 'getUserInfo':

            $userid = $_POST['userid'];

            $AJAX->getUserInfo($userid);
            break;

        case 'getPostTable':

            $AJAX->getPostTable();
            break;

        case 'getAllPostTable':

            $AJAX->getAllPostTable();
            break;

        case 'getPostSearch':

            $input_search = $_POST['input_search'];

            $AJAX->getPostSearch($input_search);
            break;

        case 'getParentSearch':

            $input_search = $_POST['input_search'];

            $AJAX->getParentSearch($input_search);
            break;

        case 'deleteParent':

            $id = $_POST['subordination'];

            $AJAX->deleteParent($id);
            break;

        case 'addParent':

            $userid = $_POST['userid'];
            $parentid = $_POST['parentid'];
            $postid = $_POST['postid'];

            $AJAX->addParent($userid, $parentid, $postid);
            break;

        case 'editSubordination':

            $subid = $_POST['subid'];
            $userid = $_POST['userid'];
            $parentid = $_POST['parentid'];
            $postid = $_POST['postid'];

            $AJAX->editSubordination($subid, $userid, $parentid, $postid);
            break;

        case 'getContractorUsers':

            $contractorid = $_POST['contractorid'];
            $AJAX->getContractorUsers($contractorid);

            break;

        case 'getManageUserInfo':

            $userid = $_POST['userid'];

            $AJAX->getManageUserInfo($userid);
            break;

        case 'editManageUser':

            $userid = $_POST['userid'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $patronymic = $_POST['patronymic'];
            $login = $_POST['login'];
            $password = $_POST['password'];
            $postid = $_POST['postid'];

            $AJAX->editManageUser(
                $userid,
                $firstname,
                $lastname,
                $patronymic,
                $login,
                $password,
                $postid
            );
            break;
    }
}