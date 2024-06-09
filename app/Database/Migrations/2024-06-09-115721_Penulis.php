<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penulis extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type'              => 'INT',
                'constraint'        => 11,
                'unsigned'          => true,
                'auto_increment'    => true,
            ],
            'name' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'address' => [
                'type'          => 'VARCHAR',
                'constraint'    => '255',
            ],
            'created_at' => [
                'type'        => 'DATETIME',
                'null'        => true,
            ],
            'update_at' => [
                'type'  => 'DATETIME',
                'nul'   => true,
            ]

            ]);
            $this->forge->addKey('id', true);
            $this->forge->createTable('penulis');
    }

    public function down()
    {
        $this->forge->dropTable('penulis');
    }
}