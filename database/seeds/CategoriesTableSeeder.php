<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('categories')->insert([

        [
         'name' => 'Test Category',
         'slug' => str_slug('Test Category','-'),
         'icon_class' => 'icofont icofont-education',
       ],
     ]);
      $this->command->info("Categories table seeded :)");
    }
  }
