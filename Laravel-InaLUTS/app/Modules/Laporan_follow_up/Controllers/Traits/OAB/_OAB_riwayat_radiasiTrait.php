<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_riwayat_radiasiTrait {

    public function OAB_excel_column_riwayat_radiasi(&$sheet, $c = 0, $y, $data, $pasien)
    {
        $c--;

        if (!$data) return $c + 2;

        $fields = [
            'riwayat_radiasi_pelvis',
            'riwayat_kemoterapi',
        ];
        foreach($fields as $field){
            if ($data->{$field} == 'Ya') {
                $buffer = [];
                $fields2 = [
                    'keganasan_saluran_kemih' => 'Keganasan saluran kemih',
                    'keganasan_saluran_cerna' => 'Keganasan saluran cerna',
                    'keganasan_ginekologi' => 'Keganasan ginekologi',
                ];
                foreach($fields2 as $field2 => $caption2){
                    if ($data->{'c_'.$field.'_'.$field2} != '0') $buffer[] = $caption2;
                }

                if (count($buffer) > 0) {
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                        implode(', ', $buffer)
                    );
                } else {
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
                }
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->{$field});
            }
        }

        return $c;
    }

}
