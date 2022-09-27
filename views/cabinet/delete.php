<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">
                <div>
                    <div align="center" class="signup-form">
                        <h3>Удаление аккаунта</h3>
                        <noscript><p>Ваш браузер не поддерживает скрипты!</p></noscript>
                        <form method="post">
                            <p><a id="passCorrect"></a></p>
                            <p align="center"><a id="del"></a><p>
                            <p><a id="passCorrect"></a></p>
                            <p><input id="password" type="password" name="password" placeholder="Пароль" value="<?php echo $password; ?>"/></p>
                            <button class="btn btn-primary" type="button" id="submitDel" name="submit">Удалить аккаунт</button>
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