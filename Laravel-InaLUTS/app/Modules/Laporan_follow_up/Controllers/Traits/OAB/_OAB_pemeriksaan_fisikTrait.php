<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_pemeriksaan_fisikTrait {

    public function OAB_excel_column_pemeriksaan_fisik(
        &$sheet, $c = 0, $y, $data, $pasien
    )
    {
        $c--;

        if (!$data) return $c + 12;

        if ($data->gangguan_neurologi == 'Ya') {
            $a = [
                'c_gangguan_neurologi_tremor',
                'c_gangguan_neurologi_fascial_palsy',
                'c_gangguan_neurologi_hemiparesis',
                'c_gangguan_neurologi_paraparesis',
                'c_gangguan_neurologi_tetraparesis',
                'c_gangguan_neurologi_hemiplegi',
                'c_gangguan_neurologi_paraplegi',
            ];
            $b = [
                'Tremor',
                'Fascial Palsy',
                'Hemiparesis',
                'Paraparesis',
                'Tetraparesis',
                'Hemiplegi',
                'Paraplegi',
            ];
            $buffer = [];
            foreach($a as $idx => $va){
                if ($data->{$va} == '1') $buffer[] = $b[$idx];
            }

            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->gangguan_neurologi
                .' : '
                .implode(', ', $buffer)
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->gangguan_neurologi
            );
        }

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->cor);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->pulmo);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
            $data->bulbocavernosus_refleks
        );
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
            $data->atrofi_vagina
        );

        if ($data->pop == 'Ya') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->pop.' : '.$data->pop_ya
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->pop);
        }

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
            $data->massa_di_daerah_pelvis
        );

        if ($data->uretra == 'Tidak') {
            $buffer = [];
            if ($data->c_uretra_caruncle == '1') $buffer[] = 'Caruncle';
            if ($data->c_uretra_stenosis == '1') $buffer[] = 'Stenosis';
            if (count($buffer) > 0) {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $data->uretra.' : '.implode(', ', $buffer)
                );
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $data->uretra
                );
            }
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->uretra);
        }

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->tonus_spingter_ani);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->tonus_levator_ani);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->pelvic_floor);

        if ($data->prostat == 'Tidak') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->prostat
                .' : '
                .$data->prostat_tidak
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->prostat);
        }

        return $c;
    }

}
