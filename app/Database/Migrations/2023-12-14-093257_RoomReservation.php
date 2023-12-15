<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RoomReservation extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id' => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'reservationID'       => [
				'type'           => 'INT',
				'constraint'     => 5,
				'unsigned'       => true,
			],
			'roomNumber'      => [
				'type'           => 'INT',
			],
			'price' => [
				'type'           => 'INT',
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
		$this->forge->addKey('id', TRUE);
		$this->forge->addForeignKey('reservationID', 'reservations', 'id', 'CASCADE', 'CASCADE', 'fk_roomReservation_reservation');
		$this->forge->addForeignKey('roomNumber', 'rooms', 'roomNumber', 'CASCADE', 'CASCADE', 'fk_roomReservation_roomNumber');

		// Membuat tabel news
		$this->forge->createTable('room_reservations', TRUE);
	}

	public function down()
	{
		//
		$this->forge->dropTable('room_reservations');
	}
}
