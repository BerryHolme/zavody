<?php
namespace models;

use DB\Cortex;

class zavodnik extends Cortex
{
    protected $db = 'DB', $table = 'zavodnik';
    protected $fieldConf = [
        'id' => ['type' => 'INT4', 'primary',  'nullable' => false],
        'id_zavodnika' => ['type' => 'INT4',  'nullable' => false],
        'id_zavodu' => ['type' => 'INT4', 'nullable' => false],
        'schvaleno' => ['type' => 'INT4', 'nullable' => false],
        'datum_prihlaseni' => ['type' => 'DATETIME', 'nullable' => false],
        'delka_zavodu' => ['type' => 'DATETIME', 'nullable' => false],
        'poradi' => ['type' => 'INT4', 'nullable' => false],
        'zamitnuti' => ['type' => 'LONGTEXT', 'nullable' => false],
        'start_cas' => ['type' => 'DATETIME', 'nullable' => false],
        'cil_cas' => ['type' => 'DATETIME', 'nullable' => false],
        'stav' => ['type' => 'INT4', 'nullable' => false],
        'jmeno' => ['type' => 'VARCHAR256', 'nullable' => false],
        'prijmeni' => ['type' => 'VARCHAR256', 'nullable' => false],
        'zavod' => ['type' => 'VARCHAR256', 'nullable' => false],
    ];

    // Add foreign key constraint
    protected $foreignKeys = [
        'id_zavodu' => [
            'table' => 'zavody',
            'field' => 'id',
        ],
    ];
}
