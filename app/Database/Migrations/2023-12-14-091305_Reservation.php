<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Reservation extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'guestID'       => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'employeeID'      => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
            ],
            'checkInDate' => [
                'type'           => 'DATE',
            ],
            'checkOutDate' => [
                'type'           => 'DATE',
            ],
            'paymentID'     => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
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
        $this->forge->addForeignKey('guestID', 'guest', 'id', 'CASCADE', 'CASCADE', 'fk_reservation_guest');
        $this->forge->addForeignKey('employeeID', 'reservation_pic', 'id', 'CASCADE', 'CASCADE', 'fk_reservation_reservationPIC');
        $this->forge->addForeignKey('paymentID', 'payment', 'id', 'CASCADE', 'CASCADE', 'fk_reservation_payment');
        // Membuat tabel news
        $this->forge->createTable('reservation', TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable('reservation');
    }
}
