<?php

namespace Database\Seeders;

use App\Models\Rareza;
use Illuminate\Database\Seeder;

class RarezaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CREACION DE LOS TIPO DE RAREZA
        $rareza = new Rareza();
        $rareza->tipo_rareza = 'comun';
        $rareza->save();

        $rareza = new Rareza();
        $rareza->tipo_rareza = 'no comun';
        $rareza->save();

        $rareza = new Rareza();
        $rareza->tipo_rareza = 'rara';
        $rareza->save();
    }
}
