<?php

namespace App\Modules\Laporan_follow_up\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_sistem_skorTrait {

    public function OAB_excel_column_sistem_skor(&$sheet, $c = 0, $y, $data)
    {
        $c--;

        if (!$data) return $c + 10;

        if ($data->oabss == 'Ya') {
            $temp = [];
            try {
                $temp = unserialize($data->oabss_ya);
            } catch (Exception $exception) {
                $temp = [];
            }
            $temp_total_score = 0;
            $temp_total_score += $temp['oabss_score_1'] ?? 0;
            $temp_total_score += $temp['oabss_score_2'] ?? 0;
            $temp_total_score += $temp['oabss_score_3'] ?? 0;
            $temp_total_score += $temp['oabss_score_4'] ?? 0;
            $sheet->setCellValue(
                FORMAT::excel_column(++$c).$y, $temp_total_score
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        if ($data->qol == 'Ya') {
            $temp = [];
            try {
                $temp = unserialize($data->qol_ya);
            } catch (Exception $exception) {
                $temp = [];
            }
            $temp_total_score = 0;
            $temp_total_score += $temp['qol_score'] ?? 0;
            $sheet->setCellValue(
                FORMAT::excel_column(++$c).$y, $temp_total_score
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        if ($data->bladder_diary == 'Ya') {
            $temp = [];
            try {
                $temp = unserialize($data->bladder_diary_ya);
            } catch (Exception $exception) {
                $temp = [];
            }
            $a = [
                ['intake_cairan'],
                ['frekuensi_kencing'],
                ['nocturia'],
                ['porsi_miksi'],
                ['produksi_urin'],
                ['urgency'],
                ['inkontinensia_urine'],
                ['poliuria_nocturnal'],
            ];
            $UOM = [
                'intake_cairan' => 'ml',
                'porsi_miksi' => 'ml',
                'produksi_urin' => 'ml',
                'urgency' => 'x',
                'inkontinensia_urine' => 'x',
            ];
            $UOM2 = [
                'nocturia' => ' /malam',
            ];
            foreach($a as $av){
                $field = '';

                $txt = '';
                switch($av[0]){
                    case 'intake_cairan':
                    case 'frekuensi_kencing':
                    case 'nocturia':
                    case 'porsi_miksi':
                    case 'produksi_urin':
                    case 'urgency':
                    case 'inkontinensia_urine':
                        $uom = (isset($UOM[$av[0]])) ? $UOM[$av[0]] : '';
                        $uom2 = (isset($UOM2[$av[0]])) ? $UOM2[$av[0]] : '';
                        $txt .= ($temp['bladder_diary_'.$av[0].'_1'] ?? '')
                            .' '.$uom
                            .' s/d '
                            .($temp['bladder_diary_'.$av[0].'_2'] ?? '')
                            .' '.$uom
                            .$uom2;
                        break;

                    case 'poliuria_nocturnal':
                        $txt .= $temp['bladder_diary_'.$av[0]] ?? '';
                        break;
                }

                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $txt);
            }
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        return $c;
    }

}
