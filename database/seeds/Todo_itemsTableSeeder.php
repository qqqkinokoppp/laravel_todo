<?php

use Illuminate\Database\Seeder;
use App\Models\Todo_item;

class Todo_itemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for ($i = 1;$i <= 10; $i++) {
            Todo_item::create([
                'user_id'           => '1',
                'item_name'         => $i.'日目のごはんを作る',
                'registration_date' => now() ->format('Y-m-d'),
                'expire_date'       => date('2019-12-01'),
                'created_at'        => now(),
                'updated_at'        => now()
            ]);
        }

    }
}
