<?php

namespace App\Modules\Laporan_follow_up\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_penunjangTrait {

    public function OAB_excel_column_penunjang(&$sheet, $c = 0, $y, $data, $lab)
    {
        $c--;
        $first_c = $c;
        $first_y = $y;

        if (!$data) return [
            'c' => $c + 11 + 10 + 7 + 22 + 13 + 13,
            'y' => 1
        ];

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

            $sheet->setCellValue(
                FORMAT::excel_column(++$c).$y,
                $data->pemeriksaan_penunjang_uroflowmetri
            );
            if ($data->pemeriksaan_penunjang_uroflowmetri == 'Ya') {
                $temp = [];
                try {
                    $temp = unserialize(
                        $data->pemeriksaan_penunjang_uroflowmetri_ya
                    );
                } catch (Exception $exception) {
                    $temp = [];
                }
                $temp_date = '';
                if (
                    isset($temp['pemeriksaan_penunjang_uroflowmetri_tgl_date'])
                    && $temp['pemeriksaan_penunjang_uroflowmetri_tgl_date']
                ) {
                    $temp_date = FORMAT::date(
                        $temp['pemeriksaan_penunjang_uroflowmetri_tgl_date']
                    );
                }
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp_date);
                $fields = [
                    'voided_volume',
                    'q_max',
                    'q_ave',
                    'pvr',
                    'voiding_time',
                ];
                $uom = [
                    'ml',
                    'ml / detik',
                    'ml',
                    'ml',
                    'detik',
                ];
                foreach($fields as $idx => $field){
                    $temp_idx = 'pemeriksaan_penunjang_uroflowmetri_'.$field;
                    if ($temp[$temp_idx] == 'Ya') {
                        $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                            $temp[$temp_idx]
                            .' : '
                            .$temp[$temp_idx.'_ya']
                            .' '
                            .$uom[$idx]
                        );
                    } else {
                        $sheet->setCellValue(
                            FORMAT::excel_column(++$c).$y, $temp[$temp_idx]
                        );
                    }
                }
             } else {
                for($i=1;$i<=6;$i++){//Uroflowmetri
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
                }
            }

            $sheet->setCellValue(
                FORMAT::excel_column(++$c).$y,
                $data->pemeriksaan_penunjang_pemeriksaan_laboratorium
            );
            if (
                $data->pemeriksaan_penunjang_pemeriksaan_laboratorium == 'Ya'
                && $lab
            ) {
                foreach($lab as $v){
                    $c = $first_c + 19;

                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, FORMAT::date($v->lab_date));
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->hb);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->leukosit);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->trombosit);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->ureum);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->kreatinin);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->gds);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->ph);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->protein);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->glukosa);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->nitrit);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->leukosit_esterase);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->eritrosit);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->urinalisa_leukosit);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->kristal);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->bakteri);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->jamur);
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $v->kultur_urin);

                    $y++;
                }
            } else {
                for($i=1;$i<=21;$i++){//Pemeriksaan Laboratorium
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
                }
            }

            $c = $first_c + 19 + 21;
            $y = $first_y;
            $sheet->setCellValue(
                FORMAT::excel_column(++$c).$y,
                $data->pemeriksaan_penunjang_urodinamik
            );
            if ($data->pemeriksaan_penunjang_urodinamik == 'Ya') {
                $temp_ns = 'pemeriksaan_penunjang_urodinamik_';
                $temp = [];
                try {
                    $temp = unserialize(
                        $data->pemeriksaan_penunjang_urodinamik_ya
                    );
                } catch (Exception $exception) {
                    $temp = [];
                }
                $temp_date = '';
                if (
                    isset($temp['pemeriksaan_penunjang_urodinamik_pemeriksaan_urodinamik_ya_date'])
                    && $temp['pemeriksaan_penunjang_urodinamik_pemeriksaan_urodinamik_ya_date']
                ) {
                    $temp_date = FORMAT::date(
                        $temp['pemeriksaan_penunjang_urodinamik_pemeriksaan_urodinamik_ya_date']
                    );
                }
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $temp_date);
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    ($temp[$temp_ns.'kapasitas_kandung_kemih_1'] ?? '')
                    .' - '
                    .($temp[$temp_ns.'kapasitas_kandung_kemih_2'] ?? '')
                    .' ml'
                );
                $fields = [
                    'compliance',
                    'detrusor_overactivity',
                    'detrusor_overactivity_incontinence',
                    'urodynamic_stress_urinary_incontinence',
                    'obstruksi_infravesical',
                    'detrusor_underactivity',
                    'disfunctional_voiding',
                    'dsd',
                    'neurogenic_bladder',
                ];
                foreach($fields as $field){
                    $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                        ($temp[$temp_ns.$field] ?? '')
                    );
                }
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    ($temp[$temp_ns.'pvr_1'] ?? '')
                    .' - '
                    .($temp[$temp_ns.'pvr_2'] ?? '')
                    .' ml'
                );
             } else {
                for($i=1;$i<=12;$i++){//Urodinamik
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

        return [
            'c' => $c,
            'y' => $lab ? count($lab) : 1
        ];
    }

}
