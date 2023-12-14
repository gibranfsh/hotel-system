<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class RoomReservation extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'roomReservationID'      => [
				'type'           => 'VARCHAR',
				'constraint'     => 10
			],
			'reservationID'       => [
				'type'           => 'VARCHAR',
                'constraint'    => 10
			],
			'roomNumber'      => [
				'type'           => 'INT',
			],
			'price' => [
				'type'           => 'INT',
			],
		]);

		// Membuat primary key
		$this->forge->addKey('roomReservationID', TRUE);
        $this->forge->addForeignKey('reservationID', 'reservation', 'reservationID', 'CASCADE', 'CASCADE', 'fk_roomReservation_reservation');
        $this->forge->addForeignKey('roomNumber', 'room', 'roomNumber', 'CASCADE', 'CASCADE', 'fk_room_reservation_roomNumber');

		// Membuat tabel news
		$this->forge->createTable('room_reservation', TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable('room_reservation');
    }
}
