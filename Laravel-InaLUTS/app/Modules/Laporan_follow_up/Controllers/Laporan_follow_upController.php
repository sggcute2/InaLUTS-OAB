<?php

namespace App\Modules\Laporan_follow_up\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Modules\Laporan_follow_up\Models\Laporan_follow_up as ModuleModel;
use App\Modules\Follow_up\Models\OAB\OAB_follow_up_detail;
use App\Modules\Follow_up\Models\OAB\OAB_follow_up_pemeriksaan_laboratorium;
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
    OAB_komplikasi_tindakan_invasive_operasiTrait,
    OAB_penunjangTrait,
    OAB_terapi_modifikasi_gaya_hidupTrait,
    OAB_terapi_non_operatifTrait,
    OAB_terapi_medikamentosaTrait
};

class Laporan_follow_upController extends Controller
{

    use OAB_follow_upTrait;
    use OAB_pasienTrait;
    use OAB_sistem_skorTrait;
    use OAB_efek_samping_obatTrait;
    use OAB_komplikasi_tindakan_invasive_operasiTrait;
    use OAB_penunjangTrait;
    use OAB_terapi_modifikasi_gaya_hidupTrait;
    use OAB_terapi_non_operatifTrait;
    use OAB_terapi_medikamentosaTrait;

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

        $follow_up_pemeriksaan_laboratorium =
            OAB_follow_up_pemeriksaan_laboratorium::whereRaw("
                pasien_id IN ($in_follow_up)
            ")->get();
        //dd($follow_up_pemeriksaan_laboratorium);
        $follow_up_pemeriksaan_laboratorium_by_id = [];
        foreach($follow_up_pemeriksaan_laboratorium as $v){
            $follow_up_pemeriksaan_laboratorium_by_id[$v->follow_up_id][] = $v;
        }
        //dd($follow_up_pemeriksaan_laboratorium_by_id);

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
            $z = $this->OAB_excel_column_penunjang($sheet, $c+1, $y,
                $follow_up_detail_by_id[$laporan_follow_up->id] ?? null,
                $follow_up_pemeriksaan_laboratorium_by_id[
                    $laporan_follow_up->id
                ] ?? null
            );
            $c = $z['c'];
            if ($z['y'] > $y_max) $y_max = $z['y'];
            $c = $this->OAB_excel_column_terapi_modifikasi_gaya_hidup($sheet, $c+1, $y,
                $follow_up_detail_by_id[$laporan_follow_up->id] ?? null
            );
            $c = $this->OAB_excel_column_terapi_non_operatif($sheet, $c+1, $y,
                $follow_up_detail_by_id[$laporan_follow_up->id] ?? null
            );
            $c = $this->OAB_excel_column_terapi_medikamentosa($sheet, $c+1, $y,
                $follow_up_detail_by_id[$laporan_follow_up->id] ?? null
            );

            $y += $y_max;
            $no++;
        }

        $sheet->setSelectedCell('DL8');

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
