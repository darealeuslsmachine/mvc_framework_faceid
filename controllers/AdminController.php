<?php

class AdminController
{
    public function actionIndex()
    {
        $session = User::checkLogged(true);
        //$userid = $session->userid;

        $systemrole = User::getSystemRole();

        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

    public function actionAdduser()
    {

        $session = User::checkLogged(true);

        if (isset($_POST['adduser_create'])){

            $userprofile = new stdClass();
            $userprofile->firstname = $_POST['adduser_firstname'];
            $userprofile->lastname = $_POST['adduser_lastname'];
            isset($_POST['adduser_patronymic']) ? $userprofile->patronymic = $_POST['adduser_patronymic'] : $userprofile->patronymic = '';
            isset($_POST['adduser_email']) ? $userprofile->email = $_POST['adduser_email'] : $userprofile->email = '';
            $userprofile->login = $_POST['adduser_login'];
            $userprofile->password = $_POST['adduser_password'];
            empty($_FILES['adduser_img']['tmp_name']) ? $userprofile->img = null : $userprofile->img = $_FILES['adduser_img'];
            $userprofile->roleid = $_POST['adduser_role'];
            isset($_POST['adduser_phone']) ? $userprofile->phone = $_POST['adduser_phone'] : $userprofile->phone = '';

            if (Admin::addUser($userprofile) === true) {
                echo    "<script>
                            alert('Пользователь создан!');
                            window.location.replace('/faceid/admin/adduser');
                        </script>>";
            } else {
                echo "<script>alert('Ошибка! Пользователь не создан!')</script>>";
            }
        }

        require_once(ROOT . '/views/admin/adduser.php');

        return true;
    }

    public function actionSettings()
    {
        $session = User::checkLogged(true);
        //$userid = $session->userid;
        if (isset($_POST['btn_addpost'])) {
            $newpostrole = new stdClass();
            $newpostrole->name = $_POST['input_addpost'];

            if (Admin::addPostRole($newpostrole) === true) {
                echo    "<script>
                            alert('Роль создана!');
                            window.location.replace('/faceid/admin/settings');
                        </script>>";
            } else {
                echo "<script>alert('Ошибка! Роль не создана!')</script>>";
            }
        }

        require_once(ROOT . '/views/admin/settings.php');
        return true;
    }

    public function actionAllpost() {
        $session = User::checkLogged(true);

        if (isset($_POST['btn_addpost'])) {
            $newpostrole = new stdClass();
            $newpostrole->name = $_POST['input_addpost'];

            if (Admin::addPostRole($newpostrole) === true) {
                echo    "<script>
                            alert('Роль создана!');
                            window.location.replace('/faceid/admin/settings/post/all');
                        </script>>";
            } else {
                echo "<script>alert('Ошибка! Роль не создана!')</script>>";
            }
        }

        require_once(ROOT . '/views/admin/settings_allpost.php');
    }

}