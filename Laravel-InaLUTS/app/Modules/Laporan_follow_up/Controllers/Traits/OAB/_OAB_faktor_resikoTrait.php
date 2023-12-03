<?php

namespace App\Modules\Laporan\Controllers\Traits\OAB;

use FORMAT;
use SS;

trait OAB_faktor_resikoTrait {

    public function OAB_excel_column_faktor_resiko(&$sheet, $c = 0, $y, $data, $pasien)
    {
        $c--;

        if (!$data) return $c + 25;

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->alergi);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->penyakit_paru);

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->gangguan_mood);
        if ($data->gangguan_mood == 'Ya') {
            if ($data->gangguan_mood_ya == 'Gangguan Mood') {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $data->gangguan_mood_ya.' , '.$data->gangguan_mood_ya2
                );
            } else {
                $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                    $data->gangguan_mood_ya
                );
            }
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->diabetes);
        if ($data->diabetes == 'Ya') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->diabetes_ya
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->penyakit_jantung_kongestif);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->penyakit_saluran_cerna);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->hipertensi);

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->menopause);
        if ($data->menopause == 'Ya') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->menopause_ya
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->overdistensi_buli);

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->kanker_ginekologi);
        if ($data->kanker_ginekologi == 'Ya') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->kanker_ginekologi_ya
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->stroke);

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->spinal_cord_injury);
        if ($data->spinal_cord_injury == 'Ya') {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->trauma_tulang_belakang
            );
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->tumor_tulang_belakang
            );
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->myelitis
            );
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y,
                $data->spondilitis_tb
            );
        } else {
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
            $sheet->setCellValue(FORMAT::excel_column(++$c).$y, '');
        }

        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->parkinson);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->penyakit_saraf_tepi);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->hnp);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->multiple_sclerosis);
        $sheet->setCellValue(FORMAT::excel_column(++$c).$y, $data->msa);

        return $c;
    }

}
