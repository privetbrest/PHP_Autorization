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
                            <p><input type="login" name="login" placeholder="Login" value="<?php echo $login; ?>"/><p>
                            <p><input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/></p>
                            <input type="submit" name="submit" class="btn btn-default" value="Вход" s/>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="/template/js/jquery.js"></script>
    <script src="/template/js/main.js"></script>
</body>
</html>