<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <div>
                    <div align="center" class="signup-form">
                        <h3>Удаление аккаунта</h3>
                        <form action="#" method="post">
                            <a><?php echo $del; ?></a>
                            <a><?php echo $passCorrect; ?></a>
                            <p><input type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/></p>
                            <p><input type="submit" name="submit" class="btn btn-default" value="Удалить аккаунт" /></p>
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