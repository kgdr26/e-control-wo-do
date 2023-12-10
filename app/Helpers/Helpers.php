<?php

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function idn_user($id){
    $arr    = collect(\DB::select("SELECT * FROM users WHERE id='$id'"))->first();
    return $arr;
}

function downloadsto($filename,$start_export,$end_export){
    $inputFileType = IOFactory::identify($filename);
    $reader        = IOFactory::createReader($inputFileType);
    $spreadsheet   = $reader->load($filename);

    $arr           = DB::select("SELECT * FROM trx_sto WHERE DATE(wo_date) BETWEEN '$start_export' AND '$end_export'");

    $row    = 2;
    $no     = 1;
    foreach ($arr as $key => $val) {
        $spreadsheet->getSheet(0)->setCellValue('A' . $row, $no++);
        $spreadsheet->getSheet(0)->setCellValue('B' . $row, $val->so_no);
        $spreadsheet->getSheet(0)->setCellValue('C' . $row, $val->pt_no);
        $spreadsheet->getSheet(0)->setCellValue('D' . $row, $val->wo_state);
        $spreadsheet->getSheet(0)->setCellValue('E' . $row, $val->wo_date);
        $spreadsheet->getSheet(0)->setCellValue('F' . $row, $val->do_no);
        $spreadsheet->getSheet(0)->setCellValue('G' . $row, $val->do_date);
        $spreadsheet->getSheet(0)->setCellValue('H' . $row, $val->do_state);
        $row++;
    }

    return $spreadsheet;
}

?>
