<?php
require 'storedsql.php';
require 'connection.php';

// Find by name
if ($_GET["name"]) {
  // SQL Injection protection.
  $name = filter_var($_GET["name"], FILTER_SANITIZE_EMAIL);
  $sql = "SELECT * FROM patient WHERE PName = \"" . $name . "\"";
  $result = $conn->query($sql);
  $output = "";

  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $output = "id: " . $row["PK_Pat_id"] . " - Name: " . $row["PName"] . " - Diagnosis: " . $row["PDiagnosis"] . "<br>";
    }
  }
}
// Adding to the database a new patient
if ($_POST["name"] && $_POST["diagnosis"] && $_POST["address"]) {
  $hospID = (int)$_POST["hospID"];
  $name = filter_var($_POST["name"], FILTER_SANITIZE_EMAIL);
  $diagnosis = filter_var($_POST["diagnosis"], FILTER_SANITIZE_EMAIL);
  $address = filter_var($_POST["address"], FILTER_SANITIZE_EMAIL);

  $sql = "INSERT INTO patient  (FK_Hosp_id, PName, PDiagnosis, PAdress)
  VALUES (" . $hospID . ", '" . $name . "', '" . $diagnosis . "', '" . $address . "')";

  if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
$conn->close();
?>
<!-- header html content -->
<?php include 'header.php' ?>

<h1 class="text-center">Patients</h1>
<br>
<div class="container">
  <a type="button" class="btn btn-secondary btn-lg btn-block" id="find">Find a Patient</a>
  <div style="display:none;" id="finddiv">
    <form action="patient.php" method="GET">
      <div class="form-group">
        <label for="exampleInputEmail1">Patient Name</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Patient Name" name="name">
        <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
  </div>

  <?php
  if ($output != "") {
    echo filter_var($output, FILTER_SANITIZE_STRING);
  }
  ?>

  <br><br>
  <a type="button" class="btn btn-dark btn-lg btn-block text-white" id="add">Add a new Patient</a>
  <div style="display:none;" id="adddiv">
    <form action="patient.php" method="POST">
      <div class="form-group">
        <br>
        <label for="exampleInputEmail1">Hospital ID (number)</label>
        <input type="nubmer" class="form-control" aria-describedby="emailHelp" placeholder="Hospital ID (number)" name="hospID" required> <br>
        <label for="exampleInputEmail1">Patient Name</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Patient Name" name="name" required> <br>
        <label for="exampleInputEmail1">Patient Diagnosis</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Patient Diagnosis" name="diagnosis" required> <br>
        <label for="exampleInputEmail1">Patient Address</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Patient Address" name="address" required> <br>
        <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>

  </div>
</div>

  <!-- footer html content -->
  <?php include 'footer.php' ?>