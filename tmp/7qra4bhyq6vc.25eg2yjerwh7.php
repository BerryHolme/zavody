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
            margin: 0;
        }

        .header {
            background-color: #0077b6;
            color: #fff;
            text-align: center;
            padding: 10px;
            box-shadow: 0px 5px 15px -5px #888888;
            position: fixed;
            width: 100%;
            z-index: 1;
        }

        .back-button {
            background: none;
            border: none;
            color: #fff;
            font-size: 20px;
            cursor: pointer;
            outline: none;
            margin-right: 10px;
        }

        .user-name {
            flex: 1;
            text-align: center;
        }

        .chat-box {
            background-color: #fff;
            border: 1px solid #ccc;
            margin: 60px auto 20px;
            padding: 10px;
            width: 80%;
            border-radius: 10px;
            overflow-y: auto; /* Enable vertical scrolling */
            max-height: 70vh; /* Set a maximum height for the message box */
        }

        .message-box {
            border: 1px solid #ccc;
            margin: 5px 0;
            padding: 15px 15px;
            box-shadow: 3px 3px 5px #888888;
            border-radius: 10px;
            text-align: left;
        }

        .message-form {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 80%;
            margin: 20px auto; /* Adjusted margin */
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0px -5px 15px -5px #888888;
        }

        .message-input {
            flex: 1;
            padding: 5px;
            border-radius: 5px;
        }

        .send-button {
            background-color: #0077b6;
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .message-container {
            display: flex;
            flex-direction: column-reverse; /* Reverse the order of messages */
        }

        .message-container>* {
            margin-bottom: 10px;
        }

        .bold-name {
            font-weight: bold;
        }

        .sender-message {
            background-color: #0077b6;
            color: #fff;
            font-size: 20px;
            border-radius: 10px 30px 10px 10px;
            margin-left: 1000px;
            margin-right: 10px;
            box-shadow: 3px 3px 5px #888888;
        }

        .receiver-message {
            background-color: #001721;
            color: #fff;
            font-size: 20px;
            border-radius: 30px 10px 10px 10px;
            margin-left: 10px;
            margin-right: 1000px;
            box-shadow: 3px 3px 5px #888888;
        }

        .message-time {
            color: #d9d9d9;
            font-size: 12px;
        }

        .mezera {
            color: white;
        }

        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .precteno{

        }
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var messageContainer = document.querySelector('.message-container');
            messageContainer.scrollTo(0, document.body.scrollHeight);
        });
    </script>
</head>

<body>
<div class="header">
    <button class="back-button" onclick="window.location.href='/chat/seznam-chat/'">Zpět</button>
    <div class="user-name"><?= ($receiver['jmeno']) ?></div>
</div>
<div class="center-container">
    <div class="chat-box">
        <div class="message-container">
            <div class="message-box">
                <?php foreach (($messages?:[]) as $message): ?>
                    <div class="<?= ($message['odesilatel'] == $SESSION['user']['id'] ? 'sender-message' : 'receiver-message') ?>">
                        <div class="bold-name"><?= ($message['odesilatel'] == $SESSION['user']['id'] ? 'Ty' : $receiver['jmeno']) ?></div>
                        <?= ($message['obsah'])."
" ?>
                        <div class="precteno"><?= ($message['precteno'] ? 'Přečteno' : 'Nepřečteno') ?></div>
                        <div class="message-time"><?= ($message['datum']) ?></div>
                    </div>
                    <div class="mezera">
                        a
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <div class="message-form">
        <form method="POST" action="/chat/postmessage/">
            <input type="text" name="obsah" class="message-input" placeholder="Napište zprávu..." required>
            <input type="hidden" name="receiver_id" value="<?= ($receiver['id']) ?>">
            <input type="hidden" name="receiver_jmeno" value="<?= ($receiver['jmeno']) ?>">
            <input type="hidden" name="receiver_email" value="<?= ($receiver['email']) ?>">
            <input type="submit" value="Odeslat" class="send-button">
        </form>
    </div>
</div>
</body>

</html>
