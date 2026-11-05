<?php
require 'vendor/autoload.php';
include('db.php');

use Dompdf\Dompdf;

if (!isset($_GET['id'])) {
    die("Invalid appointment ID.");
}

$appointment_id = intval($_GET['id']);

$sql = "SELECT a.*, 
               d.name AS doctor_name, d.department, 
               u.name AS patient_name, u.phone, u.serial_number, u.address
        FROM appointments a
        JOIN doctors d ON a.doctor_id = d.id
        JOIN users u ON a.user_id = u.id
        WHERE a.id = $appointment_id";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) != 1) {
    die("Appointment not found.");
}

$row = mysqli_fetch_assoc($result);

$html = '
<h2 style="color: green;">✅ Appointment Confirmed</h2>
<p><strong>Patient Name:</strong> ' . htmlspecialchars($row['patient_name']) . '</p>
<p><strong>Phone:</strong> ' . htmlspecialchars($row['phone']) . '</p>
<p><strong>Address:</strong> ' . htmlspecialchars($row['address'] ?? 'Not provided') . '</p>
<p><strong>Serial Number:</strong> ' . htmlspecialchars($row['serial_number']) . '</p>
<hr>
<p><strong>Doctor:</strong> ' . htmlspecialchars($row['doctor_name']) . ' (' . htmlspecialchars($row['department']) . ')</p>
<p><strong>Date:</strong> ' . htmlspecialchars($row['appointment_date']) . '</p>
<p><strong>Time:</strong> ' . htmlspecialchars($row['appointment_time']) . '</p>
<p><strong>Comments:</strong> ' . htmlspecialchars($row['comments']) . '</p>';

// Create PDF
$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Appointment_$appointment_id.pdf", ["Attachment" => 1]);
