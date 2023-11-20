<?php

namespace controllers;

class User
{
    public function nastenka(\Base $base)
    {
        if($base->get("SESSION.user")){
            $user = new \models\User();
            $base->set('user', $user->find());
            echo \Template::instance()->render("nastenka.html");
        }else $base->reroute("/prihlaseni");




    }
    public function getPrihlasit(\Base $base)
    {
        $base->set("nahore", "Prihlaseni");
        $base->set("tlacitko", "Přihlásit");

        echo \Template::instance()->render("prihlasit.html");
    }

    public function postprihlasit(\Base $base)
    {
        $user = $base->get("SESSION.user[id]");
        if ($user) {
            $userId = $base->get("SESSION.user[id]");

            if ($userId) {
                // Aktualizace stavu na 0
                $user = new \models\User();
                $loggedInUser = $user->findone(["id=?", $userId]);

                if ($loggedInUser) {
                    $loggedInUser->stav = 0;
                    $loggedInUser->save();
                }
            }

            // Odhlášení a přesměrování
            $base->clear("SESSION.user");
        }

        $email = $base->get("POST.email");
        $user = new \models\User();
        $base->clear("SESSION.user");
        $u = $user->findone(["email=?", $email]);

        if ($u) {  // Check if user exists
            if ($base->get('POST.heslo') == $u->heslo) {
                $u->stav = 1;
                $u->save();
                $base->set("SESSION.user[id]", $u->id);
                $base->set("SESSION.user[name]", $u->jmeno);
                $base->set("SESSION.user[email]", $u->email);
                $base->set("SESSION.user[role]", $u->role);

                $base->reroute("nastenka/");
            } else {
                $base->reroute("prihlaseni/");
            }
        } else {
            // User doesn't exist, redirect to login
            $base->reroute("prihlaseni/");
        }
    }

    public function getregistrace(\Base $base)
    {

        //$base->set("nahore", "Registrace");
        //$base->set("tlacitko", "Registrovat");
        echo \Template::instance()->render("registrovat.html");
    }

    public function postregistrace(\Base $base)
    {
        $user = new \models\User();

        // Check if the email already exists
        $existingUser = $user->findone(["email=?", $base->get('POST.email')]);

        if ($existingUser) {
            // Email already exists, redirect back to registration with a message
            $base->set('registration_error', 'Email is already registered.');
            $base->reroute("/registrace");
        } else {
            // Email is not registered, proceed with registration
            $user->copyfrom($base->get('POST'));
            $user->role = '2'; // Set the default role
            $user->save();
            $base->reroute("/");
        }
    }


    public function getSeznam(\Base $base)
    {
        //$base ->set("SESSION.user[email]","random");

        if($base->get("SESSION.user")){
            $user = new \models\User();
            $base->set('user', $user->find());
            echo \Template::instance()->render("seznam.html");
            //$base->reroute("seznam/");

        }else $base->reroute("/prihlaseni");
    }


    public function smazat(\Base $base)
    {
        $id = $base->get("PARAMS.id");
        $user = new \models\User();
        $uzivatel = $user->findone(["id=?",$id]);
        $uzivatel ->erase();
        $base ->reroute("/seznam");
    }

    public function getOdhlasit(\Base $base)
    {
        // Získání ID přihlášeného uživatele
        $userId = $base->get("SESSION.user[id]");

        if ($userId) {
            // Aktualizace stavu na 0
            $user = new \models\User();
            $loggedInUser = $user->findone(["id=?", $userId]);

            if ($loggedInUser) {
                $loggedInUser->stav = 0;
                $loggedInUser->save();
            }
        }

        // Odhlášení a přesměrování
        $base->clear("SESSION.user");
        $base->reroute("/");
    }


    public function getSeznamchat(\Base $base)
    {
        if($base->get("SESSION.user")){
            $user = new \models\User();
            $base->set('user', $user->find());
            echo \Template::instance()->render("seznam-chat.html");
            //$base->reroute("seznam/");

        }else $base->reroute("/prihlaseni");
    }


    public function postMistnost(\Base $base)
    {
        $receiver_id = $base->get('POST.receiver_id');
        $user = new \models\User();
        $receiver = $user->findone(['id = ?', $receiver_id]);

        // Update precteno to 1 for all messages from sender to receiver
        (new \models\zpravy)->update(
            ['precteno' => 1],
            [
                'odesilatel = ? AND prijemce = ?',
                $base->get('SESSION.user.id'), $receiver_id
            ]
        );

        $messages = (new \models\zpravy)->find([
            '(odesilatel = ? AND prijemce = ?) OR (odesilatel = ? AND prijemce = ?)',
            $base->get('SESSION.user.id'), $receiver_id, $receiver_id, $base->get('SESSION.user.id')],
            ['order' => 'datum ASC']);

        if($messages){
            foreach ($messages as $message)
            {
                if($message->odesilatel == $receiver->id){
                    $message->precteno = 1;
                    $message->save();
                }
            }
        }

        $base->set('receiver', $receiver);
        $base->set('messages', $messages);
        echo \Template::instance()->render('chatovaci-mistnost.html');
    }





    public function getMistnost(\Base $base)
    {

        $receiver_email = $base->get('POST.receiver_email');
        $receiver_jmeno = $base->get('POST.receiver_jmeno');
        $receiver_id = $base->get('POST.receiver_id');

        $base->reroute('/mistnost/?receiver_email=' . $receiver_email . '&receiver_jmeno=' . $receiver_jmeno . '&receiver_id=' . $receiver_id);
    }

    public function postMessage(\Base $base)
    {

        $messageContent = $base->get('POST.obsah');

        $message = new \models\zpravy();
        $message->odesilatel = $base->get("SESSION.user[id]"); // Set the sender's ID
        $message->prijemce = $base->get('POST.receiver_id'); // Set the recipient's ID
        $message->datum = date('Y-m-d H:i:s'); // Set the current timestamp
        $message->obsah = $messageContent; // Set the message content
        $message->save();

        //$base->reroute("/mistnost?receiver_id=" . $base->get('POST.receiver_id'));
        //$base->reroute('/postmistnost/?receiver_email=' . $receiver_email . '&receiver_jmeno=' . $receiver_jmeno . '&receiver_id=' . $receiver_id);

        $receiver_id = $base->get('POST.receiver_id');
        $receiver_email = $base->get('POST.receiver_email');
        $receiver_jmeno = $base->get('POST.receiver_jmeno');

        $receiver_id = $base->get('POST.receiver_id');
        $user = new \models\User();
        $receiver = $user->findone(['id = ?', $receiver_id]);

        $messages = (new \models\zpravy)->find([
            '(odesilatel = ? AND prijemce = ?) OR (odesilatel = ? AND prijemce = ?)',
            $base->get('SESSION.user.id'), $receiver_id, $receiver_id, $base->get('SESSION.user.id')],
            ['order' => 'datum ASC']);

        $base->set('receiver', $receiver);
        $base->set('messages', $messages);
        echo \Template::instance()->render('chatovaci-mistnost.html');
    }

    public function setAdmin(\Base $base)
    {
        $email = $base->get("POST.email");
        $user = new \models\User();
        $base ->clear("SESSION.user");
        $u = $user->findone(["email=?", $email]);
        $u->role = 1;
        $u->save();
        $base->reroute('nastenka/');

    }

    public function setUser(\Base $base)
    {
        $email = $base->get("POST.email");
        $user = new \models\User();
        $base ->clear("SESSION.user");
        $u = $user->findone(["email=?", $email]);
        $u->role = 2;
        $u->save();
        $base->reroute('nastenka/');

    }


}

