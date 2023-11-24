<?php
namespace models;

use DB\Cortex;

class zavodnik extends Cortex
{
    protected $db = 'DB', $table = 'zavodnik';
    protected $fieldConf = [
        'id' => ['type' => 'INT', 'primary',  'nullable' => false],
        'id_zavodnika' => ['type' => 'INT',  'nullable' => false],
        'id_zavodu' => ['type' => 'INT', 'nullable' => false],
        'schvaleno' => ['type' => 'INT', 'nullable' => false],
        'datum_prihlaseni' => ['type' => 'DATETIME', 'nullable' => false],
        'delka_zavodu' => ['type' => 'TIME', 'nullable' => false],
        'poradi' => ['type' => 'INT', 'nullable' => false],
        'zamitnuti' => ['type' => 'LONGTEXT', 'nullable' => false],
        'start_cas' => ['type' => 'DATETIME', 'nullable' => false],
        'cil_cas' => ['type' => 'DATEIME', 'nullable' => false],
        'stav' => ['type' => 'INT', 'nullable' => false],
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
