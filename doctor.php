<!-- Requiring Connection code and stored sql code -->
<?php require 'storedsql.php' ?>

<?php
// Requiring connection file
require 'connection.php';

// Find a doctor.
if ($_GET["name"]) {
  // SQL Injection protection.
  $name = filter_var($_GET["name"], FILTER_SANITIZE_EMAIL);
  $sql = "SELECT * FROM doctor WHERE DName = \"" . $name . "\"";
  $result = $conn->query($sql);
  $output = "";

  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $output = "- Doctor id: " . $row["PK_Doc_id"] . "<br>- Hospital id: " . $row["FK_Hosp_id"] . "<br>- Doctor Name: " . $row["DName"] . "<br>- Speciality: " . $row["Speciality"] . "<br>- Salary: " . $row["Salary"] . "<br>";
    }
  }
}

// Add new doctor
if ($_POST) {
  // Values comming from the POST request(form submition)
  $hospID = (int)filter_var($_POST["hospID"], FILTER_SANITIZE_EMAIL);
  $name = filter_var($_POST["name"], FILTER_SANITIZE_EMAIL);
  $speciality = filter_var($_POST["speciality"], FILTER_SANITIZE_EMAIL);
  $salary = filter_var($_POST["salary"], FILTER_SANITIZE_EMAIL);

  $sql = "INSERT INTO doctor  (FK_Hosp_id, DName, Speciality, Salary)
  VALUES ('" . $hospID . "', '" . $name . "', '" . $speciality . "', '" . $salary . "');";
  if ($conn->query($sql) === TRUE) {
    $output2 = "New record created successfully";
  } else {
    $output2 = "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>

<!-- header html content -->
<?php include 'header.php' ?>

<h1 class="text-center">Doctors</h1>
<br>
<div class="container">
  <a type="button" class="btn btn-secondary btn-lg btn-block" id="find">Find a Doctor</a>
  <div style="display:none;" id="finddiv">
    <form action="doctor.php" method="GET">
      <div class="form-group">
        <label for="exampleInputEmail1">Doctor Name</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Doctor Name" name="name">
        <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
  </div>
  <?php
  if ($output != "") {
    echo $output;
  }
  ?>
  <br><br>
  <a type="button" class="btn btn-dark btn-lg btn-block text-white" id="add">Add a new Doctor</a>
  <div style="display:none;" id="adddiv">
    <form action="doctor.php" method="POST">
      <div class="form-group">
        <br>
        <label for="exampleInputEmail1">Hospital ID (number)</label>
        <input type="nubmer" class="form-control" aria-describedby="emailHelp" placeholder="Hospital ID (number)" name="hospID" required> <br>
        <label for="exampleInputEmail1">Doctor Name</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Doctor Name" name="name" required> <br>
        <label for="exampleInputEmail1">Doctor Speciality</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Doctor Speciality" name="speciality" required> <br>
        <label for="exampleInputEmail1">Salary</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Salary" name="salary" required> <br>
        <small id="emailHelp" class="form-text text-muted">We'll never share your information with anyone else.</small>
      </div>
      <button type="submit" class="btn btn-success">Submit</button>
    </form>
  </div>
  <?php
  if ($output2 != "") {
    echo $output2;
  }
  ?>

</div>

<!-- footer html content -->
<?php include 'footer.php' ?>