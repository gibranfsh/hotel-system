<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Room extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'roomNumber' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'floor'       => [
                'type'           => 'INT',
            ],
            'roomType'      => [
                'type'           => 'ENUM',
                'constraint'     => ['Deluxe', 'Superior', 'Family', 'Suite']
            ],
            'availability' => [
                'type'           => 'ENUM',
                'constraint'     => ['Available', 'Unavailable']
            ],
            'created_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'updated_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
            'deleted_at' => [
                'type'       => 'DATETIME',
                'null'       => true,
            ],
        ]);

        // Membuat primary key
        $this->forge->addKey('roomNumber', TRUE);

        // Membuat tabel news
        $this->forge->createTable('rooms', TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable('rooms');
    }
}
