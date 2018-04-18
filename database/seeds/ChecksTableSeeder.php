<?php

use Illuminate\Database\Seeder;

class ChecksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $checks = array();
        $checks['peralatan'] = array(
            "nomer rangka", "nomer penggerak", "nomer plat",
            "penghapus kaca depan", "klakson", "kaca spion",
            "pandangan kaca depan", "lampu indikasi", "speedometer",
            "sistem bahan bakar", "sistem kelistrikan", "dudukan mesin",
            "kondisi mesin", "transmisi", "sistem gas buang"
        );
        $checks['sistem_kemudi'] = array(
            "roda kemudi", "batang kemudi", "roda gigi kemudi",
            "sambungan kemudi", "power steering"
        );
        $checks['ban_dan_pelek'] = array(
            "ukuran dan jenis ban", "keadaan ban",
            "ukuran dan jenis pelek", "keadaan pelek"
        );
        $checks['rangka_dan_bodi'] = array(
            "bemper", "kondisi bodi", "ruang pengemudi",
            "tempat duduk", "rangka penopang", "tempat roda cadangan"
        );
        $checks['sistem_rem'] = array(
            "pedal rem", "tromol, cakram rem", "tuas rem tangan / pedal",
            "penggerak rem", "sambungan, tuas, kabel", "pipa, selang rem"
        );
        $checks['sistem_suspensi'] = array(
            "sumbu-sumbu", "pemasangan sumbu", "pegas-pegas",
            "bantalan roda", "sumbu I", "sumbu II", "sumbu III"
        );
        $checks['sistem_penerangan'] = array(
            "lampu jauh", "lampu rem", "lampu parkir mundur",
            "lampu kabut", "lampu arah peringatan", "lampu dekat",
            "reflektor lampu"
        );

        $checks['pengecekan_teknis'] = array(
            "kandungan CO", "kandungan HC", "side slip",
            "indikator speedometer", "indikasi klakson", "intensitas cahaya"
        );

        foreach ($checks as $key => $values) {
            $step = \App\Step::where(
                "name", 'like', "%".str_replace('-', ' ', $key)."%"
            )->first();
            foreach ($values as $value) {
                $c = new \App\Check();
                $c->step_id = $step->id;
                $c->name = $value;
                $c->save();
            }
        }
    }
}
