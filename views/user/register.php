<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <div>
                    
                    <p align=center><?php echo $reg ?></p>
                        
                    <div align="center" class="signup-form">
                        <h3>Регистрация на сайте</h3>
                        <form action="#" method="post">
                            <a><?php echo $log6; ?></a>
                            <a><?php echo $logSpace; ?></a>
                            <p><a><?php echo $logUse; ?></a></p>
                            <p><input id="login" type="login" name="login" placeholder="Login" value="<?php echo $login; ?>"></p>
                            <a><?php echo $pass6; ?></a>
                            <p><a><?php echo $passData; ?></a></p>
                            <p><a><?php echo $passChar; ?></a></p>
                            <p><input id="password" type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/></p>
                            <a><?php echo $passConflict; ?></a>
                            <p><input id="confirmPassword" type="Password" name="confirmPassword" placeholder="Подтвердите Пароль" value="<?php echo $confirmPassword; ?>"/></p>
                            <a><?php echo $emailIncorrect; ?></a>
                            <p><a><?php echo $emailUse; ?></a><p>
                            <p><input id="email" type="email" name="email" placeholder="E-mail" value="<?php echo $email; ?>"/></p>
                            <a><?php echo $nameLength; ?></a>
                            <a><?php echo $nameLengthMax; ?></a>
                            <a><?php echo $nameSpace; ?></a>
                            <p><input id="name" type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>"/></p>
                            <p><input type="submit" name="submit" class="btn btn-default" value="Регистрация" /></p>
                        </form>

                            
                        </div><!--/sign up form-->
                    
                
                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="/template/js/main.js"></script>
</body>
</html>