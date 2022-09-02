<?php

/**
 * Класс User - модель для работы с пользователями
 */
class User
{

    /**
     * Регистрация пользователя 
     * @param string $name <p>Логин</p>
     * @param string $email <p>Пароль</p>
     * @param string $password <p>Email</p>
     * @param string $name <p>Имя</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function register($login, $password, $confirmPassword, $email, $name)
    {   
        //солим пароль
        $salt = "privetbrest";
        $password = md5($password . $salt);
        
        $file = file_get_contents('base/base.json');
        $taskList = json_decode($file,TRUE);
        unset($file);
        $taskList[] = array('login'=>$login,'password'=>$password,'email'=>$email,'name'=>$name);
        file_put_contents('base/base.json',json_encode($taskList));
        unset($taskList);      
    }
    
    /**
     * Проверяет login: не меньше, чем 6 символов
     * @param string $login <p>Login</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkLogin($login)
    {
        if (strlen($login) >= 6) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет логин: отсутствие пробелов
     * @param string $name <p>Имя</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkSpaceLogin($login)
    {
        if (strpos($login, " ") !== false) {
            return false;
        }
        return true;
    }
    
    
    /**
     * Проверяет существует ли пользователь с заданным $login
     * @param string $login <p>Login</p>
     * @return mixed : integer user id or false
     */
    public static function checkUserLogin($login)
    {
        $file = file_get_contents('base/base.json');
        $baseList = json_decode($file,TRUE);
        unset($file);
        foreach($baseList as $loginPattern) {
            foreach($loginPattern as $key => $patt) {
                if($key=='login' & $patt==$login) {
                    return false;
                };
            }
        }
        
        return true;
    }

        /**
     * Проверяет пароль: не меньше, чем 6 символов
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkPassword($password)
    {
        if (strlen($password) >= 6) {
            return true;
        }
        return false;
    }
    
       /**
     * Проверяет пароль: должен состоять из букв и цифр
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkDataPassword($password)
    {
        if (! preg_match('~\d~', $password)) { //нет цифр
            return false;
        } else
        if (! preg_match('~[a-zа-яё]~', $password)) { // нет букв
            return false;
        }
        return true;
    }   
       /**
     * Проверяет пароль: не должен содержать спец символы
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkCharsPassword($password)
    {
        if (preg_match("#^[aA-zZ0-9\-_]+$#",$password)) {
            return false;
         } else {
            return true;
         }
    }

    /**
     * Проверяет подтверждение ппароля: пароли совпадают
     * @param string $password <p>Пароль</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkConfirmPassword($password, $confirmPassword)
    {
        if ($password == $confirmPassword) {
            return true;
        }
        return false;
    }

    
    /**
     * Проверяет email
     * @param string $email <p>Email</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет email, втом числе на корректность домена верхнего уровня
     * @param string $email <p>Email</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkEmail2($email)
    {
        if (preg_match("#^(https?:\/\/)?([0-9A-Za-z]+\.)([A-Za-z]+)([\/\?&]|$)$#",$email)) {
            return false;
         } else {
            return true;
         }
    }

    /**
     * Проверяет существует ли пользователь с заданным email
     * @param string $email <p>Email</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkUserEmail($email)
    {
        $file = file_get_contents('base/base.json');
        $baseList = json_decode($file,TRUE);
        foreach($baseList as $loginPattern) {
            foreach($loginPattern as $key => $patt) {
                if($key=='email' & $patt==$email) {
                    return false;
                };
            }
        }
        return true;
    }

    /**
     * Проверяет имя: отсутствие пробелов
     * @param string $name <p>Имя</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkSpaceName($name)
    {
        if (strpos($name, " ") !== false) {
            return false;
        }
        return true;
    }

     /**
     * Проверяет имя: не меньше, чем 2 символа
     * @param string $name <p>Имя</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkName($name)
    {
        if (strlen($name) >= 2) {
            return true;
        }
        return false;
    }

     /**
     * Проверяет имя: не более, чем 25 символа
     * @param string $name <p>Имя</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function checkNameMax($name)
    {
        if (strlen($name) <= 25) {
            return true;
        }
        return false;
    }

    /**
     * Проверяет зарегистрирован ли пользователь с заданным $login и $password в системе
     * @param string $login <p>Login</p>
     * @return mixed : integer user id or false
     */
    public static function checkUserData($login, $password)
    {
        $salt = "privetbrest";
        $password = md5($password . $salt);
        $file = file_get_contents('base/base.json');
        $baseList = json_decode($file,TRUE);
        foreach($baseList as $loginPattern) {
            foreach($loginPattern as $key => $patt) {
                if($key=='login' & $patt==$login) {
                    $trueData = $loginPattern;
                    foreach($trueData as $key2 => $patt2) {
                        if ($key2 == 'password') {
                            if ($patt2==$password){
                                $trueData2 = $trueData;
                                foreach($trueData2 as $key3 => $patt3) {
                                   if ($key3 == 'email') {
                                    $_SESSION['emailUser'] = $patt3;
                                    return true;
                                   } 
                                }             
                            }
                            return false;
                        }
                    }
                } 
            }
        }
    }

    /**
     * Возвращает идентификатор пользователя, если он авторизирован.<br/>
     * Иначе перенаправляет на страницу входа
     * @return string <p>Идентификатор пользователя</p>
     */
    public static function checkLogged()
    {
        // Если сессия есть, вернем идентификатор пользователя
        if (isset($_SESSION['user'])) {
            return $_SESSION['user'];
        }
        header("Location: /user/login");
    }


    /**
     * Изменение данных пользователя
     * @return array <p>Массив с информацией о пользователе</p>
     */
    public static function changeUserData($login, $password, $confirmPassword,$email, $name)
    {
        $salt = "privetbrest";
        $password = md5($password . $salt);
        $userId = $_SESSION['user'];
        $count = 0;

        $file = file_get_contents('base/base.json');
        $baseList = json_decode($file,TRUE);
        unset($file); 

        foreach($baseList as $loginPattern) {
            foreach($loginPattern as $key => $patt) {
                if($key=='login' & $patt==$userId) {
                    $baseList[$count] = array('login'=>$login, 'password'=>$password, 'email'=>$email, 'name'=>$name);
                    file_put_contents('base/base.json',json_encode($baseList)); // Перекодировать в формат и записать в файл.
                    unset($baseList);
                    return true;
                }
            }
            $count +=1;
        }                              
   }

    /**
     * Удаляет пользователя из базы
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function DeleteUserData($login, $password)
    {   
        $salt = "privetbrest";
        $trueData2 = "";    
        $password = md5($password . $salt);
        $count = 0;
        $file = file_get_contents('base/base.json');
        $baseList = json_decode($file,TRUE);
        unset($file);
        foreach($baseList as $loginPattern) {
            foreach($loginPattern as $key => $patt) {
                if($key=='login' & $patt==$login) {
                    $trueData2 = $loginPattern;
                    foreach($trueData2 as $key2 => $patt2) {
                        if ($key2 == 'password') {
                            if ($patt2==$password){  
                                unset($baseList[$count]);
                                    foreach($baseList as $logpatt) {
                                        $newBase[] = $logpatt;
                                    }
                                unset($baseList);
                                $baseList = $newBase;
                                print_r($baseList);
                                file_put_contents('base/base.json',json_encode($baseList));             
                                return true;
                            }
                            return false;
                        }
                    }
                }
            }
            $count +=1;
        }
    }

    /**
     * Проверяет является ли пользователь гостем
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function isGuest()
    {
        if (isset($_SESSION['user'])) {
            return false;
        }
        return true;
    }

}
