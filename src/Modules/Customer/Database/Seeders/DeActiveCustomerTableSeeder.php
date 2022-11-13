<?php

namespace Modules\Customer\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Customer\Entities\Customer;

class DeActiveCustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        Customer::factory()->create([
            'active' => false,

        ]);
        // $this->call("OthersTableSeeder");
    }
}
