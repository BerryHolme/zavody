<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Seznam registrovaných uživatelů</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            background-color: #007BFF;
            color: #fff;
            padding: 20px 0;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: #007BFF;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<h1>Seznam registrovaných uživatelů</h1>
<table>
    <thead>
    <tr>
        <th>ID</th>
        <th>Jméno</th>
        <th>Heslo</th>
        <th>Akce</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach (($user?:[]) as $radek): ?>
        <tr>
            <td><?= ($radek['id']) ?></td>
            <td><?= ($radek['name']) ?></td>
            <td><?= ($radek['password']) ?></td>
            <td><a href="/smazat<?= ($radek['id']) ?>">SMAZAT</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>
</html>
