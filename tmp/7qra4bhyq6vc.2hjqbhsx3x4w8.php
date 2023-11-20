<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vítej</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        a {
            display: inline-block;
            margin: 10px;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #0077b6;
            color: #fff;
            border-radius: 5px;
        }
        a:hover {
            background-color: #005a96;
        }
    </style>
</head>
<body>
<h1>Vítej na nástěnce</h1>


<td><?= ($SESSION['user']['role'] == 1 ? '<a href="seznam/">Seznam uživatelů</a>' : ($SESSION['user']['role'] == 2 ? '' : '')) ?></td>
<a href="seznam-chat/">Seznam uživatelů pro chatování</a>
<a href="odhlasit/">Odhlásit se</a>
</body>
</html>
