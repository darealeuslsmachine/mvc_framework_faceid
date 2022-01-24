<?php

class ManageController
{
    public function actionIndex()
    {
        $session = User::checkLogged();

        $posts = Manage::getPosts();

        require_once(ROOT . '/views/manage/index.php');
        return true;
    }

    public function actionProfile($id)
    {
        $session = User::checkLogged();

        $user = User::getUser($id);

        require_once(ROOT . '/views/manage/profile.php');
        return true;
    }

    public function actionEdit($id)
    {
        $session = User::checkLogged();

        $user = User::getUser($id);
        $systemrole = User::getSystemRole();

        if (isset($_POST['edituser_save'])){

            $userprofile = new stdClass();
            $userprofile->id = $id;
            $userprofile->lastname = $_POST['input_lastname_edit'];
            $userprofile->firstname = $_POST['input_firstname_edit'];
            isset($_POST['input_patronymic_edit']) ? $userprofile->patronymic = $_POST['input_patronymic_edit'] : $userprofile->patronymic = '';
            isset($_POST['input_email_edit']) ? $userprofile->email = $_POST['input_email_edit'] : $userprofile->email = '';
            $userprofile->login = $_POST['input_login_edit'];
            $userprofile->password = $_POST['input_pass_edit'];
            empty($_FILES['input_userimg_edit']['tmp_name']) ? $userprofile->img = null : $userprofile->img = $_FILES['input_userimg_edit'];

            $userprofile->postid = $_POST['input_post_edit'];
            $userprofile->parentid = $session->userid;

            isset($_POST['input_phone_edit']) ? $userprofile->phone = $_POST['input_phone_edit'] : $userprofile->phone = '';

            //var_dump($userprofile);die;
            if (Manage::editUser($userprofile) === true) {
                echo    "<script>
                            alert('Пользователь отредактирован!');
                            window.location.replace('/faceid/manage/profile/edit/" . $id . "/');
                        </script>>";
            } else {
                echo "<script>alert('Ошибка! Пользователь не отредактирован!')</script>>";
            }
        }

        require_once(ROOT . '/views/manage/edit.php');
        return true;
    }

    public function actionAdduser()
    {

        $session = User::checkLogged();

        if (isset($_POST['adduser_create'])){

            $userprofile = new stdClass();
            $userprofile->firstname = $_POST['adduser_firstname'];
            $userprofile->lastname = $_POST['adduser_lastname'];
            isset($_POST['adduser_patronymic']) ? $userprofile->patronymic = $_POST['adduser_patronymic'] : $userprofile->patronymic = '';
            isset($_POST['adduser_email']) ? $userprofile->email = $_POST['adduser_email'] : $userprofile->email = '';
            $userprofile->login = $_POST['adduser_login'];
            $userprofile->password = $_POST['adduser_password'];
            empty($_FILES['adduser_img']['tmp_name']) ? $userprofile->img = null : $userprofile->img = $_FILES['adduser_img'];
            $userprofile->postid = $_POST['adduser_post'];
            $userprofile->parentid = $session->userid;
            isset($_POST['adduser_phone']) ? $userprofile->phone = $_POST['adduser_phone'] : $userprofile->phone = '';

            if (Manage::addUser($userprofile) === true) {
                echo    "<script>
                            alert('Пользователь создан!');
                            window.location.replace('/faceid/manage');
                        </script>>";
            } else {
                echo "<script>alert('Ошибка! Пользователь не создан!')</script>>";
            }
        }

        require_once(ROOT . '/views/manage/adduser.php');

        return true;
    }
}