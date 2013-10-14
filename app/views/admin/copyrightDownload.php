<?php
/**
 * User: Green
 * Date: 2013/10/2
 * Time: 上午 3:27
 */

$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Pinewave");

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
	->setCellValue('A1', '歌曲')
	->setCellValue('B1', '演唱人')
	->setCellValue('C1', '作詞')
	->setCellValue('D1', '作曲')
	->setCellValue('E1', '編曲')
	->setCellValue('F1', '播出日期')
	->setCellValue('G1', '播出次數')
	->setCellValue('H1', '發行公司');

$counter = 1;

foreach($copyrightData as $smallData){
	$counter++;

	$date = preg_replace("/([0-9]{4})-([0-9]{2})-([0-9]{2}) (.+)/","\\1/\\2/\\3",$smallData->VolumeDataWithMonth->FirstOnAirTime->datetime);

	$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$counter, $smallData->name)
		->setCellValue('B'.$counter, $smallData->singer)
		->setCellValue('C'.$counter, $smallData->lyricist)
		->setCellValue('D'.$counter, $smallData->composer)
		->setCellValue('E'.$counter, $smallData->arranger)
		->setCellValue('F'.$counter, $date)
		->setCellValue('G'.$counter, $smallData->playCount)
		->setCellValue('H'.$counter, $smallData->company);
//echo $counter;
}






$objPHPExcel->setActiveSheetIndex(0);

$filename = "松濤電台".$year.'年'.$month.'月'."音樂清單";
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
//header('Content-Disposition: attachment;filename="hihi.xlsx"');
header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;

