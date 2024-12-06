 <?php
// session_start();
// include_once 'config.php';
// require('./fpdf/fpdf.php');

// if (!isset($_POST['user_id'])) {
//     echo 'Invalid request.';
//     exit();
// }

// $user_id = $_POST['user_id'];


// $user_sql = "SELECT name, email, phone FROM users WHERE id = '$user_id'";
// $user_result = mysqli_query($conn, $user_sql);
// $user_data = mysqli_fetch_assoc($user_result);

// $order_sql = "SELECT * FROM checkout WHERE user_id = '$user_id'";
// $order_result = mysqli_query($conn, $order_sql);


// $pdf = new FPDF();
// $pdf->AddPage();
// $pdf->SetFont('Arial', 'B', 16);


// $pdf->Cell(0, 10, 'Order Receipt', 0, 1, 'C');
// $pdf->Ln(10);

// $pdf->SetFont('Arial', '', 12);
// $pdf->Cell(0, 10, 'Name: ' . $user_data['name'], 0, 1);
// $pdf->Cell(0, 10, 'Email: ' . $user_data['email'], 0, 1);
// $pdf->Cell(0, 10, 'Phone: ' . $user_data['phone'], 0, 1);
// $pdf->Ln(10);


// $pdf->SetFont('Arial', 'B', 12);
// $pdf->Cell(60, 10, 'Card Name', 1);
// $pdf->Cell(60, 10, 'Card Number', 1);
// $pdf->Cell(60, 10, 'Total Price', 1);
// $pdf->Ln();

// $pdf->SetFont('Arial', '', 12);
// while ($order = mysqli_fetch_assoc($order_result)) {
//     $pdf->Cell(60, 10, $order['c_name'], 1);
//     $pdf->Cell(60, 10, $order['c_num'], 1);
//     $pdf->Cell(60, 10, number_format($order['grand_total'], 2) . ' /=', 1);
//     $pdf->Ln();
// }

// $pdf->Output('D', 'Order_Receipt.pdf'); 
?> 

<?php
session_start();
include_once 'config.php';
require('./fpdf/fpdf.php');
// include('phpqrcode/qrlib.php');

// Check if the user is logged in
if (!isset($_POST['user_id'])) {
    echo 'Invalid request.';
    exit();
}

$user_id = $_POST['user_id'];

// Fetch user information
$user_sql = "SELECT name, email, phone FROM users WHERE id = '$user_id'";
$user_result = mysqli_query($conn, $user_sql);
$user_data = mysqli_fetch_assoc($user_result);

// Fetch order details
$order_sql = "SELECT * FROM checkout WHERE user_id = '$user_id'";
$order_result = mysqli_query($conn, $order_sql);

// Generate QR Code
// $qr_data = "https://your-bookshop.com";
// $qr_file = "qrcode.png";
// QRcode::png($qr_data, $qr_file, QR_ECLEVEL_L, 10);

// Create PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 16);

// Add User Details
$pdf->Cell(0, 10, 'Order Receipt', 0, 1, 'C');
$pdf->Ln(10);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Name: ' . $user_data['name'], 0, 1);
$pdf->Cell(0, 10, 'Email: ' . $user_data['email'], 0, 1);
$pdf->Cell(0, 10, 'Phone: ' . $user_data['phone'], 0, 1);
$pdf->Ln(10);

// Add Order Details
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(60, 10, 'Card Name', 1);
$pdf->Cell(60, 10, 'Card Number', 1);
$pdf->Cell(60, 10, 'Total Price', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 12);
while ($order = mysqli_fetch_assoc($order_result)) {
    $pdf->Cell(60, 10, $order['c_name'], 1);
    $pdf->Cell(60, 10, $order['c_num'], 1);
    $pdf->Cell(60, 10, number_format($order['grand_total'], 2) . ' /=', 1);
    $pdf->Ln();
}

// Add QR Code
// $pdf->Image($qr_file, 10, 250, 40, 40);

// Add Authorizing Signature
$pdf->Ln(40);
$pdf->SetFont('Arial', 'B', 12);

$pdf->Ln(10);
$pdf->Cell(0, 10, '.......................................', 0, 2);
$pdf->Cell(0, 10, 'Authorized Signature:', 0, 1);

// Add Terms & Conditions
$pdf->Ln(10);
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Terms & Conditions:', 0, 1);

$pdf->SetFont('Arial', '', 8);
$pdf->MultiCell(0, 10, "1. This receipt is valid for 30 days.\n2. Non-refundable and non-transferable.\n3. For any issues, contact support@example.com.", 0);

// Output PDF
$pdf->Output('D', 'Order_Receipt.pdf');
?>

