<?php
require_once('../../../vendor/autoload.php');
include_once('../../../controller/FacilitatorController.php');
// Initialize services

if (isset($_GET['calamity_id']) && isset($_GET['location_name'])) {
    $calamity_id = $_GET['calamity_id'];
    $calamity_type = $_GET['calamity_type'];
    $calamity_description = $_GET['description'];
    $location_name = $_GET['location_name'];
} else {
    header('Location: report.php');
    exit();
}

// Fetch data from reportEvacuaeInfo
$evacuationInfo = $facilitatorServices->reportEvacuaeInfo($calamity_id, $location_name);

// Create PDF instance
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Admin');
$pdf->SetTitle('Calamity Report');
$pdf->SetSubject('Calamity Details');
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

// Title: "Calamity Report In Every Evacuation"
$pdf->Cell(0, 10, 'Calamity Report: Evacuation Details', 0, 1, 'L');
$pdf->Ln(5); // Line break

// Display calamity type and description
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(40, 10, 'Calamity Type:', 0, 0, 'L');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 10, $calamity_type, 0, 1, 'L');

$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(40, 10, 'Calamity Description:', 0, 0, 'L');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 10, $calamity_description, 0, 'L', 0);
$pdf->Ln(10); // Line break

// Display evacuation location name
$pdf->SetFont('helvetica', 'B', 10);
$pdf->Cell(40, 10, 'Location Name:', 0, 0, 'L');
$pdf->SetFont('helvetica', '', 10);
$pdf->Cell(0, 10, $location_name, 0, 1, 'L');
$pdf->Ln(10); // Line break

// Table header for evacuees
$pdf->SetFillColor(225, 255, 200); // Light green background
$pdf->SetTextColor(0, 0, 0);       // Black text
$pdf->SetFont('helvetica', 'B', 10);

// Create the table header
$pdf->Cell(40, 10, 'Full Name', 1, 0, 'C', 1);
$pdf->Cell(50, 10, 'Address', 1, 0, 'C', 1);
$pdf->Cell(15, 10, 'Age', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'Birthdate', 1, 0, 'C', 1);
$pdf->Cell(15, 10, 'Sex', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'PWD', 1, 0, 'C', 1);
$pdf->Cell(20, 10, 'Senior', 1, 1, 'C', 1); // End row

$pdf->SetFont('helvetica', '', 10);
$pdf->SetFillColor(240, 240, 240); // Alternate row background color
$fill = false;

// Populate table rows with evacuees' info
if (!empty($evacuationInfo)) {
    foreach ($evacuationInfo as $row) {
        $pdf->Cell(40, 10, $row['fullname'], 1, 0, 'C', $fill);
        $pdf->Cell(50, 10, $row['address'], 1, 0, 'C', $fill);
        $pdf->Cell(15, 10, $row['age'], 1, 0, 'C', $fill);
        $pdf->Cell(20, 10, $row['birthdate'], 1, 0, 'C', $fill);
        $pdf->Cell(15, 10, $row['sex'], 1, 0, 'C', $fill);
        $pdf->Cell(20, 10, $row['isPwd'] ? 'Yes' : 'No', 1, 0, 'C', $fill);
        $pdf->Cell(20, 10, $row['isSenior'] ? 'Yes' : 'No', 1, 1, 'C', $fill);
        $fill = !$fill; // Alternate row colors
    }
} else {
    // No data message
    $pdf->Cell(0, 10, 'No evacuee data available for this location.', 1, 1, 'C', 0);
}

// Add line break before adding the next section
$pdf->Ln(10);

// Output the PDF
$pdf->Output('summary_report.pdf', 'D'); // 'D' forces download
?>
