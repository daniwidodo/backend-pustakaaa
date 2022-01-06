<?php

namespace Database\Seeders;

use App\Models\Rekening;
use Illuminate\Database\Seeder;

class RekeningsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $rekening = new Rekening;
        // $rekening->title = 'bca';
        // $rekening->save();

        // $users = [
        //     [   'id' => 1, 
        //         'name' => 'Stephan de Vries', 
        //         'username' => 'stephan', 
        //         'email' => 'stephan-v@gmail.com', 
        //         'password' => bcrypt('carrotz124')
        //     ],
        //     [   'id' => 2, 
        //         'name' => 'John doe', 
        //         'username' => 'johnny', 
        //         'email' => 'johndoe@gmail.com', 
        //         'password' => bcrypt('carrotz1243')],
        // ];

        $rekening = [
            [   'id' => 1, 
                'title' => 'BCA'
            ],
            [   'id' => 2, 
                'name' => 'BNI'
            ],
        ];



        Rekening::insert($rekening);
    }
}
