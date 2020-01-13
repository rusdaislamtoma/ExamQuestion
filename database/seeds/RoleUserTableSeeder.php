<?php
use Illuminate\Database\Seeder;
use Carbon\Carbon;
class RoleUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_user')->insert([

            [
                'id'=>1,
                'role_id'=> '1',
                'user_id'=>1,
                'status'=> 'Active',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],

        ]);
        $this->command->info("Users Role table seeded :)");
    }

}
