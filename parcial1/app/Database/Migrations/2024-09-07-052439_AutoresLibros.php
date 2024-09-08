<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AutoresLibros extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'libro_id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
            ],
            'autor_id' => [
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
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['libro_id', 'autor_id']);
        $this->forge->addForeignKey('libro_id', 'libros', 'id');
        $this->forge->addForeignKey('autor_id', 'autores', 'artista_id');
        $this->forge->createTable('autores_libros');
    }

    public function down()
    {
        //
        $this->forge->dropTable('autores_libros');
    }
}
