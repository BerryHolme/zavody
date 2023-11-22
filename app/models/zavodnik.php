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
    ];

    // Add foreign key constraint
    protected $foreignKeys = [
        'id_zavodu' => [
            'table' => 'zavody',
            'field' => 'id',
        ],
    ];
}
