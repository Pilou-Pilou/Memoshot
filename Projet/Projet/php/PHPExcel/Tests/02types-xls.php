<?php
/**
 * PHPExcel
 *
 * Copyright (C) 2006 - 2012 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2012 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    1.7.8, 2012-10-12
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL', (PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once '../Classes/PHPExcel.php';


// Create new PHPExcel object
echo date('H:i:s'), " Create new PHPExcel object", EOL;
$objPHPExcel = new PHPExcel();

// Set document properties
echo date('H:i:s'), " Set document properties", EOL;
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
    ->setLastModifiedBy("Maarten Balliauw")
    ->setTitle("Office 2007 XLSX Test Document")
    ->setSubject("Office 2007 XLSX Test Document")
    ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
    ->setKeywords("office 2007 openxml php")
    ->setCategory("Test result file");

// Set default font
echo date('H:i:s'), " Set default font", EOL;
$objPHPExcel->getDefaultStyle()->getFont()->setName('Arial')
    ->setSize(10);

// Add some data, resembling some different data types
echo date('H:i:s'), " Add some data", EOL;
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'String')
    ->setCellValue('B1', 'Simple')
    ->setCellValue('C1', 'PHPExcel');

$objPHPExcel->getActiveSheet()->setCellValue('A2', 'String')
    ->setCellValue('B2', 'Symbols')
    ->setCellValue('C2', '!+&=()~§±æþ');

$objPHPExcel->getActiveSheet()->setCellValue('A3', 'String')
    ->setCellValue('B3', 'UTF-8')
    ->setCellValue('C3', 'Создать MS Excel Книги из PHP скриптов');

$objPHPExcel->getActiveSheet()->setCellValue('A4', 'Number')
    ->setCellValue('B4', 'Integer')
    ->setCellValue('C4', 12);

$objPHPExcel->getActiveSheet()->setCellValue('A5', 'Number')
    ->setCellValue('B5', 'Float')
    ->setCellValue('C5', 34.56);

$objPHPExcel->getActiveSheet()->setCellValue('A6', 'Number')
    ->setCellValue('B6', 'Negative')
    ->setCellValue('C6', -7.89);

$objPHPExcel->getActiveSheet()->setCellValue('A7', 'Boolean')
    ->setCellValue('B7', 'True')
    ->setCellValue('C7', true);

$objPHPExcel->getActiveSheet()->setCellValue('A8', 'Boolean')
    ->setCellValue('B8', 'False')
    ->setCellValue('C8', false);

$dateTimeNow = time();
$objPHPExcel->getActiveSheet()->setCellValue('A9', 'Date/Time')
    ->setCellValue('B9', 'Date')
    ->setCellValue('C9', PHPExcel_Shared_Date::PHPToExcel($dateTimeNow));
$objPHPExcel->getActiveSheet()->getStyle('C9')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_YYYYMMDD2);

$objPHPExcel->getActiveSheet()->setCellValue('A10', 'Date/Time')
    ->setCellValue('B10', 'Time')
    ->setCellValue('C10', PHPExcel_Shared_Date::PHPToExcel($dateTimeNow));
$objPHPExcel->getActiveSheet()->getStyle('C10')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_TIME4);

$objPHPExcel->getActiveSheet()->setCellValue('A11', 'Date/Time')
    ->setCellValue('B11', 'Date and Time')
    ->setCellValue('C11', PHPExcel_Shared_Date::PHPToExcel($dateTimeNow));
$objPHPExcel->getActiveSheet()->getStyle('C11')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_DATE_DATETIME);

$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);

// Rename worksheet
echo date('H:i:s'), " Rename worksheet", EOL;
$objPHPExcel->getActiveSheet()->setTitle('Datatypes');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
echo date('H:i:s'), " Write to Excel5 format", EOL;
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save(str_replace('.php', '.xls', __FILE__));
echo date('H:i:s'), " File written to ", str_replace('.php', '.xls', pathinfo(__FILE__, PATHINFO_BASENAME)), EOL;


echo date('H:i:s'), " Reload workbook from saved file", EOL;
$objPHPExcel = PHPExcel_IOFactory::load(str_replace('.php', '.xls', __FILE__));

var_dump($objPHPExcel->getActiveSheet()->toArray());


// Echo memory peak usage
echo date('H:i:s'), " Peak memory usage: ", (memory_get_peak_usage(true) / 1024 / 1024), " MB", EOL;

// Echo done
echo date('H:i:s'), " Done writing file", EOL;
echo 'File has been created in ', getcwd(), EOL;
