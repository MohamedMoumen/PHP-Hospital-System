<?php
// Important comment.
// This file includes all the "Stored Procedure" calls and all the "Function" calls to the database;

// Mohamed Moumen
$selectDName = "Call SelectDName();";
$countDname = "SELECT countDName();";

// Mostafa Ammar
$selectDSpecialtity = "Call SelectDSpeciality();";
$countDSalary = "SELECT countDSalary();";

// Mohamed Refaat
$selectHName = "CALL `hospital`.`GetHName`();";
$countHospital = "SELECT `hospital`.`CountHospital`(<{Hos_id INT}>)";

//Mahmoud Refaat 
$GetHAddress = "CALL `hospital`.`GetHAddress`();";
$GetAllHospitalCity = "SELECT `hospital`.`GetAllHospitalCity`(<{HCity varchar(20)}>)";

// Mohamed Yasser
$GetMProblems = "CALL `hospital`.`GetMProblem`();";
$CountMRecord = "SELECT `hospital`.`CountMRecord`(<{RecordID INT}>)";

// Mohamed AboElYosr
$GetPatients = "CALL `hospital`.`GetPatients`();";
$CountHospitals = "SELECT `hospital`.`CountHospitals`(<{Hospital INT}>)";
