<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Webinar extends Migration
{
	public function up()
	{
			$this->forge->addField([
				'id' => [
					'type'           => 'INT',
					'constraint'     => 11,
					'unsigned'       => true,
					'auto_increment' => true,
				],
				'firstname'    => [
					'type'           => 'VARCHAR',
					'constraint'     => '50',
				],
				'lastname'     => [
					'type'           => 'VARCHAR',
					'constraint'     => '60',
				 ],
				 'email'       => [
					'type'           => 'VARCHAR',
					'constraint'     => '100',
				],
				   'password'  => [
					'type'           => 'VARCHAR',
					'constraint'     => '255',
				],
				'created_at'   => [
					'type'           => 'DATETIME',
				],
				'updated_at'   => [
					'type'           => 'DATETIME',
				]
				]);
		$this->forge->addKey('id', TRUE);
		$this->forge->createTable('users');
	}

	public function down()
	{
			$this->forge->dropTable('users');
	}
}
