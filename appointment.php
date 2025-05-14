<?php include('db.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Book Appointment</title>
  <style>
      body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
           background-image: url('SASIM.png');
           background-repeat: no-repeat;
           background-attachment: fixed;
            background-size: 100% 100%;
            
        }
    .box {
      background:  rgba(255, 251, 251, 0.95);
      padding: 25px;
      max-width: 600px;
      margin: auto;
      border-radius: 8px;
      box-shadow: 0px 0px 12px rgba(0,0,0,0.1);
    }
    select, input[type="date"], input[type="time"], input[type="submit"], textarea {
      width: 100%;
      padding: 10px;
      margin: 12px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
    }
  </style>
  <script>
    function fetchDoctors(deptName) {
      const xhr = new XMLHttpRequest();
      xhr.open("GET", "get-doctors.php?dept_name=" + encodeURIComponent(deptName), true);
      xhr.onload = function () {
        if (xhr.status == 200) {
          document.getElementById("doctor").innerHTML = xhr.responseText;
        }
      }
      xhr.send();
    }
  </script>
</head>
<body>
  <div class="box">
    <h2>Book an Appointment</h2>
    <form method="post">
      <label>Choose Department</label>
      <select name="department" onchange="fetchDoctors(this.value)" required>
        <option value="">-- Choose a department or symptom --</option>
        <option>General Physician</option>
        <option>Pediatrics</option>
        <option>Gynae & Obs</option>
        <option>Dermatology</option>
        <option>Internal Medicine</option>
        <option>Endocrinology</option>
        <option>Neurology</option>
        <option>Gastroenterology</option>
        <option>Cardiology</option>
        <option>Urology</option>
        <option>Nutrition & Food Science</option>
        <option>Dentistry</option>
        <option>Psychiatry</option>
        <option>Psychology</option>
        <option>Orthopedics</option>
        <option>Pulmonology</option>
        <option>Rheumatology</option>
        <option>Nephrology</option>
        <option>Ophthalmology</option>
        <option>ENT</option>
        <option>General Surgery</option>
        <option>Oncology</option>
        <option>Breast Surgery</option>
        <option>Hematology</option>
        <option>Pediatric Hematology & Oncology</option>
        <option>Plastic Surgery</option>
        <option>Family Medicine</option>
        <option>Neurosurgery</option>
        <option>Public Health</option>
        <option>Speech Therapy</option>
        <option>Colorectal Surgery</option>
        <option>Physical Medicine & Rehabilitation</option>
        <option>Covid Unit</option>
        <option>Neonatology</option>
        <option>Pediatric Gastroenterology</option>
        <option>Pediatric Neurology</option>
        <option>Nuclear Medicine</option>
        <option>Vascular Surgery</option>
        <option>Herbal Medicine</option>
        <option>Podiatry</option>
        <option>Clinician</option>
      </select>

      <label>Choose Doctor</label>
      <select name="doctor_id" id="doctor" required>
        <option value="">-- Select Doctor --</option>
      </select>

      <label>Select Date</label>
      <input type="date" name="date" required>

      <label>Select Time</label>
      <input type="time" name="time" required>

      <label>Comments</label>
      <textarea name="comments" rows="4" placeholder="Any additional information or comments..."></textarea>

      <input type="submit" name="book" value="Book Appointment">
    </form>

    <?php
    if (isset($_POST['book'])) {
      $user_id = 1; // Replace with session-based user ID in real system
      $doctor_id = mysqli_real_escape_string($conn, $_POST['doctor_id']);
      $date = mysqli_real_escape_string($conn, $_POST['date']);
      $time = mysqli_real_escape_string($conn, $_POST['time']);
      $comments = mysqli_real_escape_string($conn, $_POST['comments']);

      $sql = "INSERT INTO appointments (user_id, doctor_id, appointment_date, appointment_time, comments) 
              VALUES ('$user_id', '$doctor_id', '$date', '$time', '$comments')";
      if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green;'>✅ Appointment booked!</p>";
      } else {
        echo "<p style='color:red;'>❌ Error: " . mysqli_error($conn) . "</p>";
      }
    }
    ?>
  </div>
</body>
</html>

