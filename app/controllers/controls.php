<?php

namespace controllers;

use function React\Promise\all;

class controls
{
    public function getNastenka(\Base $base)
    {
        if ($base->get("SESSION.user")) {
            $user = new \models\User();
            $base->set('user', $user->find());

            $zavodnikId = $base->get("SESSION.user.id");

            // Check if there is any data in the zavodnik table for the current user
            $zavodnik = (new \models\zavodnik)->find(['id_zavodnika' => $zavodnikId]);

            if (!$zavodnik) {
                // If no zavodnik records found, display all zavody without filtering
                $zavod = (new \models\zavody)->find();
                $base->set('zavody', $zavod);
                $base->set('nastenkaError', 'No records found for the current user in the zavodnik table.');
                echo \Template::instance()->render("nastenka.html");
                return;
            }

            $zavod = (new \models\zavody)->find();

            $ignore = array();

            foreach ($zavodnik as $zavodnika) {
                if (($zavodnika->id_zavodnika) == ($base->get("SESSION.user.id"))) {
                    $ignore[] = $zavodnika->id_zavodu;
                }
            }

            $zavodArray = iterator_to_array($zavod);

            // Filter the $zavodArray array based on values in $ignore
            $filteredZavod = array_filter($zavodArray, function ($zavodItem) use ($ignore) {
                return !in_array($zavodItem->id, $ignore);
            });

            $base->set('zavody', $filteredZavod);

            $ignoreString = implode(',', $ignore);
            $base->set('nastenkaError', '');

            echo \Template::instance()->render("nastenka.html");
        } else {
            $base->reroute("/prihlaseni");
        }
    }








    public function getOdhlasit(\Base $base)
    {
        $userId = $base->get("SESSION.user[id]");

        if ($userId) {
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

    public function getUcet(\Base $base)
    {
        /*if($base->get("SESSION.user")){
            echo \Template::instance()->render("ucet.html");
        }else {
            $base->set ('error_msg_prihlaseni', 'Pro zobrazení stránky se musíte přihlásit' );
            echo \Template::instance()->render("prihlasit.html");
        }*/

        echo \Template::instance()->render("ucet.html");

    }

    public function getAdmin(\Base $base)
    {
        /*if($base->get("SESSION.user")){
            if('SESSION.user.role'=='1'){
                echo \Template::instance()->render("admin.html");
            }else{
                $base->set ('error_msg_prihlaseni', 'Pro zobrazení této stránky nemáte oprávnění' );
                echo \Template::instance()->render("prihlasit.html");
            }

        }else {
            $base->set ('error_msg_prihlaseni', 'Pro zobrazení stránky se musíte přihlásit' );
            echo \Template::instance()->render("prihlasit.html");
        }*/
        echo \Template::instance()->render("admin.html");
    }


}