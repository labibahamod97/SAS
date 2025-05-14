<?php
include('db.php');
$dept_id = $_GET['dept_id'];
$res = mysqli_query($conn, "SELECT * FROM doctors WHERE department_id = $dept_id");
echo "<option value=''>-- Select Doctor --</option>";
while ($row = mysqli_fetch_assoc($res)) {
  echo "<option value='{$row['id']}'>{$row['name']}</option>";
}
?>
