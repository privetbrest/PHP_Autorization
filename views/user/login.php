<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
        <div class="container">
            <div class="row">
                <div>
                    <p align="center"><?php echo $userError; ?></p>
                    <div align="center" class="signup-form">
                        <h3>Вход на сайт</h3>
                        <form action="#" method="post">
                            <a><?php echo $log6; ?></a>
                            <p><input id="login" type="login" name="login" placeholder="Login" value="<?php echo $login; ?>"/><p>
                            <p><input id="password" type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/></p>
                            <input id="submit" type="submit" name="submit" class="btn1" value="Вход" />
                        </form>
                        <p id="hello">.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="/template/js/main.js"></script>
</body>
</html>