<?php
require_once('../../../vendor/autoload.php');
require_once('../../../services/DashboardServices.php');

// Initialize services
$dashboard = new DashboardServices();

// Fetch data
$countCalamity = $dashboard->getCalamityThisYear();
$top = $dashboard->topCalamityThisYear();
$total = $dashboard->getViewTotal();
$record = $dashboard->getAllCalamityThisYear();

// Create PDF instance
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Admin');
$pdf->SetTitle('Summary Report');
$pdf->SetSubject('Calamity this Year');
$pdf->SetKeywords('TCPDF, PDF, Calamity, Disaster, Evacuation');

// Set default header data
$pdf->SetHeaderData('', 0, 'Calamity Summary Report', 'Generated on ' . date('Y-m-d'));

// Set margins
$pdf->SetMargins(15, 27, 15);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(10);

// Add a page
$pdf->AddPage();

// Set font for the document
$pdf->SetFont('helvetica', '', 12);

// Title: "Summary of Calamity"
$pdf->Cell(0, 10, 'Summary of Calamity', 0, 1, 'L');
$pdf->Ln(5); // Line break

// Table header for calamities
$pdf->SetFillColor(225, 255, 200);
$pdf->Cell(10, 7, 'ID', 1, 0, 'C', 1);
$pdf->Cell(60, 7, 'Date', 1, 0, 'C', 1);
$pdf->Cell(95, 7, 'Description', 1, 0, 'C', 1);
$pdf->Cell(15, 7, 'Level', 1, 1, 'C', 1);

// Table rows for calamities
foreach ($record as $calamity) {
    // Format the date and time
    $dateTime = date("F j, g:i A", strtotime($calamity['calamity_date'] . " " . $calamity['calamity_time']));

    // Check if the description length is greater than 35 characters
    $description = $calamity['calamity_description'];
    if (strlen($description) > 35) {
        // Split the description and add it to two rows
        $firstPart = substr($description, 0, 35);
        $secondPart = substr($description, 35);
        
        // First row
        $pdf->Cell(10, 7, $calamity['id'], 1, 0, 'C');
        $pdf->Cell(60, 7, $dateTime, 1, 0, 'C');
        $pdf->Cell(95, 7, $firstPart, 1, 0, 'C');
        $pdf->Cell(15, 7, $calamity['status_level'], 1, 1, 'C');
        
        // Second row
        $pdf->Cell(10, 7, '', 1, 0, 'C');
        $pdf->Cell(60, 7, '', 1, 0, 'C');
        $pdf->Cell(95, 7, $secondPart, 1, 0, 'C');
        $pdf->Cell(15, 7, '', 1, 1, 'C');
    } else {
        // Normal row with short description
        $pdf->Cell(10, 7, $calamity['id'], 1, 0, 'C');
        $pdf->Cell(60, 7, $dateTime, 1, 0, 'C');
        $pdf->Cell(95, 7, $description, 1, 0, 'C');
        $pdf->Cell(15, 7, $calamity['status_level'], 1, 1, 'C');
    }
}

// Add line break before adding the next section
$pdf->Ln(10);

// Add table for "Calamities This Year" - fetched from `getCalamityThisYear`
$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(0, 10, 'Calamity Each Month', 0, 1, 'L');
$pdf->SetFillColor(225, 255, 200);
$pdf->Cell(90, 7, 'Month', 1, 0, 'C', 1);
$pdf->Cell(90, 7, 'Count', 1, 1, 'C', 1);

// Loop through and display calamity counts per month
foreach ($countCalamity as $calamity) {
    $pdf->Cell(90, 7, $calamity['month_name'], 1, 0, 'C');
    $pdf->Cell(90, 7, $calamity['calamity_count'], 1, 1, 'C');
}

// Add line break
$pdf->Ln(10);

// Add table for "Top Calamities This Year" - fetched from `topCalamityThisYear`
$pdf->Cell(0, 10, 'Top Calamities This Year', 0, 1, 'L');
$pdf->SetFillColor(225, 255, 200);
$pdf->Cell(90, 7, 'Calamity Type', 1, 0, 'C', 1);
$pdf->Cell(90, 7, 'Count', 1, 1, 'C', 1);

// Loop through and display top calamity types
foreach ($top as $calamity) {
    $pdf->Cell(90, 7, $calamity['calamity_type'], 1, 0, 'C');
    $pdf->Cell(90, 7, $calamity['calamity_count'], 1, 1, 'C');
}

// Add line break
$pdf->Ln(10);

// Add table for "Total Evacuations and Active Calamities" - fetched from `getViewTotal`
$pdf->Cell(0, 10, 'Total Evacuations and Active Calamities', 0, 1, 'L');
$pdf->SetFillColor(225, 255, 200);
$pdf->Cell(90, 7, 'Evacuations', 1, 0, 'C', 1);
$pdf->Cell(90, 7, 'Active Calamities', 1, 1, 'C', 1);

// Display total evacuations and active calamities
$pdf->Cell(90, 7, $total['total_evacuations'], 1, 0, 'C');
$pdf->Cell(90, 7, $total['active_calamities'], 1, 1, 'C');

// Output the PDF
$pdf->Output('summary_report.pdf', 'D'); // 'D' forces download
?>
