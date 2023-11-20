<?php

namespace models;

use controllers\Index;
use DB\Cortex;

class User extends Cortex
{
    protected $db='DB', $table ='uzivatele';
    protected $fieldConf=[
        'id' =>['type'=>'INT', 'nullable'=>false],
        'jmeno' =>['type'=>'VARCHAR256','nullable' =>false],
        'prijmeni' =>['type'=>'VARCHAR256','nullable' =>false],
        'email'=>['type'=>'VARCHAR256','nullable' =>false, 'index'=>true, 'unique'=>true, 'default'=>true],
        'heslo'=>['type'=>'VARCHAR256','nullable' =>false],
        'image'=>['type'=>'LONGBLOB', 'nullable'=>false],
        'souhlas'=>['type'=>'BOOL', 'nullable'=>false],
        'role' =>['type'=>'INT','nullable'=>false],
        'stav' =>['type'=>'INT','nullable'=>false]
    ];
}
