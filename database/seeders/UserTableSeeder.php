<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 */
	public function run(): void {
		User::create([
			'name' => 'Admin',
			'email' => 'admin@email.com',
			'password' => Hash::make('admin'),
			'role_id' => Role::where('name', 'admin')->first()->id,
		]);

		User::create([
			'name' => 'User',
			'email' => 'user@email.com',
			'password' => Hash::make('user'),
			'role_id' => Role::where('name', 'user')->first()->id,
		]);
	}
}
