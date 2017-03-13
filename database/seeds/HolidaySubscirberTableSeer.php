<?php

use Illuminate\Database\Seeder;

class HolidaySubscirberTableSeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\HolidaySubscriber::class, 100)->create();
    }
}
