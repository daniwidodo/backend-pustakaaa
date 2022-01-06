<?php

namespace Database\Seeders;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $rekening = new Role();        
        $rekening = [
            [   'id' => 1, 
                'title' => 'admin'
            ],
            [   'id' => 2, 
                'name' => 'user'
            ],
        ];
        
        Role::insert($rekening);
    }
}
