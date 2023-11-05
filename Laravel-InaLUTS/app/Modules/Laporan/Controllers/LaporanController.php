<?php

namespace App\Modules\Laporan\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Modules\Laporan\Models\Laporan as ModuleModel;
use App\Modules\Jenis_kelamin\Models\Jenis_kelamin;
use App\Modules\Pasien\Models\Pasien;
use App\Modules\Pasien\Models\OAB\OAB_Anamnesis;
use BS;
use DT;
use FORM;

use App\Modules\Laporan\Controllers\Traits\OAB\{
    OAB_PasienTraits,
    OAB_AnamnesisTraits
};

class LaporanController extends Controller
{

    use OAB_PasienTraits;
    use OAB_AnamnesisTraits;

    public function __construct(){
        parent::__construct([
            'module' => 'laporan',
            'title' => 'Laporan',
        ]);
    }

    public function index(): View
    {
        return 'Disabled';
    }

    public function Overactive_Bladder(): View
    {
        //dd(file_exists(resource_path('templates/Report_OAB.xlsx')));
        $page_title = 'Laporan Overactive Bladder';
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

        $pasiens = Pasien::where('registry_id', 1) // OAB
            ->whereRaw($raw_rumah_sakit)
            ->whereRaw($raw_jenis_kelamin)
            ->get();
        $in_pasien = "
            registry_id = 1
            AND $raw_rumah_sakit
            AND $raw_jenis_kelamin
        ";

        $temp = OAB_Anamnesis::whereRaw("
            pasien_id IN (SELECT id FROM m_pasien WHERE $in_pasien)
        ")->get();
        $anamnesis_by_pasien_id = [];
        foreach($temp as $v){
            $anamnesis_by_pasien_id[$v->pasien_id] = $v;
        }
        //dd($anamnesis_by_pasien_id);

        $file_template = resource_path('templates/Report_OAB.xlsx');
        //dd($file_template);

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($file_template);
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Laporan Overactive Bladder');
        $sheet->setCellValue('A2', $criteria);
        $sheet->setCellValue('A3', 'Report generated at '
            .date('D, d M Y - H:i:s', $now)
        );

        $y = 7; // Start Y
        $no = 1;
        foreach($pasiens as $pasien){
            $sheet->setCellValue('A'.$y, $no);

            $c = $this->OAB_excel_column_pasien($sheet, 2, $y, $pasien);
            $c = $this->OAB_excel_column_anamnesis($sheet, $c+1, $y,
                $anamnesis_by_pasien_id[$pasien->id], $pasien
            );

            $y++;
            $no++;
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $buffer_filename = [];
        $buffer_filename[] = 'Laporan_Overactive_Bladder';
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
