<?php
session_start();
include "conn/conn.php";

require 'vendor/autoload.php'; // Adjust the path if necessary
error_reporting(E_ALL); // Enable error reporting for debugging

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx; // Use Xlsx for .xlsx files
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment; // Include Alignment for centering text

if (empty($_SESSION['UserID']) AND empty($_SESSION['Password'])) {
    header('location:index.php');
    exit(); // Ensure no further code runs after a redirect
} else {
    // Create a new Spreadsheet object
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Set header row
    $sheet->setCellValue('A1', 'ID Asset')
          ->setCellValue('B1', 'Categories')
          ->setCellValue('C1', 'Sub Categories')
          ->setCellValue('D1', 'Type')
          ->setCellValue('E1', 'Brand / Model')
          ->setCellValue('F1', 'Quantity')
          ->setCellValue('G1', 'QR Code');

    // Center align and middle align the header row
    $sheet->getStyle('A1:G1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('A1:G1')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

    // Fetch asset data from database
    $sql = mysqli_query($conn, "SELECT * FROM asset ORDER BY asset_id ASC");
    $rowNum = 2; // Starting from row 2, since row 1 is the header

    while ($row = mysqli_fetch_array($sql)) {
        // Insert asset data into the spreadsheet
        $sheet->setCellValue('A' . $rowNum, $row['asset_id'])
              ->setCellValue('B' . $rowNum, $row['category'])
              ->setCellValue('C' . $rowNum, $row['sub_category'])
              ->setCellValue('D' . $rowNum, $row['type'])
              ->setCellValue('E' . $rowNum, $row['brand'])
              ->setCellValue('F' . $rowNum, $row['quantity']);

        // Center align and middle align the text in the data rows
        $sheet->getStyle('A' . $rowNum . ':G' . $rowNum)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A' . $rowNum . ':G' . $rowNum)->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);

        // Add QR code image
        $qrImagePath = 'qrcode/' . $row['qrcode']; // Assuming QR codes are stored in this folder
        if (file_exists($qrImagePath)) {
            $drawing = new Drawing();
            $drawing->setPath($qrImagePath);
            $drawing->setCoordinates('G' . $rowNum);
            $drawing->setWidthAndHeight(50, 50); // Adjust the size if needed
            $drawing->setWorksheet($sheet);

            // Set row height to accommodate the QR code image
            $sheet->getRowDimension($rowNum)->setRowHeight(60); // Adjust height as needed
        }

        $rowNum++;
    }

    // Clear output buffer to avoid corrupt file issues
    ob_end_clean();

    // Set the header for downloading the file in .xlsx format
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="QR_Code_Asset_List.xlsx"'); // Changed extension to .xlsx
    header('Cache-Control: max-age=0');

    // Create an Xlsx writer and output the file to the browser
    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit(); // Ensure script ends after output
}
?>


