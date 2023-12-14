<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Room extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'roomNumber'          => [
				'type'           => 'INT'
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
		]);

		// Membuat primary key
		$this->forge->addKey('roomNumber', TRUE);

		// Membuat tabel news
		$this->forge->createTable('room', TRUE);
    
    }

    public function down()
    {
        //
        $this->forge->dropTable('room');
    }
}
