<!-- Requiring Connection code and stored sql code -->
<?php require 'storedsql.php' ?>

<?php 
// Requiring connection file
require 'connection.php';
// Find a hospital.
if ($_GET["id"]) {
  // SQL Injection protection.
  $id = filter_var($_GET["id"], FILTER_SANITIZE_EMAIL);
  $sql = "SELECT * FROM hospital WHERE Hos_id = \"" . $id . "\"";
  $result = $conn->query($sql);
  $output = "";

  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      $output = "id: " . $row["Hos_id"] . "<br>- Name: " . $row["Hos_Name"] . "<br>- Address: " . $row["HAdress"] . "<br>- City: " . $row["HCity"] . "<br>";
    }
  }
}

if ($_POST) {
  // Values comming from the POST request(form submition)
  $name = filter_var($_POST["name"], FILTER_SANITIZE_EMAIL);
  $address = filter_var($_POST["address"], FILTER_SANITIZE_EMAIL);
  $city = filter_var($_POST["city"], FILTER_SANITIZE_EMAIL);

  $sql = "INSERT INTO hospital  (Hos_Name, HAdress, HCity)
  VALUES (' " . $name . "', '" . $address . "', '" . $city . "')";

  if ($conn->query($sql) === TRUE) {
    $output2 = "New record created successfully";
  } else {
    $output2 = "Error: " . $sql . "<br>" . $conn->error;
  }
}

?>
<!-- header html content -->
<?php include 'header.php' ?>

<h1 class="text-center">Hospitals</h1>
<br>
<!-- Search for hospital -->
<div class="container">

  <a type="button" class="btn btn-secondary btn-lg btn-block" id="find">Find a Hospital</a>
  <div style="display:none;" id="finddiv">
    <form action="hospital.php" method="GET">
      <div class="form-group">
        <label for="inputEmail1">Hospital ID</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Hospital ID" name="id">
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

  <!-- Add new hospital -->
  <a type="button" class="btn btn-dark btn-lg btn-block text-white" id="add">Add a new Hospital</a>
  <div style="display:none;" id="adddiv">
    <form action="hospital.php" method="POST">
      <div class="form-group">
        <br>
        <label for="exampleInputEmail1">Hospital Name</label>
        <input type="nubmer" class="form-control" aria-describedby="emailHelp" placeholder="Hospital Name" name="name" required> <br>
        <label for="exampleInputEmail1">Hospital address</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Hospital address" name="address" required> <br>
        <label for="exampleInputEmail1">Hospital city</label>
        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Hospital city" name="city" required> <br>
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