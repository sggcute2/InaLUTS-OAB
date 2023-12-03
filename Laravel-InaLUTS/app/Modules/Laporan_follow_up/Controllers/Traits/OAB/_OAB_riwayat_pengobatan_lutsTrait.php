<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_riwayat_pengobatan_lutsTrait {

    public function OAB_excel_column_riwayat_pengobatan_luts(&$sheet, $c = 0, $y, $data, $pasien)
    {
        $c--;

        if (!$data) return $c + 29;

        $fields = [
            'tamsulosin',
            'alfuzosin',
            'doxazosin',
            'terazosin',
            'silodosin',
        ];
        foreach($fields as $field){
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->{$field}
            );

            if ($data->{$field} == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $data->{$field.'_hari'}.' Hari, '
                    .$data->{$field.'_bulan'}.' Bulan, '
                    .$data->{$field.'_tahun'}.' Tahun'
                );
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
        }

        $fields = [
            'finasteride',
            'dutasteride',
        ];
        foreach($fields as $field){
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->{$field}
            );

            if ($data->{$field} == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $data->{$field.'_bulan'}.' Bulan'
                );
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
        }

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
            $data->pde_5_inhibitor
        );
        if ($data->pde_5_inhibitor == 'Ya') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->tadalafil
            );
            if ($data->tadalafil == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->tadalafil_bulan.' Bulan');
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        $fields = [
            'solifenacin',
            'imidafenacin',
            'tolterodine',
            'propiverine',
            'flavoxate',

            'mirabegron',
        ];
        foreach($fields as $field){
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->{$field}
            );

            if ($data->{$field} == 'Ya') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $data->{$field.'_bulan'}.' Bulan'
                );
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            }
        }

        return $c;
    }

}
