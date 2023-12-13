<?php

namespace App\Modules\Laporan_follow_up\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_penunjangTrait {

    public function OAB_excel_column_penunjang(&$sheet, $c = 0, $y, $data)
    {
        $c--;

        if (!$data) return $c + 11 + 10 + 7 + 22 + 13 + 13;

        $sheet->setCellValue(
            FORMAT::excel_column(++$c).$y, $data->pemeriksaan_penunjang
        );
        if ($data->pemeriksaan_penunjang == 'Ya') {
            $sheet->setCellValue(
                FORMAT::excel_column(++$c).$y, $data->pemeriksaan_penunjang_usg
            );
            if ($data->pemeriksaan_penunjang_usg == 'Ya') {
                $temp = [];
                try {
                    $temp = unserialize($data->pemeriksaan_penunjang_usg_ya);
                } catch (Exception $exception) {
                    $temp = [];
                }
                $temp_date = '';
                if (
                    isset($temp['pemeriksaan_penunjang_usg_usg_date'])
                    && $temp['pemeriksaan_penunjang_usg_usg_date']
                ) {
                    $temp_date = ' : '.FORMAT::date(
                        $temp['pemeriksaan_penunjang_usg_usg_date']
                    );
                }
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    ($temp['pemeriksaan_penunjang_usg_usg'] ?? '').$temp_date
                );
                $temp_idx = 'pemeriksaan_penunjang_usg_'
                    .'pemeriksaan_penunjang_usg_ct_urografi';
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $temp[$temp_idx] ?? ''
                );
                $temp_idx = 'pemeriksaan_penunjang_usg_'
                    .'ginjal__kanan__hidronefrosis';
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $temp[$temp_idx] ?? ''
                );
                $temp_idx = 'pemeriksaan_penunjang_usg_'
                    .'ginjal__kanan__batu';
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $temp[$temp_idx] ?? ''
                );
                $temp_idx = 'pemeriksaan_penunjang_usg_'
                    .'ginjal__kiri__hidronefrosis';
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $temp[$temp_idx] ?? ''
                );
                $temp_idx = 'pemeriksaan_penunjang_usg_'
                    .'ginjal__kiri__batu';
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $temp[$temp_idx] ?? ''
                );
                $temp_idx = 'pemeriksaan_penunjang_usg_'
                    .'buli__batu';
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $temp[$temp_idx] ?? ''
                );
                $temp_idx = 'pemeriksaan_penunjang_usg_'
                    .'buli__divertikel';
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $temp[$temp_idx] ?? ''
                );
                $temp_idx = 'pemeriksaan_penunjang_usg_'
                    .'buli__massa_intrabuli';
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $temp[$temp_idx] ?? ''
                );
            } else {
                for($i=1;$i<=9;$i++){//USG
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
                }
            }


        } else {
            for($i=1;$i<=10;$i++){//USG
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
            for($i=1;$i<=7;$i++){//Uroflowmetri
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
            for($i=1;$i<=22;$i++){//Pemeriksaan Laboratorium
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
            for($i=1;$i<=13;$i++){//Urodinamik
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
            for($i=1;$i<=13;$i++){//Sistoskopi
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
        }

        return $c;
    }

}
