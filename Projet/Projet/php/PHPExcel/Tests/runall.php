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

if (PHP_SAPI != 'cli') {
    die ('This script executes all tests, and should only be run from the command line');
}

// List of tests
$aTests = array(
    '01simple.php'
, '02types.php'
, '02types-xls.php'
, '03formulas.php'
, '04printing.php'
, '05featuredemo.php'
, '06largescale.php'
, '06largescale-xls.php'
, '07reader.php'
, '08conditionalformatting.php'
, '09pagebreaks.php'
, '10autofilter.php'
, '10autofilter-selection-1.php'
, '10autofilter-selection-2.php'
, '11documentsecurity.php'
, '11documentsecurity-xls.php'
, '13calculation.php'
, '14excel5.php'
, '15datavalidation.php'
, '15datavalidation-xls.php'
, '16csv.php'
, '17html.php'
, '18extendedcalculation.php'
, '19namedrange.php'
, '20readexcel5.php'
, '21pdf.php'
, '22heavilyformatted.php'
, '23sharedstyles.php'
, '24readfilter.php'
, '25inmemoryimage.php'
, '26utf8.php'
, '27imagesexcel5.php'
, '28iterator.php'
, '29advancedvaluebinder.php'
, '30template.php'
, '31docproperties_write.php'
, '31docproperties_write-xls.php'
, '32chartreadwrite.php'
, '33chartcreate-area.php'
, '33chartcreate-bar.php'
, '33chartcreate-bar-stacked.php'
, '33chartcreate-column.php'
, '33chartcreate-column-2.php'
, '33chartcreate-line.php'
, '34chartupdate.php'
, 'OOCalcReader.php'
, 'SylkReader.php'
, 'Excel2003XMLReader.php'
, 'XMLReader.php'
, 'GnumericReader.php'
);

// First, clear all results
foreach ($aTests as $sTest) {
    @unlink(str_replace('.php', '.xls', $sTest));
    @unlink(str_replace('.php', '.xlsx', $sTest));
    @unlink(str_replace('.php', '.csv', $sTest));
    @unlink(str_replace('.php', '.htm', $sTest));
    @unlink(str_replace('.php', '.pdf', $sTest));
}

// Run all tests
foreach ($aTests as $sTest) {
    echo '============== TEST ==============' . "\r\n";
    echo 'Test name: ' . $sTest . "\r\n";
    echo "\r\n";
    echo shell_exec('php ' . $sTest);
    echo "\r\n";
    echo "\r\n";
}
