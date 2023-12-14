<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Payment extends Migration
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
			'billTotal'       => [
				'type'           => 'INT'
			],
			'paymentMethod'      => [
				'type'           => 'ENUM',
				'constraint'     => ['Card', 'Debit']
			],
			'paymentStatus' => [
				'type'           => 'ENUM',
				'constraint'     => ['Paid', 'Unpaid']
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

		// Membuat tabel news
		$this->forge->createTable('payment', TRUE);
    }

    public function down()
    {
        //
        $this->forge->dropTable('payment');
    }
}
