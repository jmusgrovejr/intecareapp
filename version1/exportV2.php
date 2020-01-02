<?php
session_start();

$DIR_ = $_SERVER["DOCUMENT_ROOT"]. "/Test/";
require($DIR_. "config.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// PHPExcel CODE
date_default_timezone_set('Europe/London');
require('PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
require('PHPExcel-1.8/Classes/PHPExcel.php');

$excel2 = PHPExcel_IOFactory::createReader('Excel2007');
$excel2 = $excel2->load('Cost Report Template (Formulas).xlsx'); 

$result = GetPositions($_SESSION['agencyid'], $_SESSION['period']);
while ($row = $result->fetch_assoc()) 
{
	$result2 = GetEmployeesForExport($row['PositionTitle'], $_SESSION['agencyid'], $_SESSION['period']);
	$int = 8;
	while ($row2 = $result2->fetch_assoc()) 
	{
		switch ($row2['PositionID']) 
		{
		    case "1": // DW-ADM
		        $excel2->setActiveSheetIndex(1);
				$excel2->getActiveSheet()->setCellValue('B'.$int, $row2['LastName'])
				->setCellValue('C'.$int, $row2['FirstName'])
				->setCellValue('D'.$int, $row2['PositionTitle'])
				->setCellValue('E'.$int, $row2['InteCareAgencyID'])
				->setCellValue('F'.$int, $row2['LocationCode'])
				->setCellValue('G'.$int, $row2['SalariesWages'])
				->setCellValue('H'.$int, $row2['PayrollTaxFICA'])
				->setCellValue('I'.$int, $row2['OtherFringe'])
				->setCellValue('J'.$int, $row2['DuesFees'])
				->setCellValue('K'.$int, $row2['TravelTraining'])
				->setCellValue('L'.$int, $row2['MaterialsSupplies'])
				->setCellValue('M'.$int, $row2['PurchasedServices'])
				->setCellValue('N'.$int, $row2['OtherExpenses'])
				->setCellValue('O'.$int, $row2['DSSSalariesWages'])
				->setCellValue('P'.$int, $row2['DSSFringeBenefits']);
		        break;
		    case "2": // DW-CC
		        $excel2->setActiveSheetIndex(2);
				$excel2->getActiveSheet()->setCellValue('B'.$int, $row2['LastName'])
				->setCellValue('C'.$int, $row2['FirstName'])
				->setCellValue('D'.$int, $row2['PositionTitle'])
				->setCellValue('E'.$int, $row2['InteCareAgencyID'])
				->setCellValue('F'.$int, $row2['LocationCode'])
				->setCellValue('G'.$int, $row2['SalariesWages'])
				->setCellValue('H'.$int, $row2['PayrollTaxFICA'])
				->setCellValue('I'.$int, $row2['OtherFringe'])
				->setCellValue('J'.$int, $row2['DuesFees'])
				->setCellValue('K'.$int, $row2['TravelTraining'])
				->setCellValue('L'.$int, $row2['MaterialsSupplies'])
				->setCellValue('M'.$int, $row2['PurchasedServices'])
				->setCellValue('N'.$int, $row2['OtherExpenses'])
				->setCellValue('O'.$int, $row2['DSSSalariesWages'])
				->setCellValue('P'.$int, $row2['DSSFringeBenefits']);
		        break;				        
		    case "3": // DW-IS
		        $excel2->setActiveSheetIndex(3);
				$excel2->getActiveSheet()->setCellValue('B'.$int, $row2['LastName'])
				->setCellValue('C'.$int, $row2['FirstName'])
				->setCellValue('D'.$int, $row2['PositionTitle'])
				->setCellValue('E'.$int, $row2['InteCareAgencyID'])
				->setCellValue('F'.$int, $row2['LocationCode'])
				->setCellValue('G'.$int, $row2['SalariesWages'])
				->setCellValue('H'.$int, $row2['PayrollTaxFICA'])
				->setCellValue('I'.$int, $row2['OtherFringe'])
				->setCellValue('J'.$int, $row2['DuesFees'])
				->setCellValue('K'.$int, $row2['TravelTraining'])
				->setCellValue('L'.$int, $row2['MaterialsSupplies'])
				->setCellValue('M'.$int, $row2['PurchasedServices'])
				->setCellValue('N'.$int, $row2['OtherExpenses'])
				->setCellValue('O'.$int, $row2['DSSSalariesWages'])
				->setCellValue('P'.$int, $row2['DSSFringeBenefits']);
		        break;	
		    case "4": // DW-RN
		        $excel2->setActiveSheetIndex(4);
				$excel2->getActiveSheet()->setCellValue('B'.$int, $row2['LastName'])
				->setCellValue('C'.$int, $row2['FirstName'])
				->setCellValue('D'.$int, $row2['PositionTitle'])
				->setCellValue('E'.$int, $row2['InteCareAgencyID'])
				->setCellValue('F'.$int, $row2['LocationCode'])
				->setCellValue('G'.$int, $row2['SalariesWages'])
				->setCellValue('H'.$int, $row2['PayrollTaxFICA'])
				->setCellValue('I'.$int, $row2['OtherFringe'])
				->setCellValue('J'.$int, $row2['DuesFees'])
				->setCellValue('K'.$int, $row2['TravelTraining'])
				->setCellValue('L'.$int, $row2['MaterialsSupplies'])
				->setCellValue('M'.$int, $row2['PurchasedServices'])
				->setCellValue('N'.$int, $row2['OtherExpenses'])
				->setCellValue('O'.$int, $row2['DSSSalariesWages'])
				->setCellValue('P'.$int, $row2['DSSFringeBenefits']);
		        break;	
		    case "5": // DW-MD
		        $excel2->setActiveSheetIndex(5);
				$excel2->getActiveSheet()->setCellValue('B'.$int, $row2['LastName'])
				->setCellValue('C'.$int, $row2['FirstName'])
				->setCellValue('D'.$int, $row2['PositionTitle'])
				->setCellValue('E'.$int, $row2['InteCareAgencyID'])
				->setCellValue('F'.$int, $row2['LocationCode'])
				->setCellValue('G'.$int, $row2['SalariesWages'])
				->setCellValue('H'.$int, $row2['PayrollTaxFICA'])
				->setCellValue('I'.$int, $row2['OtherFringe'])
				->setCellValue('J'.$int, $row2['DuesFees'])
				->setCellValue('K'.$int, $row2['TravelTraining'])
				->setCellValue('L'.$int, $row2['MaterialsSupplies'])
				->setCellValue('M'.$int, $row2['PurchasedServices'])
				->setCellValue('N'.$int, $row2['OtherExpenses'])
				->setCellValue('O'.$int, $row2['DSSSalariesWages'])
				->setCellValue('P'.$int, $row2['DSSFringeBenefits']);
		        break;		
		    case "6": // DW-PGSP
		        $excel2->setActiveSheetIndex(6);
				$excel2->getActiveSheet()->setCellValue('B'.$int, $row2['LastName'])
				->setCellValue('C'.$int, $row2['FirstName'])
				->setCellValue('D'.$int, $row2['PositionTitle'])
				->setCellValue('E'.$int, $row2['InteCareAgencyID'])
				->setCellValue('F'.$int, $row2['LocationCode'])
				->setCellValue('G'.$int, $row2['SalariesWages'])
				->setCellValue('H'.$int, $row2['PayrollTaxFICA'])
				->setCellValue('I'.$int, $row2['OtherFringe'])
				->setCellValue('J'.$int, $row2['DuesFees'])
				->setCellValue('K'.$int, $row2['TravelTraining'])
				->setCellValue('L'.$int, $row2['MaterialsSupplies'])
				->setCellValue('M'.$int, $row2['PurchasedServices'])
				->setCellValue('N'.$int, $row2['OtherExpenses'])
				->setCellValue('O'.$int, $row2['DSSSalariesWages'])
				->setCellValue('P'.$int, $row2['DSSFringeBenefits']);
		        break;		
		    case "7": // DW-PSY
		        $excel2->setActiveSheetIndex(7);
				$excel2->getActiveSheet()->setCellValue('B'.$int, $row2['LastName'])
				->setCellValue('C'.$int, $row2['FirstName'])
				->setCellValue('D'.$int, $row2['PositionTitle'])
				->setCellValue('E'.$int, $row2['InteCareAgencyID'])
				->setCellValue('F'.$int, $row2['LocationCode'])
				->setCellValue('G'.$int, $row2['SalariesWages'])
				->setCellValue('H'.$int, $row2['PayrollTaxFICA'])
				->setCellValue('I'.$int, $row2['OtherFringe'])
				->setCellValue('J'.$int, $row2['DuesFees'])
				->setCellValue('K'.$int, $row2['TravelTraining'])
				->setCellValue('L'.$int, $row2['MaterialsSupplies'])
				->setCellValue('M'.$int, $row2['PurchasedServices'])
				->setCellValue('N'.$int, $row2['OtherExpenses'])
				->setCellValue('O'.$int, $row2['DSSSalariesWages'])
				->setCellValue('P'.$int, $row2['DSSFringeBenefits']);
		        break;	
		    case "8": // DW-SW BS
		        $excel2->setActiveSheetIndex(8);
				$excel2->getActiveSheet()->setCellValue('B'.$int, $row2['LastName'])
				->setCellValue('C'.$int, $row2['FirstName'])
				->setCellValue('D'.$int, $row2['PositionTitle'])
				->setCellValue('E'.$int, $row2['InteCareAgencyID'])
				->setCellValue('F'.$int, $row2['LocationCode'])
				->setCellValue('G'.$int, $row2['SalariesWages'])
				->setCellValue('H'.$int, $row2['PayrollTaxFICA'])
				->setCellValue('I'.$int, $row2['OtherFringe'])
				->setCellValue('J'.$int, $row2['DuesFees'])
				->setCellValue('K'.$int, $row2['TravelTraining'])
				->setCellValue('L'.$int, $row2['MaterialsSupplies'])
				->setCellValue('M'.$int, $row2['PurchasedServices'])
				->setCellValue('N'.$int, $row2['OtherExpenses'])
				->setCellValue('O'.$int, $row2['DSSSalariesWages'])
				->setCellValue('P'.$int, $row2['DSSFringeBenefits']);
		        break;	
		    case "9": // DW-SW MSW
		        $excel2->setActiveSheetIndex(9);
				$excel2->getActiveSheet()->setCellValue('B'.$int, $row2['LastName'])
				->setCellValue('C'.$int, $row2['FirstName'])
				->setCellValue('D'.$int, $row2['PositionTitle'])
				->setCellValue('E'.$int, $row2['InteCareAgencyID'])
				->setCellValue('F'.$int, $row2['LocationCode'])
				->setCellValue('G'.$int, $row2['SalariesWages'])
				->setCellValue('H'.$int, $row2['PayrollTaxFICA'])
				->setCellValue('I'.$int, $row2['OtherFringe'])
				->setCellValue('J'.$int, $row2['DuesFees'])
				->setCellValue('K'.$int, $row2['TravelTraining'])
				->setCellValue('L'.$int, $row2['MaterialsSupplies'])
				->setCellValue('M'.$int, $row2['PurchasedServices'])
				->setCellValue('N'.$int, $row2['OtherExpenses'])
				->setCellValue('O'.$int, $row2['DSSSalariesWages'])
				->setCellValue('P'.$int, $row2['DSSFringeBenefits']);
		        break;	
		    case "10": // DW-SS
		        $excel2->setActiveSheetIndex(10);
				$excel2->getActiveSheet()->setCellValue('B'.$int, $row2['LastName'])
				->setCellValue('C'.$int, $row2['FirstName'])
				->setCellValue('D'.$int, $row2['PositionTitle'])
				->setCellValue('E'.$int, $row2['InteCareAgencyID'])
				->setCellValue('F'.$int, $row2['LocationCode'])
				->setCellValue('G'.$int, $row2['SalariesWages'])
				->setCellValue('H'.$int, $row2['PayrollTaxFICA'])
				->setCellValue('I'.$int, $row2['OtherFringe'])
				->setCellValue('J'.$int, $row2['DuesFees'])
				->setCellValue('K'.$int, $row2['TravelTraining'])
				->setCellValue('L'.$int, $row2['MaterialsSupplies'])
				->setCellValue('M'.$int, $row2['PurchasedServices'])
				->setCellValue('N'.$int, $row2['OtherExpenses'])
				->setCellValue('O'.$int, $row2['DSSSalariesWages'])
				->setCellValue('P'.$int, $row2['DSSFringeBenefits']);
		        break;		
		    case "11": // DW-TCM
		        $excel2->setActiveSheetIndex(11);
				$excel2->getActiveSheet()->setCellValue('B'.$int, $row2['LastName'])
				->setCellValue('C'.$int, $row2['FirstName'])
				->setCellValue('D'.$int, $row2['PositionTitle'])
				->setCellValue('E'.$int, $row2['InteCareAgencyID'])
				->setCellValue('F'.$int, $row2['LocationCode'])
				->setCellValue('G'.$int, $row2['SalariesWages'])
				->setCellValue('H'.$int, $row2['PayrollTaxFICA'])
				->setCellValue('I'.$int, $row2['OtherFringe'])
				->setCellValue('J'.$int, $row2['DuesFees'])
				->setCellValue('K'.$int, $row2['TravelTraining'])
				->setCellValue('L'.$int, $row2['MaterialsSupplies'])
				->setCellValue('M'.$int, $row2['PurchasedServices'])
				->setCellValue('N'.$int, $row2['OtherExpenses'])
				->setCellValue('O'.$int, $row2['DSSSalariesWages'])
				->setCellValue('P'.$int, $row2['DSSFringeBenefits']);
		        break;		
		    case "12": // DW-TP
		        $excel2->setActiveSheetIndex(12);
				$excel2->getActiveSheet()->setCellValue('B'.$int, $row2['LastName'])
				->setCellValue('C'.$int, $row2['FirstName'])
				->setCellValue('D'.$int, $row2['PositionTitle'])
				->setCellValue('E'.$int, $row2['InteCareAgencyID'])
				->setCellValue('F'.$int, $row2['LocationCode'])
				->setCellValue('G'.$int, $row2['SalariesWages'])
				->setCellValue('H'.$int, $row2['PayrollTaxFICA'])
				->setCellValue('I'.$int, $row2['OtherFringe'])
				->setCellValue('J'.$int, $row2['DuesFees'])
				->setCellValue('K'.$int, $row2['TravelTraining'])
				->setCellValue('L'.$int, $row2['MaterialsSupplies'])
				->setCellValue('M'.$int, $row2['PurchasedServices'])
				->setCellValue('N'.$int, $row2['OtherExpenses'])
				->setCellValue('O'.$int, $row2['DSSSalariesWages'])
				->setCellValue('P'.$int, $row2['DSSFringeBenefits']);
		        break;		
		    case "13": // DW-UD
		        $excel2->setActiveSheetIndex(13);
				$excel2->getActiveSheet()->setCellValue('B'.$int, $row2['LastName'])
				->setCellValue('C'.$int, $row2['FirstName'])
				->setCellValue('D'.$int, $row2['PositionTitle'])
				->setCellValue('E'.$int, $row2['InteCareAgencyID'])
				->setCellValue('F'.$int, $row2['LocationCode'])
				->setCellValue('G'.$int, $row2['SalariesWages'])
				->setCellValue('H'.$int, $row2['PayrollTaxFICA'])
				->setCellValue('I'.$int, $row2['OtherFringe'])
				->setCellValue('J'.$int, $row2['DuesFees'])
				->setCellValue('K'.$int, $row2['TravelTraining'])
				->setCellValue('L'.$int, $row2['MaterialsSupplies'])
				->setCellValue('M'.$int, $row2['PurchasedServices'])
				->setCellValue('N'.$int, $row2['OtherExpenses'])
				->setCellValue('O'.$int, $row2['DSSSalariesWages'])
				->setCellValue('P'.$int, $row2['DSSFringeBenefits']);
		        break;			        	        
		        		        		        		        		        			        			        		      		        	        
		}	
		
		$int = $int  + 1;	
	}
}

$objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');
$objWriter->save($_SESSION['agency'] . ' ' . $_SESSION['period'] . '.xlsx');
// PHPExcel CODE

// download from server
Header("Content-type: application/xls"); 
Header("Content-Disposition: attachment; filename=" . $_SESSION['agency'] . ' ' . $_SESSION['period'] . '.xlsx'); 
readfile($_SESSION['agency'] . ' ' . $_SESSION['period'] . '.xlsx');
?>