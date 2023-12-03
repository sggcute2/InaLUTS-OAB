<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_terapi_modifikasi_gaya_hidupTrait {

    public function OAB_excel_column_terapi_modifikasi_gaya_hidup(
        &$sheet, $c = 0, $y, 
        $terapi_by_pasien_id,
        $data,
        $pasien
    )
    {
        $c--;

        if (!$terapi_by_pasien_id || !$data) return $c + 7;

        if (
            isset($terapi_by_pasien_id->c_modifikasi_gaya_hidup)
            && $terapi_by_pasien_id->c_modifikasi_gaya_hidup != '0'
        ) {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, FORMAT::date($data->terapi_date));
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->menurunkan_berat_badan);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->penilaian_jenis);
            if ($data->bladder_training == 'Ya') {
                $temp = $data->bladder_training;
                $buffer_1 = $buffer_2 = [];
                if ($data->c_bladder_training_timed_voiding_berkemih_spontan == '1') $buffer_2[] = 'Berkemih Spontan';
                if ($data->c_bladder_training_timed_voiding_katerisasi == '1') $buffer_2[] = 'Katerisasi';
                if ($data->c_bladder_training_timed_voiding == '1') {
                    $temp_2 = '';
                    if (count($buffer_2) > 0) {
                        $temp_2 = ' ('.implode(', ', $buffer_2).')';
                    }
                    $buffer_1[] = 'Timed Voiding'.$temp_2;
                }
                if ($data->c_bladder_training_prompt_voiding == '1') $buffer_1[] = 'Timed Voiding';
                if ($data->c_bladder_training_urge_suppression_strategies == '1') $buffer_1[] = 'Timed Voiding';
                if (count($buffer_1) > 0) {
                    $temp .= ' : '.implode(', ', $buffer_1);
                }
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp);
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->bladder_training);
            }
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->stop_merokok);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->manajemen_stress);
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->manajemen_komorbid);
        } else {
            return $c + 7;
        }

        return $c;
    }

}
