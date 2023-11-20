<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrovat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        h2 {
            color: #333;
        }
        .form-group {
            margin: 10px 0;
        }
        label {
            display: block;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #0077b6;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #005a96;
        }
        a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #0077b6;
        }
    </style>
</head>
<body>
<div class="container">
    <!-- Add this somewhere in your registration form -->


    <h2>Registrace</h2>
    <form method="POST">
        <div class="form-group">
            <label for="name">Jméno:</label>
            <input type="text" id="name" name="jmeno" required placeholder="Uživatelské jméno">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Heslo:</label>
            <input type="password" id="password" name="heslo" required placeholder="Heslo">
        </div>
        <div class="form-group">
            <input type="submit" value="Registrovat">
        </div>
    </form>
</div>

<a href="prihlaseni/">Přihlásit</a>

</body>
</html>
