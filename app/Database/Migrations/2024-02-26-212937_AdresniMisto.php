<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdresniMisto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'kod' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => false,
            ],
            'ulice' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'typ_so' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'cislo_domovni' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'cislo_orientacni' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'psc' => [
                'type'           => 'VARCHAR',
                'constraint'     => 255,
                'character set'  => 'utf8mb4',
                'collate'       => 'utf8mb4_czech_ci',
                'null'          => false
            ],
            'souradnice_y' => [
                'type'           => 'DOUBLE',
               
            ],
            'souradnice_x' => [
                'type'           => 'DOUBLE',
                
            ],
            'created_at' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'updated_at' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'deleted_at' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'null'          => false
            ],

        ]);
        $this->forge->addKey('kod', true);
        $this->forge->createTable('adresni_misto');
    }

    public function down()
    {
        //
    }
}
