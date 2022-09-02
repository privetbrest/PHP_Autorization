    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="/template/css/style.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
                    rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
                    crossorigin="anonymous">
        </head>

        <body>   
        
                <section>
                <a href="/"><h1>PHP</h1></a>
                    <div class="container">
                        <div class="row">
                            <h3 align="center">Регистрация и Авторизация</h3>
                        </div>
                    </div>
                </section>
     
        <section>
            <div class="container">
                <div class="row">
                    <div>
                        <div align="center" class="signup-form">
                            <ul class="nav justify-content-center"> 
                                <?php if (User::isGuest()): ?>
                                <li>
                                    <a class="nav-link" href="/user/login/">
                                        <h3>Вход</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="/user/register/">
                                        <h3>
                                            Регистрация</h3>
                                        </a>
                                    </li>
                                <?php else: ?>
                                <li>
                                    <a class="nav-link">
                                        <h3 class="cl1">
                                            <?php echo "Hello " ?><?php echo ($_SESSION['user']) ?>
                                        </h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="/cabinet/">
                                        <h3>Аккаунт</h3>
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="/user/logout/">
                                        <h3>Выход</h3>
                                    </a>
                                </li>
                                <?php endif; ?>
                            </ul>
                        </div>
                        </div>
                </div>
            </div>
        </section>