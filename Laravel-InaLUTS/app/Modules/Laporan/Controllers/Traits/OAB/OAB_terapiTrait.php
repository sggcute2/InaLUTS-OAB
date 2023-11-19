<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_terapiTrait {

    public function OAB_excel_column_terapi(
        &$sheet, $c = 0, $y, $data, $pasien
    )
    {
        $c--;

        if (!$data) return $c + 1;

        $fields = [
            'modifikasi_gaya_hidup' => 'Modifikasi gaya hidup',
            'rehabilitasi' => 'Rehabilitasi',
            'non_operatif' => 'Non-Operatif',
            'medikamentosa' => 'Medikamentosa',
            'operatif' => 'Operatif',
        ];
        foreach($fields as $field => $caption){
            if ($data->{'c_'.$field} != '0') $buffer[] = $caption;
        }

        if (count($buffer) > 0) {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                implode(', ', $buffer)
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        return $c;
    }

}
