<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_sistem_skorTrait {

    public function OAB_excel_column_sistem_skor(&$sheet, $c = 0, $y,
        $data,
        $oabss,
        $qol,
        $iief,
        $ehs,
        $bladder_diary,
        $pasien
    )
    {
        $c--;

        if (!$data) return $c + 13;

        $fields = [
            'oabss' => 'OABSS',
            'qol' => 'QOL',
            'iief' => 'IIEF',
            'ehs' => 'EHS',
            'bladder_diary' => 'Bladder Diary',
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

        if ($data->c_oabss != '0') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $oabss->total_score
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        if ($data->c_qol != '0') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $qol->total_score
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        if ($data->c_iief != '0') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $iief->total_score
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        if ($data->c_ehs != '0') {
            $txt = '';
            switch($ehs->score_1){
                case 1:
                    $txt = 'Penis membesar namun tidak keras. '
                        .'Tingkat kekerasannya hanya seperti tahu atau tape';
                    break;

                case 2:
                    $txt = 'Penis membesar dan mengeras namun tidak cukup '
                        .'kuat untuk penetrasi. Tingkat kekerasannya hanya '
                        .'seperti buah pisang tanpa kulit';
                    break;

                case 3:
                    $txt = 'Penis membesar dan keras sehingga cukup kuat '
                        .'untuk penetrasi, tetapi tingkat kekerasannya hanya '
                        .'seperti pisang dengan kulit';
                    break;

                case 4:
                    $txt = 'Penis membesar, keras, dan tegang sepenuhnya '
                        .'seperti timun muda';
                    break;
            }

            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $txt);
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        if ($data->c_bladder_diary != '0') {
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
                        $txt .= $bladder_diary->{$av[0].'_1'}
                            .' '.$uom
                            .' s/d '
                            .$bladder_diary->{$av[0].'_2'}
                            .' '.$uom
                            .$uom2;
                        break;

                    case 'poliuria_nocturnal':
                        $txt .= $bladder_diary->{$av[0]};
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
