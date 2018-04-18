<?php

use Illuminate\Database\Seeder;

class StepsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $steps = array(
            "Peralatan",
            "Sistem Kemudi",
            "Ban dan Pelek",
            "Rangka dan Bodi",
            "Sistem Rem",
            "Sistem Suspensi",
            "Sistem Penerangan",
            "Pengecekan Teknis"
        );

        foreach ($steps as $step) {
            $s = new \App\Step();
            $s->name = $step;
            $s->save();
        }
    }
}
