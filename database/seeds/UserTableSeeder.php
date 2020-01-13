<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
			[
                'id'=>1,
                'name'=> 'Admin',
                'type'=> 'Super Admin',
                'email'=> 'admin@piit.us',
                'image'=> 'default_rss/images/user.jpg',
                'password'=> bcrypt("admin@piit"),
                'status'=> 'active',
            ],
     
        ]);
        $this->command->info("Users table seeded :)");
    }
}
