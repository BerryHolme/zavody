<?php

namespace models;

use controllers\Index;
use DB\Cortex;

class User extends Cortex
{
    protected $db='DB', $table ='uzivatele';
    protected $fieldConf=[
        'id' =>['type'=>'INT4', 'nullable'=>false],
        'jmeno' =>['type'=>'VARCHAR256','nullable' =>false],
        'prijmeni' =>['type'=>'VARCHAR256','nullable' =>false],
        'email'=>['type'=>'VARCHAR256','nullable' =>false, 'index'=>true, 'unique'=>true, 'default'=>true],
        'heslo'=>['type'=>'VARCHAR256','nullable' =>false],
        'image'=>['type'=>'VARCHAR256', 'nullable'=>false],
        'souhlas'=>['type'=>'BOOLEAN', 'nullable'=>false],
        'role' =>['type'=>'INT4','nullable'=>false],
        'stav' =>['type'=>'INT4','nullable'=>false]
    ];
}
