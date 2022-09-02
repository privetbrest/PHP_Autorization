<?php

/**
 * Контроллер CabinetController
 * Кабинет пользователя
 */
class CabinetController
{

    /**
     * Action для страницы "Кабинет пользователя"
     */
    public function actionIndex()
    {
        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

    /**
     * Action для страницы "Редактирование данных пользователя"
     */
    public function actionEdit()
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
            if (!($login == $_SESSION['user'])) {
                if (!User::checkUserLogin($login)) {
                    $errors[] = 'Такой Login уже используется';
                    $logUse = 'Такой Login уже используется';
                }
            }
            if (!User::checkPassword($password)) {
                $errors[] = 'Пароль не должен быть короче 6-ти символов';
                $pass6 = 'Пароль не должен быть короче 6-ти символов';
            }
            if (!User::checkDataPassword($password)) {
                $errors[] = 'Пароль должен содержать буквы и цифры';
                $passData = 'Пароль должен содержать буквы и цифры';
            }
            if (!User::checkConfirmPassword($password, $confirmPassword)) {
                $errors[] = 'Пароли не совпадают';
                $passConflict = 'Пароли не совпадают';
            }
            if (!User::checkEmail($email)) {
                $errors[] = 'Неправильный email';
                $emailIncorrect = 'Неправильный email';
            }
            // print($_SESSION['emailUser']);
            if (!($email == $_SESSION['emailUser'])) {    
                if (!User::checkUserEmail($email)) {
                    $errors[] = 'Такой Email уже используется';
                    $emailUse = 'Такой Email уже используется';
                }
            }
            if (!User::checkName($name)) {
                $errors[] = 'Имя не должно быть короче 2-х символов';
                $nameLength = 'Имя не должно быть короче 2-х символов';
            }
            
            if ($errors == false) {
                // Если ошибок нет
                // Обновляем данные пользователя пользователя
                $result = User::changeUserData($login, $password, $confirmPassword,$email, $name);
                $reg = "Пользовательские данные обновлены!";
                $_SESSION['user'] = $login;
                $_SESSION['emailUser'] = $email;
            }
        }


                // Подключаем вид
                require_once(ROOT . '/views/cabinet/edit.php');
                return true;
    }

    public function actionDelete()
    {
        //Переменные для ошибок в форму
        $passCorrect = "";
        $del = "";
        $UserDel = "";

        // Переменные для формы
        $password = false;

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
        if (isset($_POST['submit'])) {
            // Если форма отправлена 
            // Получаем данные из формы
            $password = $_POST['password'];
            $login = $_SESSION['user'];
            // Флаг ошибок
            $errors = false;
            
            $userId = User::checkUserData($login, $password);

            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неверный пароль';
                $passCorrect = 'Неверный пароль';
            } else {
                
                $userDel = User::deleteUserData($login, $password);
                // session_unset();
                // // unset ($_SESSION['user']);
                // // $success = "Аккаунт удален";
                // header("Location: /user/logout");
                if ($userDel == false) {
                    // Если данные неправильные - показываем ошибку
                    $del = "NO";
                } else {
                    session_unset();
                // // unset ($_SESSION['user']);
                $success = "Аккаунт удален";
                header("Location: /user/logout");
                }    
            }
        }


                // Подключаем вид
                require_once(ROOT . '/views/cabinet/delete.php');
                return true;
    }
}
