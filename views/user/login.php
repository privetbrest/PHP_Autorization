<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
        <div class="container">
            <div class="row">
                <div>
                    <p align="center"><a id="logPass"></a></p>
                    <div align="center" class="signup-form">
                        <h3>Вход на сайт</h3>
                        <noscript><p>Ваш браузер не поддерживает скрипты!</p></noscript>
                        <form method="post">
                            <p><a id="log6"></a></p>
                            <p><input id="login" type="text" name="login" placeholder="Login" value="<?php echo $login; ?>"/><p>
                            <p><input id="password" type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/></p>
                            <button class="btn btn-primary" type="button" id="submitLog" name="submit">Вход</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="/template/js/main.js?1273455236"></script>
</body>
</html>