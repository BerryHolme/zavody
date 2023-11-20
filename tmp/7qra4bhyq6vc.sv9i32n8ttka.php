<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
        }
        .header {
            background-color: #0077b6;
            color: #fff;
            display: flex;
            justify-content: space-between;
            padding: 10px;
        }
        .back-button {
            background-color: #0077b6;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
        .user-name {
            color: #fff;
            font-weight: bold;
        }
        .chat-box {
            background-color: #fff;
            border: 1px solid #ccc;
            margin: 20px auto;
            padding: 10px;
            width: 80%;
        }
        .message-form {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }
        .message-input {
            flex: 1;
            padding: 5px;
        }
        .send-button {
            background-color: #0077b6;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="header">
    <button class="back-button" onclick="window.location.href='seznam-chat/'">Zpět</button>
    <div class="user-name"><?= ($receiver['jmeno']) ?></div>
</div>
<div class="left-messages">
    <h2>Zprávy od <?= ($receiver['jmeno']) ?></h2>
    <ul>
        <?php foreach (($left_messages?:[]) as $message): ?>
            <li><?= ($message['obsah']) ?></li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- Display right (sender) messages -->
<div class="right-messages">
    <h2>Vaše zprávy</h2>
    <ul>
        <?php foreach (($right_messages?:[]) as $message): ?>
            <li><?= ($message['obsah']) ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<div class="message-form">
    <form method="POST" action="postzprava/">
        <input type="text" class="message-input" placeholder="Napište zprávu...">
    </form>
    <a href="zprava/">Odeslat</a>
</div>
</body>
</html>
