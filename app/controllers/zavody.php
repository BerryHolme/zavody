<?php

namespace controllers;

class zavody
{
    public function getnovyZavod(\Base $base)
    {
        /*if($base->get("SESSION.user")){
            if('SESSION.user.role'=='1'){
                echo \Template::instance()->render("novyZavod.html");
            }else{
                $base->set ('error_msg_prihlaseni', 'Pro zobrazení této stránky nemáte oprávnění' );
                echo \Template::instance()->render("prihlasit.html");
            }

        }else {
            $base->set ('error_msg_prihlaseni', 'Pro zobrazení stránky se musíte přihlásit' );
            echo \Template::instance()->render("prihlasit.html");
        }*/
        $base->set ('error_zavod', '' );
        echo \Template::instance()->render("novyZavod.html");

    }

    public function postNovyZavod(\Base $base)
    {
        {
            $zavod = new \models\zavody();

            $zavod->copyfrom($base->get('POST'));

            // Save user data to the database
            $zavod->save();
            $base->clear("SESSION.zavod");

            $base->reroute("admin/");
        }
    }

    public function postRegistrovatZ(\Base $base)
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $idZavodnika = $_POST["id_zavodnika"];
            $idZavodu = $_POST["id_zavodu"];

            // Zde můžete provést další validace a kontrolu, např. ověření, zda závodník s daným ID existuje a podobně

            // Vytvoření nového závodníka
            $zavodnik = new \models\zavodnik();
            $zavodnik->set('id_zavodnika', $idZavodnika);
            $zavodnik->set('id_zavodu', $idZavodu);
            $zavodnik->set('schvaleno', false); // Můžete přizpůsobit podle vašich požadavků
            $zavodnik->set('datum_prihlaseni', date("Y-m-d H:i:s")); // Aktuální datum a čas
            $zavodnik->set('delka_zavodu', null); // Můžete přizpůsobit podle vašich požadavků
            $zavodnik->set('poradi', null); // Můžete přizpůsobit podle vašich požadavků

            // Uložení závodníka do databáze
            $zavodnik->save();
            $base->reroute("nastenka/");


            // Případné další kroky, např. zobrazení potvrzení
        } else {
            // Případné chybové zprávy nebo přesměrování
        }
    }

    public function getZavodnici(\Base $base)
    {

    }

    public function postZavodnici(\Base $base)
    {
        $idZavodu = $_POST["id_zavodu"];

        $zavodnici = (new \models\zavodnik)->find(['id_zavodu=?', $idZavodu]);
        $base->set('zavodnici', $zavodnici);
        echo \Template::instance()->render("zavodnici.html");
    }

    public function getAdminSeznamZavodu(\Base $base)
    {
        if($base->get("SESSION.user")){
            $user = new \models\User();
            $base->set('user', $user->find());
            //$base64ImageData = base64_encode($_SESSION['user']['image']);

            $zavod = (new \models\zavody)->find([], ['order' => 'id DESC']);
            $base->set('zavody', $zavod);

            $base->set('zavody_error', '');


            echo \Template::instance()->render("adminSeznamZavodu.html");
        }else $base->reroute("/prihlaseni");
    }

    public function getAdminSeznamZavodniku(\Base $base)
    {
        echo \Template::instance()->render("adminSeznamZavodniku.html");
    }

    public function postAdminSeznamZavodniku(\Base $base)
    {
        $idZavodu = $_POST["id_zavodu"];

        $zavodnici = (new \models\zavodnik)->find(['id_zavodu=?', $idZavodu], ['order' => 'schvaleno ASC']);
        $base->set('zavodnici', $zavodnici);
        echo \Template::instance()->render("adminSeznamZavodniku.html");
    }

    public function postSchvalit(\Base $base)
    {
        $idZavodnika = $_POST['zavodnik'];
        $idZavodu = $_POST['zavod'];

        $zavodnici = (new \models\zavodnik)->find(['id_zavodnika', $idZavodnika]);

        foreach ($zavodnici as $zavodnik){
            if ($zavodnik->id_zavodu == $idZavodu && $zavodnik->id_zavodnika == $idZavodnika) {
                $zavodnik->schvaleno = 1;
                $zavodnik->zamitnuti = '';
                $zavodnik->save();
            }
        }

        $zavodnici = (new \models\zavodnik)->find(['id_zavodu=?', $idZavodu], ['order' => 'schvaleno ASC']);
        $base->set('zavodnici', $zavodnici);
        echo \Template::instance()->render("adminSeznamZavodniku.html");
    }


    public function postZamitnout(\Base $base)
    {
        $id =$_POST['id'];
        $zavodnik = (new \models\zavodnik)->findone("id_zavodnika"== $id);
        $uzivatel = (new \models\User)->findone('id'== $zavodnik->id_zavodnika);
        $jmeno = $uzivatel->jmeno;
        $prijmeni = $uzivatel->prijmeni;
        $zavod = (new \models\zavody)->findone('id'== $zavodnik->id_zavodu);
        $jmenoZavodu = $zavod->jmeno;
        $id_zavodu = $zavod->id;

        $base->set('id', $id);
        $base->set('jmeno', $jmeno);
        $base->set('prijmeni', $prijmeni);
        $base->set('jmenoZavodu', $jmenoZavodu);
        $base->set('id_zavodu', $id_zavodu);

        echo \Template::instance()->render("zamitnuti.html");

    }

    public function postZrusitZamitnuti(\Base $base)
    {
        $idZavodu = $_POST["id_zavodu"];

        $zavodnici = (new \models\zavodnik)->find(['id_zavodu=?', $idZavodu], ['order' => 'schvaleno ASC']);
        $base->set('zavodnici', $zavodnici);
        echo \Template::instance()->render("adminSeznamZavodniku.html");
    }

    public function postOdeslat(\Base $base)
    {
        $idZavodnika = $_POST['id'];
        $idZavodu = $_POST['zavod'];
        $zamitnuti = $_POST['zamitnuti'];

        $zavodnici = (new \models\zavodnik)->find(['id_zavodnika', $idZavodnika]);

        foreach ($zavodnici as $zavodnik){
            if ($zavodnik->id_zavodu == $idZavodu && $zavodnik->id_zavodnika == $idZavodnika) {
                $zavodnik->schvaleno = 2;
                $zavodnik->zamitnuti = $zamitnuti;
                $zavodnik->save();
            }
        }
        $base->set('zavod', $idZavodu);
        echo \Template::instance()->render("uspesneOdeslano.html");
    }

    public function postPokracovat(\Base $base)
    {
        $idZavodu = $_POST["zavod"];

        $zavodnici = (new \models\zavodnik)->find(['id_zavodu=?', $idZavodu], ['order' => 'schvaleno ASC']);
        $base->set('zavodnici', $zavodnici);
        echo \Template::instance()->render("adminSeznamZavodniku.html");
    }

    public function getMojeZavody(\Base $base)
    {
        if($base->get("SESSION.user")){
            $idZavodnika = $base->get('SESSION.user[id]');
            $zavodnici = (new \models\zavodnik)->find(['id_zavodnika', 'SESSION.user[id]'],['order' => 'datum_prihlaseni ASC']);
            $base->set('zavodnici', $zavodnici);
            echo \Template::instance()->render("mojeZavody.html");
        }else $base->reroute("/prihlaseni");
    }

    public function postSmazatSe(\Base $base)
    {
        $id = $_POST['id'];
        $zavidnik = new \models\zavodnik();
        $zavodnik = $zavidnik->findone(["id=?",$id]);
        $zavodnik ->erase();
        $base ->reroute("nastenka/");;
    }

    public function postStart(\Base $base)
    {
        $idZavodu = $_POST['id_zavodu'];
        $zavody = new \models\zavody();
        $zavod = $zavody->findone(['id=?', $idZavodu]);

        $zavodnici = (new \models\zavodnik)->find(['id_zavodu=?', $idZavodu], ['order' => 'schvaleno ASC']);


        if($zavod->stav==0){
            $zavod->stav = 1;
            $zavod->save();
            foreach ($zavodnici as $zavodnik){
                $zavodnik->set('start_cas', date("Y-m-d H:i:s"));
                $zavodnik->stav=1;
                $zavodnik->save();
            }
            $base->set('zavodnici', $zavodnici);
            $base->set('zavod', $zavod);
            echo \Template::instance()->render('probihajiciZavod.html');

        }elseif ($zavod->stav==1){
            $base->set('zavodnici', $zavodnici);
            $base->set('zavod', $zavod);
            echo \Template::instance()->render('probihajiciZavod.html');

        }else{
            $user = new \models\User();
            $base->set('user', $user->find());

            $zavod = (new \models\zavody)->find([], ['order' => 'id DESC']);
            $base->set('zavody', $zavod);

            $base->set('zavody_error', 'Závod už skončil');

            echo \Template::instance()->render("adminSeznamZavodu.html");
        }

    }

    public function postCil(\Base $base)
    {
        $zavodnikId = $_POST['zavodnik'];
        $idZavodu = $_POST['id_zavodu'];
        $zavodnici = (new \models\zavodnik)->find(['id_zavodu=?', $idZavodu], ['order' => 'delka_zavodu ASC']);
        //$zavodnik = $zavodnici->findone(['id' => $zavodnikId]);

        foreach ($zavodnici as $zavodnik){
            if($zavodnik->stav == 0 and $zavodnik->id==$zavodnikId){
                $zavodnik->cil_cas = date("Y-m-d H:i:s");
                $startCasTimestamp = strtotime($zavodnik->start_cas);
                $cilCasTimestamp = strtotime($zavodnik->cil_cas);

                $rozdiel = $cilCasTimestamp - $startCasTimestamp;

                $zavodnik->delka_zavodu = date("H:i:s", $rozdiel);
                $zavodnik->stav = 1;
                $zavodnik->save();
            }
        }

        $zavody = new \models\zavody();
        $zavod = $zavody->findone(['id=?', $idZavodu]);
        $zavodnici = (new \models\zavodnik)->find(['id_zavodu=?', $idZavodu], ['order' => 'schvaleno ASC']);

        $base->set('zavodnici', $zavodnici);
        $base->set('zavod', $zavod);
        echo \Template::instance()->render('probihajiciZavod.html');


    }

    public function postKonec(\Base $base)
    {
        $idZavodu = $_POST['id_zavodu'];
        $zavody = new \models\zavody();
        $zavod = $zavody->findone(['id=?', $idZavodu]);
        $zavodnici = (new \models\zavodnik)->find(['id_zavodu=?', $idZavodu], ['order' => 'delka_zavodu ASC']);
        if($zavod->stav==1){
            $poradi = 0;
            foreach ($zavodnici as $zavodnik){
                if($zavodnik->stav==0) {
                    $zavodnik->stav=3;
                    $zavodnik->save();
                }elseif ($zavodnik->stav==1){
                    $poradi++;
                    $zavodnik->poradi = $poradi;
                    $zavodnik->stav=2;
                    $zavodnik->save();
                }else {
                    $zavodnik->zamitnuti = 'Nedokončil';
                    $zavodnik->save();
                }

            }
            $zavod->stav=2;
            $zavod->save();
        }elseif ($zavod->stav==0) {
            echo('Závod eště nezačal');
        }else{
            echo('Závod skončil');
        }

        $base->set('zavodnici', $zavodnici);
        $base->set('zavod', $zavod);
        echo \Template::instance()->render('konec.html');
    }

    public function postPoradnik(\Base $base)
    {
        $idZavodu = $_POST['id_zavodu'];
        $zavody = new \models\zavody();
        $zavod = $zavody->findone(['id=?', $idZavodu]);
        $zavodnici = (new \models\zavodnik)->find(['id_zavodu=?', $idZavodu], ['order' => 'poradi ASC']);

        $base->set('zavodnici', $zavodnici);
        $base->set('zavod', $zavod);
        echo \Template::instance()->render('poradnik.html');
    }

}