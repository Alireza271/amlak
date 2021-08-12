<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

if (!function_exists("create_excel")){
     function create_excel()
    {
        $session_array = Session::get('Excel' . Auth::id());
        $session_keys = Session::get('Excel_keys' . Auth::id());
        $array = [];


        $file_name = date_timestamp_get(Date::now()) . rand(0, 10000) . "Excel.xlsx";
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($session_array as $item) {
            $bb = [];
            foreach ($session_keys as $key) {
                array_push($bb, $item->$key);
            }


            $array[] = $bb;
        }
        $sheet->fromArray($array);
        $writer = new Xlsx($spreadsheet);
        $writer->save($file_name);
        File::move(env('PUBLIC_PATCH', public_path()) . "/" . $file_name, env('PUBLIC_PATCH', public_path()) . "/excel/" . $file_name);
        return Response::download(env('PUBLIC_PATCH', public_path()) . "/excel/" . $file_name);
    }
}
