<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->insert([
    		[
    			'id' => 1, 
    			'title' => 'Super Admin', 
    			'description' => 'This role has all role-permission access', 
    			'status' => 'Active',
    		],
    		
    	]);
    	$this->command->info("Roles table seeded :)");
    }
}
