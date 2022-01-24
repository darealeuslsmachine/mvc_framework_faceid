<?php

class UserController
{
    public function actionLogin()
    {
        $login = '';
        $password = '';

        if (isset($_POST['btnlogin'])) {

            $login = $_POST['login'];
            $password = $_POST['password'];

            $errors = false;

            if (!isset($_POST['checkboxadmin'])) {

                // Валидация полей
                if (User::checkLogin($login) === false) {
                    $errors[] = 'Пользователь не найден';
                }
                if (User::checkPassword($password) === false) {
                    $errors[] = 'Неверный пароль';
                }

                // Проверяем существует ли пользователь
                $userdata = User::checkUserData($login, $password);

                if ($userdata === false) {
                    // Если данные неправильные - показываем ошибку
                    $errors[] = 'Неверные данные для входа';
                } else {
                    // Если данные правильные, запоминаем пользователя (сессия)
                    User::auth($userdata);

                    // Перенаправляем пользователя в кабинет
                    header("Location: /faceid/manage");
                }
            } else {

                // Проверяем существует ли пользователь
                $userdata = User::checkUserData($login, $password, true);

                if ($userdata === false) {
                    // Если данные неправильные - показываем ошибку
                    $errors[] = 'Неверные данные для входа';
                } else {

                    User::auth($userdata);

                    header("Location: /faceid/admin");
                }
            }


        }

        require_once(ROOT . '/views/user/login.php');

        return true;
    }

    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout()
    {
        session_start();

        unset($_SESSION['user']);
        header("Location: /faceid/user/login");
    }

    public function actionProfile($id)
    {
        $session = User::checkLogged();

        $user = User::getUser($id);

        require_once(ROOT . '/views/user/profile.php');
        return true;
    }

    public function actionEdit($id)
    {
        $session = User::checkLogged();

        $user = User::getUser($id);
        $systemrole = User::getSystemRole();

        //var_dump($user);die;

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

            if ($_SESSION['user']->admin === true) {
                $userprofile->roleid = $_POST['select_role_edit'];
            }

            isset($_POST['input_phone_edit']) ? $userprofile->phone = $_POST['input_phone_edit'] : $userprofile->phone = '';
            //var_dump($userprofile);die;
            if (User::editUser($userprofile) === true) {
                echo    "<script>
                            alert('Пользователь отредактирован!');
                            window.location.replace('/faceid/user/profile/edit/" . $id . "/');
                        </script>>";
            } else {
                echo "<script>alert('Ошибка! Пользователь не отредактирован!')</script>>";
            }
        }

        require_once(ROOT . '/views/user/edit.php');
        return true;
    }
}