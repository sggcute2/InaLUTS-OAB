<?php

namespace App\Modules\Dropzone\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Modules\Dropzone\Models\OAB_media;
use App\Modules\Dropzone\Models\OAB_media_follow_up_v2;
use BS;

class DropzoneController extends Controller
{
    public function __construct(){
        parent::__construct([
            'module' => 'dropzone',
            'title' => 'Dropzone',
        ]);
    }

    public function index(): View
    {
        //
    }

    public function store(Request $request): JsonResponse
    {
        $name = $request->get('name');
        $table_reference = $request->get('table_reference', '');
        $reference_id = $request->get('reference_id', 0);
        $custom_field_1 = $request->get('custom_field_1', '');
        $use_model = $request->get('use_model', 'OAB_media');

        if ($use_model == 'OAB_media_follow_up_v2') {
            $media_model = new OAB_media_follow_up_v2();
        } else {
            $media_model = new OAB_media();
        }

        // Override for Follow Up
        if (
            $table_reference == 'follow_up_v2_oab_penunjang_uroflowmetri'
            || $table_reference == 'follow_up_v2_oab_penunjang_urodinamik'
        ) {
            $media_model = new OAB_media_follow_up_v2();
        }

        $files = $request->file($name);
        $seq = 0;
        foreach($files as $file){
            $seq++;
            $original_name = $file->getClientOriginalName();

            /*
            $file->extension return wrong file extension for file .xlsx
            it should return .xlsx but .bin
            */
            $x = explode('.', $original_name);
            $ext = end($x);

            $now = time();
            $size = $file->getSize();
            $saveFileName = $now
                . '_'
                . ($seq<10?'0'.$seq:$seq)
                . '_'
                . str_shuffle('123456789')
                . '.'
                . $ext;
            $folder = 'upload/'.date('Y/m/d');
            $file->move(storage_path('app/'.$folder), $saveFileName);
            $filePath = $folder . '/' . $saveFileName;
            $files_arr = [
                'table_reference' => $table_reference,
                'reference_id' => $reference_id,
                'custom_field_1' => $custom_field_1,
                'original_name' => $original_name,
                'file' => $filePath,
                'ext' => $ext,
                'size' => $size,
            ];
            $media_model::base_insert($files_arr);
        }

        $html = BS::dropzone_list_file($media_model, [
            'table_reference' => $table_reference,
            'reference_id' => $reference_id,
            'custom_field_1' => $custom_field_1,
        ]);

        return response()->json([
            'original_name' => $original_name,
            'html' => $html,
        ]);
    }

    public function download($id = '', $token = '', $use_model = '')
    {
        $is_valid = (md5('SGG-'.$id) == $token);
        if ($is_valid) {
            if ($use_model == 'OAB_media_follow_up_v2') {
                $media_model = new OAB_media_follow_up_v2();
            } else {
                $media_model = new OAB_media();
            }
            $file = $media_model::find($id);
            //dd($file);

            return response()->download(storage_path('app/'.$file->file), $file->original_name);
        } else {
            abort('403');
        }
    }

}
