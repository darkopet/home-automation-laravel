<?php

use Illuminate\Database\Seeder;
use App\DeviceType;

class DeviceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = 3;
        factory(DeviceType::class, $count)->create();
    }
}
