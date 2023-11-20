<?php

namespace controllers;

class prihlasit
{

    public function getPrihlasit(\Base $base)
    {
        $base->set ('error_msg_prihlaseni', '' );
        echo \Template::instance()->render("prihlasit.html");
    }

    public function postPrihlasit(\Base $base)
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
                $base->set("SESSION.user[jmeno]", $u->jmeno);
                $base->set("SESSION.user[prijmeni]", $u->prijmeni);
                $base->set("SESSION.user[email]", $u->email);
                $base->set("SESSION.user[image]", $u->image);
                $base->set("SESSION.user[role]", $u->role);

                $base->reroute("nastenka/");
            } else {
                $base->set ('error_msg_prihlaseni', 'Špatné heslo' );
                echo \Template::instance()->render("prihlasit.html");
            }
        } else {
            $base->set ('error_msg_prihlaseni', 'Uživatel neexistuje' );
            echo \Template::instance()->render("prihlasit.html");
        }
    }








}
