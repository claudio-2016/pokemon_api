<?php

namespace Database\Seeders;

use App\Models\Tipo;
use Illuminate\Database\Seeder;

class TipoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CREACION DE LOS TIPOS
        $tipo = new Tipo();
        $tipo->type = 'acero';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'agua';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'bicho';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'dragon';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'electrico';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'fantasma';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'fuego';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'hada';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'hielo';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'lucha';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'normal';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'planta';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'psiquico';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'roca';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'siniestro';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'tierra';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'veneno';
        $tipo->save();

        $tipo = new Tipo();
        $tipo->type = 'volador';
        $tipo->save();
    }
}
