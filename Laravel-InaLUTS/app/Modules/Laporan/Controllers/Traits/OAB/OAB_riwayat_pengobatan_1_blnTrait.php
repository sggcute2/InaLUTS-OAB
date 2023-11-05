<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_riwayat_pengobatan_1_blnTrait {

    public function OAB_excel_column_riwayat_pengobatan_1_bln(&$sheet, $c = 0, $y, $data, $pasien)
    {
        $c--;

        $fields = [
            'antihipertensi',
            'obat_diabetik',
            'obat_obatan_psikiatri',
            'obat_obatan_copd',
            'obat_obatan_asma',
            'obat_obatan_alergi',
            'obat_obatan_saraf',
        ];
        foreach($fields as $field){
            if ($data->{$field} == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $data->{$field}.' , '.$data->{$field.'_ya'}
                );
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $data->{$field}
                );
            }
        }

        return $c;
    }

}
