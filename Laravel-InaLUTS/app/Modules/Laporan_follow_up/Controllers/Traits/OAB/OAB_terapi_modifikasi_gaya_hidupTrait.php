<?php

namespace App\Modules\Laporan_follow_up\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_terapi_modifikasi_gaya_hidupTrait {

    public function OAB_excel_column_terapi_modifikasi_gaya_hidup(
        &$sheet, $c = 0, $y, $data
    )
    {
        $c--;

        if (!$data) return $c + 8;

        $sheet->setCellValue(
            FORMAT::excel_column(++$c).$y, $data->terapi_modifikasi_gaya_hidup
        );
        if ($data->terapi_modifikasi_gaya_hidup == 'Ya') {
            $temp = [];
            try {
                $temp = unserialize($data->terapi_modifikasi_gaya_hidup_ya);
            } catch (Exception $exception) {
                $temp = [];
            }
            $temp_date = '';
            if (
                isset($temp['terapi_modifikasi_gaya_hidup_terapi_date'])
                && $temp['terapi_modifikasi_gaya_hidup_terapi_date']
            ) {
                $temp_date = FORMAT::date(
                    $temp['terapi_modifikasi_gaya_hidup_terapi_date']
                );
            }
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp_date);
            $temp_idx = 'terapi_modifikasi_gaya_hidup_'
                .'menurunkan_berat_badan';
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $temp[$temp_idx] ?? ''
            );
            $temp_idx = 'terapi_modifikasi_gaya_hidup_'
                .'penilaian_jenis';
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $temp[$temp_idx] ?? ''
            );
            $temp_prefix = 'terapi_modifikasi_gaya_hidup_';
            $temp_idx = $temp_prefix.'bladder_training';
            if ($temp[$temp_idx] == 'Ya') {
                $tempz = $temp[$temp_idx];
                $buffer_1 = $buffer_2 = [];
                if ($temp[$temp_prefix.'c_bladder_training_timed_voiding_berkemih_spontan'] == '1') $buffer_2[] = 'Berkemih Spontan';
                if ($temp[$temp_prefix.'c_bladder_training_timed_voiding_katerisasi'] == '1') $buffer_2[] = 'Katerisasi';
                if ($temp[$temp_prefix.'c_follow_up_terapi_timed_voiding'] == '1') {
                    $temp_2 = '';
                    if (count($buffer_2) > 0) {
                        $temp_2 = ' ('.implode(', ', $buffer_2).')';
                    }
                    $buffer_1[] = 'Timed Voiding'.$temp_2;
                }
                if ($temp[$temp_prefix.'c_follow_up_terapi_prompt_voiding'] == '1') $buffer_1[] = 'Timed Voiding';
                if ($temp[$temp_prefix.'c_follow_up_terapi_urge_suppression_strategies'] == '1') $buffer_1[] = 'Timed Voiding';
                if (count($buffer_1) > 0) {
                    $tempz .= ' : '.implode(', ', $buffer_1);
                }
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $tempz);
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp[$temp_idx]);
            }
            $temp_idx = $temp_prefix.'stop_merokok';
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $temp[$temp_idx] ?? ''
            );
            $temp_idx = $temp_prefix.'manajemen_stress';
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $temp[$temp_idx] ?? ''
            );
            $temp_idx = $temp_prefix.'manajemen_komorbid';
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $temp[$temp_idx] ?? ''
            );
        } else {
            return $c + 7;
        }

        return $c;
    }

}
