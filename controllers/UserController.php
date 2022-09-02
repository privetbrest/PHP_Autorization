<?php

/**
 * Контроллер UserController
 */
class UserController
{
    /**
     * Action для страницы "Регистрация"
     */
    public function actionRegister()
    {
        //Переменные для ошибок в форму
        $log6 = "";
        $logUse = "";
        $pass6 = "";
        $passData = "";
        $passConflict = "";
        $emailIncorrect = "";
        $emailUse = "";
        $nameLength = "";
        $reg = "";
        $logSpace = "";
        $nameSpace = "";
        $passChar = "";
        $nameLengthMax ="";

        // Переменные для формы
        $login = false;
        $password = false;
        $confirmPassword = false;
        $email = false;
        $name = false;
        
        $result = false;

        // Защита от POST инъекций
                                            $jsxss="onabort,oncanplay,oncanplaythrough,ondurationchange,onemptied,onended,onerror,onloadeddata,onloadedmetadata,onloadstart,onpause,onplay,onplaying,onprogress,onratechange,onseeked,onseeking,onstalled,onsuspend,ontimeupdate,onvolumechange,onwaiting,oncopy,oncut,onpaste,ondrag,ondragend,ondragenter,ondragleave,ondragover,ondragstart,ondrop,onblur,onfocus,onfocusin,onfocusout,onchange,oninput,oninvalid,onreset,onsearch,onselect,onsubmit,onabort,onbeforeunload,onerror,onhashchange,onload,onpageshow,onpagehide,onresize,onscroll,onunload,onkeydown,onkeypress,onkeyup,altKey,ctrlKey,shiftKey,metaKey,key,keyCode,which,charCode,location,onclick,ondblclick,oncontextmenu,onmouseover,onmouseenter,onmouseout,onmouseleave,onmouseup,onmousemove,onwheel,altKey,ctrlKey,shiftKey,metaKey,button,buttons,which,clientX,clientY,detail,relatedTarget,screenX,screenY,deltaX,deltaY,deltaZ,deltaMode,animationstart,animationend,animationiteration,animationName,elapsedTime,propertyName,elapsedTime,transitionend,onerror,onmessage,onopen,ononline,onoffline,onstorage,onshow,ontoggle,onpopstate,ontouchstart,ontouchmove,ontouchend,ontouchcancel,persisted,javascript";
                                            $jsxss = explode(",",$jsxss);
                                            foreach($_POST as $k=>$v)
                                            {
                                                if(is_array($v))
                                                {
                                                    foreach($v as $Kk=>$Vv)
                                                    {
                                                        $Vv = preg_replace ( "'<script[^>]*?>.*?</script>'si", "", $Vv );
                                                        $Vv = str_replace($jsxss,"",$Vv);
                                                        $Vv = str_replace (array("*","\\"), "", $Vv );
                                                        $Vv = strip_tags($Vv);
                                                        $Vv = htmlentities($Vv, ENT_QUOTES, "UTF-8");
                                                        $Vv = htmlspecialchars($Vv, ENT_QUOTES);
                                                        $_POST[$k][$Kk] = $Vv;
                                                    }
                                                }
                                                ELSE
                                                {
                                                    //Сначала удаляем любые скрипты для защиты от xss-атак
                                                    $v = preg_replace ( "'<script[^>]*?>.*?</script>'si", "", $v );
                                                    //Вырезаем все известные javascript события для защиты от xss-атак
                                                    $v = str_replace($jsxss,"",$v);
                                                    //Удаляем экранирование для защиты от SQL-инъекций
                                                    $v = str_replace (array("*","\\"), "", $v );
                                                    //Экранируем специальные символы в строках для использования в выражениях SQL
                                                    // $v = mysql_real_escape_string( $v );
                                                    //Удаляем другие лишние теги.	
                                                    $v = strip_tags($v);
                                                    //Преобразуем все возможные символы в соответствующие HTML-сущности
                                                    $v = htmlentities($v, ENT_QUOTES, "UTF-8");
                                                    $v = htmlspecialchars($v, ENT_QUOTES);
                                                    //Перезаписываем GET массив
                                                    $_POST[$k] = $v;
                                                }
                                                
                                            }
// Обработка формы
        // if (@$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {
            
        if (isset($_POST['submit'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $login = $_POST['login'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            $email = $_POST['email'];
            $name = $_POST['name'];
            
            // Флаг ошибок
            $errors = false;
           
            // Валидация полей
            if (!User::checkLogin($login)) {
                $errors[] = 'Login не должен быть короче 6-ти символов';
                $log6 = 'Login не должен быть короче 6-ти символов';
            }
            if (!User::checkSpaceLogin($login)) {
                $errors[] = 'Login не должен содержать пробелы';
                $logSpace = 'Login не должен содержать пробелы';
            }
            if (!User::checkUserLogin($login)) {
                $errors[] = 'Такой Login уже используется';
                $logUse = 'Такой Login уже используется';
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
                $pass6 = 'Пароль не должен быть короче 6-ти символов';
            }
            if (!User::checkDataPassword($password)) {
                $errors[] = 'Пароль должен содержать буквы и цифры';
                $passData = 'Пароль должен содержать буквы и цифры';
            }
            if (User::checkCharsPassword($password)) {
                $errors[] = 'Пароль не должен содержать спец символы';
                $passChar = 'Пароль не должен содержать спец символы';
            }
            if (!User::checkConfirmPassword($password, $confirmPassword)) {
                $errors[] = 'Пароли не совпадают';
                $passConflict = 'Пароли не совпадают';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
                $emailIncorrect = 'Неправильный email';
            }
            if (!User::checkEmail2($email)) {
                $errors[] = 'Неправильный email';
                $emailIncorrect = 'Неправильный email';
            }
            if (!User::checkUserEmail($email)) {
                $errors[] = 'Такой Email уже используется';
                $emailUse = 'Такой Email уже используется';
            }
            if (!User::checkSpaceName($name)) {
                $errors[] = 'Login не должен содержать пробелы';
                $nameSpace = 'Login не должен содержать пробелы';
            }
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
                $nameLength = 'Имя не должно быть короче 2-х символов';
            }
            if (!User::checkNameMax($name)) {
                $errors[] = 'Имя не должно быть длинее 25-х символов';
                $nameLengthMax = 'Имя не должно быть длинее 25-х символов';
            }
            
            
            if ($errors == false) {
                // Если ошибок нет
                // Регистрируем пользователя
                $result = User::register($login, $password, $confirmPassword,$email, $name);
                $reg = "Вы зарегистированы!";
            }
        }
        // }

        // Подключаем вид
        require_once(ROOT . '/views/user/register.php');
        return true;
    }
    
    /**
     * Action для страницы "Вход на сайт"
     */
    public function actionLogin()
    {
        //Переменные для ошибок в форму
        $userError = "";
        $log6 = "";
        $pass6 = "";
        $success = "";
        $user = "";

        // Переменные для формы
        $login = false;
        $password = false;
        
// Защита от POST инъекций
                                            $jsxss="onabort,oncanplay,oncanplaythrough,ondurationchange,onemptied,onended,onerror,onloadeddata,onloadedmetadata,onloadstart,onpause,onplay,onplaying,onprogress,onratechange,onseeked,onseeking,onstalled,onsuspend,ontimeupdate,onvolumechange,onwaiting,oncopy,oncut,onpaste,ondrag,ondragend,ondragenter,ondragleave,ondragover,ondragstart,ondrop,onblur,onfocus,onfocusin,onfocusout,onchange,oninput,oninvalid,onreset,onsearch,onselect,onsubmit,onabort,onbeforeunload,onerror,onhashchange,onload,onpageshow,onpagehide,onresize,onscroll,onunload,onkeydown,onkeypress,onkeyup,altKey,ctrlKey,shiftKey,metaKey,key,keyCode,which,charCode,location,onclick,ondblclick,oncontextmenu,onmouseover,onmouseenter,onmouseout,onmouseleave,onmouseup,onmousemove,onwheel,altKey,ctrlKey,shiftKey,metaKey,button,buttons,which,clientX,clientY,detail,relatedTarget,screenX,screenY,deltaX,deltaY,deltaZ,deltaMode,animationstart,animationend,animationiteration,animationName,elapsedTime,propertyName,elapsedTime,transitionend,onerror,onmessage,onopen,ononline,onoffline,onstorage,onshow,ontoggle,onpopstate,ontouchstart,ontouchmove,ontouchend,ontouchcancel,persisted,javascript";
                                            $jsxss = explode(",",$jsxss);
                                            foreach($_POST as $k=>$v)
                                            {
                                                if(is_array($v))
                                                {
                                                    foreach($v as $Kk=>$Vv)
                                                    {
                                                        $Vv = preg_replace ( "'<script[^>]*?>.*?</script>'si", "", $Vv );
                                                        $Vv = str_replace($jsxss,"",$Vv);
                                                        $Vv = str_replace (array("*","\\"), "", $Vv );
                                                        $Vv = strip_tags($Vv);
                                                        $Vv = htmlentities($Vv, ENT_QUOTES, "UTF-8");
                                                        $Vv = htmlspecialchars($Vv, ENT_QUOTES);
                                                        $_POST[$k][$Kk] = $Vv;
                                                    }
                                                }
                                                ELSE
                                                {
                                                    //Сначала удаляем любые скрипты для защиты от xss-атак
                                                    $v = preg_replace ( "'<script[^>]*?>.*?</script>'si", "", $v );
                                                    //Вырезаем все известные javascript события для защиты от xss-атак
                                                    $v = str_replace($jsxss,"",$v);
                                                    //Удаляем экранирование для защиты от SQL-инъекций
                                                    $v = str_replace (array("*","\\"), "", $v );
                                                    //Экранируем специальные символы в строках для использования в выражениях SQL
                                                    //$v = mysql_real_escape_string( $v );
                                                    //Удаляем другие лишние теги.	
                                                    $v = strip_tags($v);
                                                    //Преобразуем все возможные символы в соответствующие HTML-сущности
                                                    $v = htmlentities($v, ENT_QUOTES, "UTF-8");
                                                    $v = htmlspecialchars($v, ENT_QUOTES);
                                                    //Перезаписываем GET массив
                                                    $_POST[$k] = $v;
                                                }
                                                
                                            }

        // Обработка формы
        if (isset($_POST['submit'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $login = $_POST['login'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;

            // Валидация полей
            if (!User::checkLogin($login)) {
                $errors[] = 'Login не должен быть короче 6-ти символов';
                $log6 = 'Login не должен быть короче 6-ти символов';
            }
           
            // Проверяем зарегистрирован ли пользователь
            $userId = User::checkUserData($login, $password);

            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
                $userError = 'Неправильные данные для входа на сайт';
            } else {
                $_SESSION['user'] = $login;
 
                $success = "Hello ";
                // // Перенаправляем пользователя в закрытую часть - кабинет
                header("Location: /cabinet");
              


            }
        }

        // Подключаем вид
        require_once(ROOT . '/views/user/login.php');
        return true;
    }

    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout()
    {        
        // Удаляем информацию о пользователе из сессии
        unset($_SESSION["user"]);
        
        // Перенаправляем пользователя на главную страницу
        header("Location: /");
    }

}
