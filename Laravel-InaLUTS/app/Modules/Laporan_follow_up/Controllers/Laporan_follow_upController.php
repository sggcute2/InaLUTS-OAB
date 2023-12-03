<?php

namespace App\Modules\Laporan_follow_up\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Modules\Laporan_follow_up\Models\Laporan_follow_up as ModuleModel;
use App\Modules\Follow_up\Models\OAB\OAB_follow_up_detail;
use App\Modules\Jenis_kelamin\Models\Jenis_kelamin;
use App\Modules\Pasien\Models\Pasien;
use BS;
use DT;
use FORM;
use FORMAT;

use App\Modules\Laporan_follow_up\Controllers\Traits\OAB\{
    OAB_follow_upTrait,
    OAB_pasienTrait,
    OAB_sistem_skorTrait,
    OAB_efek_samping_obatTrait,
    OAB_komplikasi_tindakan_invasive_operasiTrait
};

class Laporan_follow_upController extends Controller
{

    use OAB_follow_upTrait;
    use OAB_pasienTrait;
    use OAB_sistem_skorTrait;
    use OAB_efek_samping_obatTrait;
    use OAB_komplikasi_tindakan_invasive_operasiTrait;

    public function __construct(){
        parent::__construct([
            'module' => 'laporan_follow_up',
            'title' => 'Laporan Follow Up',
        ]);
    }

    public function index(): View
    {
        return 'Disabled';
    }

    public function Overactive_Bladder(): View
    {
        //dd(file_exists(resource_path('templates/Report_OAB.xlsx')));
        $page_title = 'Laporan Follow Up Overactive Bladder';
        $form_action = route(MODULE.'.Overactive_Bladder');
        $default = [];

        return $this->moduleView('Overactive_Bladder', [
            'page_title' => $page_title,
            'form_action' => $form_action,
            'default' => $default,
        ]);
    }

    public function Overactive_Bladder_process()
    {
        $now = time();
        $req = request()->all();
        $buffer_criteria = [];

        //===[ Begin : Data ]===================================================
        if (USER_IS_REG_COO || USER_IS_LOC_COO || USER_IS_SUB) {
            $raw_rumah_sakit = 'rumah_sakit_id = '
                .intval(USER_RUMAH_SAKIT_ID);
        } else {
            $raw_rumah_sakit = 'rumah_sakit_id > 0';
        }

        if (isset($req['jenis_kelamin_id'])) {
            $temp = Jenis_kelamin::find($req['jenis_kelamin_id'])->name ?? '';
            $buffer_criteria[] = 'Jenis Kelamin : '.$temp;
            $raw_jenis_kelamin = 'jenis_kelamin_id = '
                .intval($req['jenis_kelamin_id']);
        } else {
            $raw_jenis_kelamin = 'jenis_kelamin_id > -1';
        }
        if (count($buffer_criteria) > 0) {
            $criteria = 'Kriteria = '.implode(', ', $buffer_criteria);
        } else {
            $criteria = 'Kriteria = Semua Data';
        }

        //dd($raw_rumah_sakit);
        //dd($raw_jenis_kelamin);

        $in_follow_up = "
            SELECT DISTINCT(pasien_id) FROM m_follow_up WHERE
            (
                pasien_id IN (
                    SELECT id FROM m_pasien WHERE
                        deleted_at IS NULL
                        AND registry_id = 1
                        AND $raw_rumah_sakit
                        AND $raw_jenis_kelamin
                )
                OR $raw_rumah_sakit
            )
        ";

        $laporan_follow_ups = ModuleModel::whereRaw("
                pasien_id IN (
                    SELECT id FROM m_pasien WHERE
                    deleted_at IS NULL
                    AND registry_id = 1
                    AND $raw_rumah_sakit
                    AND $raw_jenis_kelamin
                )
                OR $raw_rumah_sakit
            ") // OAB
            ->get();
        //dd($laporan_follow_ups);

        $follow_up_detail = OAB_follow_up_detail::whereRaw("
            pasien_id IN ($in_follow_up)
        ")->get();
        //dd($follow_up_detail);
        $follow_up_detail_by_id = [];
        foreach($follow_up_detail as $v){
            $follow_up_detail_by_id[$v->follow_up_id] = $v;
        }
        //dd($pasien_by_pasien_id);

        $pasiens = Pasien::where('registry_id', 1) // OAB
            ->whereRaw("
                id IN (
                    $in_follow_up
                )
            ")
            ->get();
        //dd($pasiens);
        $pasien_by_pasien_id = [];
        foreach($pasiens as $v){
            $pasien_by_pasien_id[$v->id] = $v;
        }
        //dd($pasien_by_pasien_id);

        /*
        $temp = OAB_anamnesis::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $anamnesis_by_pasien_id = [];
        foreach($temp as $v){
            $anamnesis_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($anamnesis_by_pasien_id);

        $temp = OAB_keluhan_tambahan::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $keluhan_tambahan_by_pasien_id = [];
        foreach($temp as $v){
            $keluhan_tambahan_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($keluhan_tambahan_by_pasien_id);

        $temp = OAB_faktor_resiko::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $faktor_resiko_by_pasien_id = [];
        foreach($temp as $v){
            $faktor_resiko_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($faktor_resiko_by_pasien_id);

        $temp = OAB_riwayat_pengobatan_1_bln::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $riwayat_pengobatan_1_bln_by_pasien_id = [];
        foreach($temp as $v){
            $riwayat_pengobatan_1_bln_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($riwayat_pengobatan_1_bln_by_pasien_id);

        $temp = OAB_riwayat_pengobatan_luts::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $riwayat_pengobatan_luts_by_pasien_id = [];
        foreach($temp as $v){
            $riwayat_pengobatan_luts_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($riwayat_pengobatan_luts_by_pasien_id);

        $temp = OAB_riwayat_operasi_urologi::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $riwayat_operasi_urologi_by_pasien_id = [];
        foreach($temp as $v){
            $riwayat_operasi_urologi_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($riwayat_operasi_urologi_by_pasien_id);

        $temp = OAB_riwayat_operasi_non_urologi::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $riwayat_operasi_non_urologi_by_pasien_id = [];
        foreach($temp as $v){
            $riwayat_operasi_non_urologi_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($riwayat_operasi_non_urologi_by_pasien_id);

        $temp = OAB_riwayat_radiasi::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $riwayat_radiasi_by_pasien_id = [];
        foreach($temp as $v){
            $riwayat_radiasi_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($riwayat_radiasi_by_pasien_id);

        $temp = OAB_sistem_skor::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $sistem_skor_by_pasien_id = [];
        foreach($temp as $v){
            $sistem_skor_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($sistem_skor_by_pasien_id);

        $temp = OAB_kuesioner_oabss::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $kuesioner_oabss_by_pasien_id = [];
        foreach($temp as $v){
            $kuesioner_oabss_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($kuesioner_oabss_by_pasien_id);

        $temp = OAB_kuesioner_qol::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $kuesioner_qol_by_pasien_id = [];
        foreach($temp as $v){
            $kuesioner_qol_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($kuesioner_qol_by_pasien_id);

        $temp = OAB_kuesioner_iief::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $kuesioner_iief_by_pasien_id = [];
        foreach($temp as $v){
            $kuesioner_iief_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($kuesioner_iief_by_pasien_id);

        $temp = OAB_kuesioner_ehs::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $kuesioner_ehs_by_pasien_id = [];
        foreach($temp as $v){
            $kuesioner_ehs_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($kuesioner_ehs_by_pasien_id);

        $temp = OAB_kuesioner_bladder_diary::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $kuesioner_bladder_diary_by_pasien_id = [];
        foreach($temp as $v){
            $kuesioner_bladder_diary_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($kuesioner_bladder_diary_by_pasien_id);

        $temp = OAB_pemeriksaan_fisik::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $pemeriksaan_fisik_by_pasien_id = [];
        foreach($temp as $v){
            $pemeriksaan_fisik_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($pemeriksaan_fisik_by_pasien_id);

        $temp = OAB_pemeriksaan_laboratorium::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $pemeriksaan_laboratorium_by_pasien_id = [];
        foreach($temp as $v){
            $pemeriksaan_laboratorium_by_pasien_id[$v->pasien_id][] = $v;
        }
        //dd($pemeriksaan_laboratorium_by_pasien_id);

        $temp = OAB_penunjang_uroflowmetri::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $penunjang_uroflowmetri_by_pasien_id = [];
        foreach($temp as $v){
            $penunjang_uroflowmetri_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($penunjang_uroflowmetri_by_pasien_id);

        $temp = OAB_penunjang_urodinamik::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $penunjang_urodinamik_by_pasien_id = [];
        foreach($temp as $v){
            $penunjang_urodinamik_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($penunjang_urodinamik_by_pasien_id);

        $temp = OAB_pemeriksaan_imaging::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $pemeriksaan_imaging_by_pasien_id = [];
        foreach($temp as $v){
            $pemeriksaan_imaging_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($pemeriksaan_imaging_by_pasien_id);

        $temp = OAB_diagnosis::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $diagnosis_by_pasien_id = [];
        foreach($temp as $v){
            $diagnosis_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($diagnosis_by_pasien_id);

        $temp = OAB_penunjang::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $penunjang_by_pasien_id = [];
        foreach($temp as $v){
            $penunjang_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($penunjang_by_pasien_id);

        $temp = OAB_terapi::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $terapi_by_pasien_id = [];
        foreach($temp as $v){
            $terapi_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($terapi_by_pasien_id);

        $temp = OAB_terapi_modifikasi_gaya_hidup::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $terapi_modifikasi_gaya_hidup_by_pasien_id = [];
        foreach($temp as $v){
            $terapi_modifikasi_gaya_hidup_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($terapi_modifikasi_gaya_hidup_by_pasien_id);

        $temp = OAB_terapi_rehabilitasi::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $terapi_rehabilitasi_by_pasien_id = [];
        foreach($temp as $v){
            $terapi_rehabilitasi_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($terapi_rehabilitasi_by_pasien_id);

        $temp = OAB_terapi_non_operatif::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $terapi_non_operatif_by_pasien_id = [];
        foreach($temp as $v){
            $terapi_non_operatif_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($terapi_non_operatif_by_pasien_id);

        $temp = OAB_terapi_medikamentosa::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $terapi_medikamentosa_by_pasien_id = [];
        foreach($temp as $v){
            $terapi_medikamentosa_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($terapi_medikamentosa_by_pasien_id);

        $temp = OAB_terapi_operatif::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $terapi_operatif_by_pasien_id = [];
        foreach($temp as $v){
            $terapi_operatif_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($terapi_operatif_by_pasien_id);

        $temp = OAB_terapi_operatif_injeksi_botox::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->orderBy('injeksi_botox_date', 'asc')->get();
        $terapi_operatif_injeksi_botox_by_pasien_id = [];
        foreach($temp as $v){
            $terapi_operatif_injeksi_botox_by_pasien_id[$v->pasien_id][] = $v;
        }
        //dd($terapi_operatif_injeksi_botox_by_pasien_id);
        */
        //===[ End : Data ]=====================================================

        $file_template = resource_path('templates/Report_Follow_Up_OAB.xlsx');
        //dd($file_template);

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($file_template);
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Laporan Follow Up Overactive Bladder');
        $sheet->setCellValue('A2', $criteria);
        $sheet->setCellValue('A3', 'Report generated at '
            .date('D, d M Y - H:i:s', $now)
        );

        $y = 8; // Start Y
        $no = 1;
        foreach($laporan_follow_ups as $laporan_follow_up){
            $y_max = 1;
            $sheet->setCellValue('A'.$y, $no);

            $c = $this->OAB_excel_column_follow_up($sheet, 2, $y,
                $laporan_follow_up
            );
            $c = $this->OAB_excel_column_pasien($sheet, 4, $y,
                $pasien_by_pasien_id[$laporan_follow_up->pasien_id]
            );
            $c = $this->OAB_excel_column_sistem_skor($sheet, $c+1, $y,
                $follow_up_detail_by_id[$laporan_follow_up->id] ?? null
            );
            $c = $this->OAB_excel_column_efek_samping_obat($sheet, $c+1, $y,
                $follow_up_detail_by_id[$laporan_follow_up->id] ?? null
            );
            $c = $this->OAB_excel_column_komplikasi_tindakan_invasive_operasi($sheet, $c+1, $y,
                $follow_up_detail_by_id[$laporan_follow_up->id] ?? null
            );
            /*
            $c = $this->OAB_excel_column_anamnesis($sheet, $c+1, $y,
                $anamnesis_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $c = $this->OAB_excel_column_keluhan_tambahan($sheet, $c+1, $y,
                $keluhan_tambahan_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $c = $this->OAB_excel_column_faktor_resiko($sheet, $c+1, $y,
                $faktor_resiko_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $c = $this->OAB_excel_column_riwayat_pengobatan_1_bln($sheet, $c+1, $y,
                $riwayat_pengobatan_1_bln_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $c = $this->OAB_excel_column_riwayat_pengobatan_luts($sheet, $c+1, $y,
                $riwayat_pengobatan_luts_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $c = $this->OAB_excel_column_riwayat_operasi_urologi($sheet, $c+1, $y,
                $riwayat_operasi_urologi_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $c = $this->OAB_excel_column_riwayat_operasi_non_urologi($sheet, $c+1, $y,
                $riwayat_operasi_non_urologi_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $c = $this->OAB_excel_column_riwayat_radiasi($sheet, $c+1, $y,
                $riwayat_radiasi_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $c = $this->OAB_excel_column_pemeriksaan_fisik($sheet, $c+1, $y,
                $pemeriksaan_fisik_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $zc = $this->OAB_excel_column_pemeriksaan_laboratorium($sheet, $c+1, $y,
                $pemeriksaan_laboratorium_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            //dd($zc);
            $c = $zc['c'];
            if ($zc['y'] > $y_max) $y_max = (int) $zc['y'];

            $c = $this->OAB_excel_column_penunjang_uroflowmetri($sheet, $c+1, $y,
                $penunjang_uroflowmetri_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $c = $this->OAB_excel_column_penunjang_urodinamik($sheet, $c+1, $y,
                $penunjang_urodinamik_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $c = $this->OAB_excel_column_pemeriksaan_imaging($sheet, $c+1, $y,
                $pemeriksaan_imaging_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $c = $this->OAB_excel_column_diagnosis($sheet, $c+1, $y,
                $diagnosis_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $c = $this->OAB_excel_column_penunjang($sheet, $c+1, $y,
                $penunjang_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $c = $this->OAB_excel_column_terapi($sheet, $c+1, $y,
                $terapi_by_pasien_id[$pasien->id] ?? null, $pasien
            );
            $c = $this->OAB_excel_column_terapi_modifikasi_gaya_hidup($sheet, $c+1, $y,
                $terapi_by_pasien_id[$pasien->id] ?? null,
                $terapi_modifikasi_gaya_hidup_by_pasien_id[$pasien->id] ?? null,
                $pasien
            );
            $c = $this->OAB_excel_column_terapi_rehabilitasi($sheet, $c+1, $y,
                $terapi_by_pasien_id[$pasien->id] ?? null,
                $terapi_rehabilitasi_by_pasien_id[$pasien->id] ?? null,
                $pasien
            );
            $c = $this->OAB_excel_column_terapi_non_operatif($sheet, $c+1, $y,
                $terapi_by_pasien_id[$pasien->id] ?? null,
                $terapi_non_operatif_by_pasien_id[$pasien->id] ?? null,
                $pasien
            );
            $c = $this->OAB_excel_column_terapi_medikamentosa($sheet, $c+1, $y,
                $terapi_by_pasien_id[$pasien->id] ?? null,
                $terapi_medikamentosa_by_pasien_id[$pasien->id] ?? null,
                $pasien
            );

            $zc = $this->OAB_excel_column_terapi_operatif($sheet, $c+1, $y,
                $terapi_operatif_by_pasien_id[$pasien->id] ?? null,
                $terapi_operatif_injeksi_botox_by_pasien_id[$pasien->id] ?? null,
                $pasien
            );
            //dd($zc);
            $c = $zc['c'];
            if ($zc['y'] > $y_max) $y_max = (int) $zc['y'];
            */

            //$sheet->setCellValue(FORMAT::excel_column(++$c).$y, 'SGG');

            $y += $y_max;
            $no++;
        }

        $sheet->setSelectedCell('IL8');

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $buffer_filename = [];
        $buffer_filename[] = 'Laporan_Follow_Up_Overactive_Bladder';
        $buffer_filename[] = '_'.date('Y-m-d_H-i-s', $now);
        $ct='application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
        $fn = implode('_', $buffer_filename);
        header('Content-Type: '.$ct);
        header('Content-Disposition: attachment; filename="'.$fn.'.xlsx"');
        header('Cache-Control: no-cache');
        $writer->save('php://output');
        exit;
    }

}
