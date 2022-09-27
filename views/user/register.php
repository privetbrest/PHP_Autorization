<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <div> 
                    <p align=center><a id="reg"></a></p>   
                    <div align="center" class="signup-form">
                        <h3>Регистрация на сайте</h3>
                        <noscript><p>Ваш браузер не поддерживает скрипты!</p></noscript>
                        <form method="post">
                            <p><a id="log6"></a></p>
                            <p><a id="logSpace"></a></p>
                            <p><a id="logUse"></a></p>
                            <p><input id="login" type="text" name="login" placeholder="Login" value="<?php echo $login; ?>"></p>
                            <p><a id="pass6"></a></p>
                            <p><a id="passData"></a></p>
                            <p><a id="passChar"></a></p>
                            <p><input id="password" type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/></p>
                            <p><a id="passConflict"></a></p>
                            <p><input id="confirmPassword" type="Password" name="confirmPassword" placeholder="Подтвердите Пароль" value="<?php echo $confirmPassword; ?>"/></p>
                            <p><a id="emailIncorrect"></a></p>
                            <p><a id="emailUse"></a><p>
                            <p><input id="email" type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>"/></p>
                            <p><a id="nameLengthMin"></a></p>
                            <p><a id="nameLengthMax"></a></p>
                            <p><a id="nameSpace"></a></p>
                            <p><input id="name" type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>"/></p>
                            <button class="btn btn-primary" type="button" id="submitReg" name="submit">Вход</button>
                        </form>

                            
                        </div>
                    
                
                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="/template/js/main.js?1273455236"></script>
</body>
</html>