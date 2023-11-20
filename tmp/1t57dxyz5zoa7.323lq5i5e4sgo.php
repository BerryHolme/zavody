<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= ($title) ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #ffffff;
            color: #000000;
            padding: 20px 0;
        }
        header h1 {
            font-size: 36px;
        }
        nav {
            background-color: #007bff;
            padding: 10px 0;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
        }
        nav a:hover {
            text-decoration: underline;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
    </style>
</head>
<body>
<header>
    <h1>Vítejte</h1>
</header>
<nav>
    <a href="/prihlaseni">Přihlásit</a>
    <a href="/registrace">Registrovat</a>
    <a href="/seznam">Seznam</a>
    <a href="/odhlasit">Odhlásit</a>
</nav>
<div class="container">
    <p>
        Vítejte na našem moderním webu. Můžete se přihlásit, zaregistrovat, nebo prozkoumat náš seznam.<br>
        Jste přihlášen jako <?= ($SESSION['user']["name"])."
" ?>
    </p>
</div>
</body>
</html>
