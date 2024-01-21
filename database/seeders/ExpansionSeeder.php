<?php

namespace Database\Seeders;

use App\Models\Expansion;
use Illuminate\Database\Seeder;

class ExpansionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // CREACION DE LAS EXPASIONES
        $expansion = new Expansion();
        $expansion->tipo_expansion = 'base set';
        $expansion->es_primera_edicion = 'si';
        $expansion->save();

        $expansion = new Expansion();
        $expansion->tipo_expansion = 'jungle';
        $expansion->es_primera_edicion = 'si';
        $expansion->save();

        $expansion = new Expansion();
        $expansion->tipo_expansion = 'fossil';
        $expansion->es_primera_edicion = 'si';
        $expansion->save();

        $expansion = new Expansion();
        $expansion->tipo_expansion = 'base set 2';
        $expansion->es_primera_edicion = 'no';
        $expansion->save();

        $expansion = new Expansion();
        $expansion->tipo_expansion = 'team rocket';
        $expansion->es_primera_edicion = 'no';
        $expansion->save();
    }
}
