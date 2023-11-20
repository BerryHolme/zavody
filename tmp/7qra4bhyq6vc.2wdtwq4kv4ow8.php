<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Seznam registrovaných</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            margin: 0;
        }

        h1 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
            background-color: #fff;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #0077b6;
            color: #fff;
        }

        td {
            background-color: #f0f0f0;
        }

        tr:nth-child(even) td {
            background-color: #e0e0e0;
        }

        tr:nth-child(odd) td {
            background-color: #f0f0f0;
        }

        .header {
            background-color: #0077b6;
            color: #fff;
            text-align: center;
            padding: 10px;
            box-shadow: 0px 5px 15px -5px #888888;
            display: flex;
            justify-content: space-between;
        }

        .bulletin-button {
            background-color: #004080;
            color: #fff;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }
    </style>
</head>

<body>
<div class="header">
    <h1>Seznam registrovaných uživatelů</h1>
    <button class="bulletin-button" onclick="window.location.href='nastenka/'">Nástěnka</button>
</div>
<table>
    <thead>
    <th>ID</th>
    <th>Jméno</th>
    <th>Email</th>
    <th>Role</th>
    <th>Heslo</th>
    <th>Stav</th>
    <th>Nastavit správcem</th>
    <th>Nastavit na uživatele</th>
    </thead>
    <tbody>
    <?php foreach (($user?:[]) as $uzivatel): ?>
        <tr>
            <td><?= ($uzivatel['id']) ?></td>
            <td><?= ($uzivatel['jmeno']) ?></td>
            <td><?= ($uzivatel['email']) ?></td>
            <td>
                <?= ($uzivatel['role'] == 1 ? 'Administrator' : ($uzivatel['role'] == 2 ? 'Registrovaný' : 'Unknown'))."
" ?>
            </td>
            <td><?= ($uzivatel['heslo']) ?></td>
            <td><?= ($uzivatel['stav']) ?></td>
            <td>
                <form method="POST" action="setadmin/">
                    <input type="hidden" name="email" value="<?= ($uzivatel['email']) ?>">
                    <input type="submit" value="Promote">
                </form>
            </td>
            <td>
                <form method="POST" action="setUser/">
                    <input type="hidden" name="email" value="<?= ($uzivatel['email']) ?>">
                    <input type="submit" value="Demote">
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
</body>

</html>
