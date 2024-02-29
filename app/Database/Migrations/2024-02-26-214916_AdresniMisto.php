<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdresniMisto extends Migration
{
    public function up()
    {
        $fields = [
            'psc' => [
                'name' => 'psc',
                'type' => 'VARCHAR',
                'constraint' => 255,
                'character set' => 'utf8',
                'collate' => 'utf8_czech_ci',
                'null' => false,
            ],
        ];
        $this->forge->modifyColumn('adresni_misto', $fields);
        $this->forge->processIndexes('adresni_misto');
    }

    public function down()
    {
        //
    }
}
