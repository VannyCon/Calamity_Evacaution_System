<?php
require_once('../../../vendor/autoload.php');
require_once('../../../services/DashboardServices.php');

// Initialize services
$dashboard = new DashboardServices();

if (isset($_GET['calamity_id'])) {
    $calamity_id = $_GET['calamity_id'];
    $calamity_type = $_GET['calamity_type'];
    $calamity_description = $_GET['description'];
} else {
    header('Location: report.php');
    exit();
}

// Fetch data
$evacuationData = $dashboard->reportEvacuationStatuOnCalamity($calamity_id);

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

// Title: "Calamity Report In Every Evacuation"
$pdf->Cell(0, 10, 'Calamity Report In Every Evacuation', 0, 1, 'L');
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

// Table header for calamities
$pdf->SetFillColor(225, 255, 200); // Light green background
$pdf->SetTextColor(0, 0, 0);       // Black text
$pdf->SetFont('helvetica', 'B', 10);

// Create the table header
$pdf->Cell(40, 10, 'Location Name', 1, 0, 'C', 1);
$pdf->Cell(100, 10, 'Location Description', 1, 0, 'C', 1);
$pdf->Cell(40, 10, 'Evacuee Count', 1, 1, 'C', 1); // End row

$pdf->SetFont('helvetica', '', 10);
$pdf->SetFillColor(240, 240, 240); // Alternate row background color
$fill = false;

// Populate table rows
if (!empty($evacuationData)) {
    foreach ($evacuationData as $row) {
        $pdf->Cell(40, 10, $row['location_name'], 1, 0, 'C', $fill);
        $pdf->Cell(100, 10, $row['location_description'], 1, 0, 'C', $fill);
        $pdf->Cell(40, 10, $row['evacuee_count'], 1, 1, 'C', $fill);
        $fill = !$fill; // Alternate row colors
    }
} else {
    // No data message
    $pdf->Cell(0, 10, 'No data available for this calamity.', 1, 1, 'C', 0);
}

// Add line break before adding the next section
$pdf->Ln(10);

// Output the PDF
$pdf->Output('summary_report.pdf', 'D'); // 'D' forces download
?>
