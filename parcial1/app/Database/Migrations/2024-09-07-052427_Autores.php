<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Autores extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'artista_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'apellido' => [
                'type'       => 'VARCHAR',
                'constraint' => '150',
            ],
            'fecha_nacimiento' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'fecha_muerte' => [
                'type' => 'DATE',
                'null' => true,
            ],
            'pais_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('artista_id', true);
        $this->forge->addForeignKey('pais_id', 'paises', 'pais_id');
        $this->forge->createTable('autores');
    }

    public function down()
    {
        //
        $this->forge->dropTable('autores');
    }
}
