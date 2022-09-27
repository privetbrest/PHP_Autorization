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
        $nameLengthMin = "";
        $reg = "";
        $logSpace = "";
        $nameSpace = "";
        $passChar = "";
        $nameLengthMax ="";

        $errorsLog6 = [];
        $errorsLogSpace = [];
        $errorsLogUse = [];
        $errorsPass6 = [];
        $errorsPassData = [];
        $errorsPassChar = [];
        $errorsPassConflict = [];
        $errorsEmailIncorrect = [];
        $errorsEmailUse = [];
        $errorsNameSpace = [];
        $errorsNameLengthMin = [];
        $errorsNameLengthMax = [];
        $successReg = [];


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
        if (@$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

        // Обработка формы  
        if (isset($_POST['login'])) {

            // Если форма отправлена 
            // Получаем данные из формы
            $login = $_POST['login'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirmPassword'];
            $email = $_POST['email'];
            $name = $_POST['name'];
            
            // Флаг ошибок
            $errors = false;

            header('Content-Type: application/json');

            // Валидация полей
            if (!User::checkLogin($login)) {
                $errors[] = 'Login не должен быть короче 6-ти символов';
                $log6 = 'Login не должен быть короче 6-ти символов';
                
                $errorsLog6 = array (
                    'textLog6' => 'Login не должен быть короче 6-ти символов',
                    'errLog6' => 'errorsLog6',
                );
                echo json_encode($errorsLog6);
                
                exit;
            }

            if (!User::checkSpaceLogin($login)) {
                $errors[] = 'Login не должен содержать пробелы';
                $logSpace = 'Login не должен содержать пробелы';
                $errorsLogSpace = array (
                    'textLogSpace' => 'Login не должен содержать пробелы',
                    'errLogSpace' => 'errorsLogSpace',
                );
                echo json_encode($errorsLogSpace);
                exit;
            }
            if (!User::checkUserLogin($login)) {
                $errors[] = 'Такой Login уже используется';
                $logUse = 'Такой Login уже используется';
                $errorsLogUse = array (
                    'textLogUse' => 'Такой Login уже используется',
                    'errLogUse' => 'errorsLogUse',
                );
                echo json_encode($errorsLogUse);
                exit;
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
                $pass6 = 'Пароль не должен быть короче 6-ти символов';
                $errorsPass6 = array (
                    'textPass6' => 'Пароль не должен быть короче 6-ти символов',
                    'errPass6' => 'errorsPass6',
                );
                echo json_encode($errorsPass6);
                exit;
            }
            if (!User::checkDataPassword($password)) {
                $errors[] = 'Пароль должен содержать буквы и цифры';
                $passData = 'Пароль должен содержать буквы и цифры';
                $errorsPassData = array (
                    'textPassData' => 'Пароль должен содержать буквы и цифры',
                    'errPassData' => 'errorsPassData',
                );
                echo json_encode($errorsPassData);
                exit;
            }
            if (User::checkCharsPassword($password)) {
                $errors[] = 'Пароль не должен содержать спец символы';
                $passChar = 'Пароль не должен содержать спец символы';
                $errorsPassChar = array (
                    'textPassChar' => 'Пароль не должен содержать спец символы',
                    'errPassChar' => 'errorsPassChar',
                );
                echo json_encode($errorsPassChar);
                exit;
            }
            if (!User::checkConfirmPassword($password, $confirmPassword)) {
                $errors[] = 'Пароли не совпадают';
                $passConflict = 'Пароли не совпадают';
                $errorsPassConflict = array (
                    'textPassConflict' => 'Пароли не совпадаюты',
                    'errPassConflict' => 'errorsPassConflict',
                );
                echo json_encode($errorsPassConflict);
                exit;
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
                $emailIncorrect = 'Неправильный email';
                $errorsEmailIncorrect = array (
                    'textEmailIncorrect' => 'Неправильный email',
                    'errEmailIncorrect' => 'errorsEmailIncorrect',
                );
                echo json_encode($errorsEmailIncorrect);
                exit;
            }
            if (!User::checkEmail2($email)) {
                $errors[] = 'Неправильный email';
                $emailIncorrect = 'Неправильный email';
                $errorsEmailIncorrect = array (
                    'textEmailIncorrect' => 'Неправильный email',
                    'errEmailIncorrect' => 'errorsEmailIncorrect',
                );
                echo json_encode($errorsEmailIncorrect);
                exit;
            }
            if (!User::checkUserEmail($email)) {
                $errors[] = 'Такой Email уже используется';
                $emailUse = 'Такой Email уже используется';
                $errorsEmailUse = array (
                    'textEmailUse' => 'Такой Email уже используется',
                    'errEmailUse' => 'errorsEmailUse',
                );
                echo json_encode($errorsEmailUse);
                exit;
            }
            if (!User::checkSpaceName($name)) {
                $errors[] = 'Имя не должно содержать пробелы';
                $nameSpace = 'Имя не должно содержать пробелы';
                $errorsNameSpace = array (
                    'textNameSpace' => 'Имя не должно содержать пробелы',
                    'errNameSpace' => 'errorsNameSpace',
                );
                echo json_encode($errorsNameSpace);
                exit;
            }
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
                $nameLengthMin = 'Имя не должно быть короче 2-х символов';
                $errorsNameLengthMin = array (
                    'textNameLengthMin' => 'Имя не должно быть короче 2-х символов',
                    'errNameLengthMin' => 'errorsNameLengthMin',
                );
                echo json_encode($errorsNameLengthMin);
                exit;
            }
            
            if (!User::checkNameMax($name)) {
                $errors[] = 'Имя не должно быть длинее 25-х символов';
                $nameLengthMax = 'Имя не должно быть длинее 25-х символов';
                $errorsNameLengthMax = array (
                    'textNameLengthMax' => 'Имя не должно быть длинее 25-х символов',
                    'errNameLengthMax' => 'errorsNameLengthMax',
                );
                echo json_encode($errorsNameLengthMax);
                exit;
            }
            
            
            if ($errors == false) {
                // Если ошибок нет
                // Регистрируем пользователя
                $result = User::register($login, $password, $confirmPassword,$email, $name);
                $reg = "Вы зарегистированы!";
                $successReg = array (
                    'textReg' => 'Вы зарегистированы!',
                    'errReg' => 'successReg',
                );
                echo json_encode($successReg);
                exit;
            }
                
            
        }
        }

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

        $errorsLog6 =[];
        $errorsLogPass = [];

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

        if (@$_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

        // Обработка формы
        if (isset($_POST['login'])) {
            
            // Если форма отправлена 
            // Получаем данные из формы
            $login = $_POST['login'];
            $password = $_POST['password'];

            // Флаг ошибок
            $errors = false;

            header('Content-Type: application/json');

            // Валидация полей
            if (!User::checkLogin($login)) {
                $errors[] = 'Login не должен быть короче 6-ти символов';
                $log6 = 'Login не должен быть короче 6-ти символов';
                
                $errorsLog6 = array (
                    'textLog6' => 'Login не должен быть короче 6-ти символов',
                    'errLog6' => 'errorsLog6',
                );
                echo json_encode($errorsLog6);
                exit;
            }
            
            // Проверяем зарегистрирован ли пользователь
            $userId = User::checkUserData($login, $password);

            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
                $userError = 'Неправильные данные для входа на сайт';
                
                $errorsLogPass = array (
                    'textLogPass' => 'Неправильные данные для входа на сайт',
                    'errLogPass' => 'errorsLogPass',
                );
                echo json_encode($errorsLogPass);
                exit;

                // header("Location: user/login");
            } else {
                $_SESSION['user'] = $login;
                $success2 = array (
                    'text' => 'Входим',
                    'succ' => '$seccess2',
                );
                echo json_encode($success2);
                exit;
                $success = "Hello ";
                // // Перенаправляем пользователя в закрытую часть - кабинет
                // header("Location: /cabinet");
            

            }
            
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
