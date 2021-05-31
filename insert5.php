<?php

    include("_includes/dbconnect.inc");
    include "_includes/passwordLib.php";

    require_once 'vendor/autoload.php';

    $faker = Faker\Factory::create();


    for($i = 0; $i < 5; $i++){
      $stID = $faker->numberBetween(20000001, 99999999);
      $pwd = password_hash($faker->password, PASSWORD_DEFAULT);
      $dob = $faker->date($format = 'Y-m-d', $max = '-18 years');
      $fName = $faker->firstName($gender = 'male'|'female');
      $lName = $faker->lastname;
      $address = $faker->buildingNumber . " " . $faker->streetName;
      $town = "High Wycombe";
      $county = "Bucks";
      $country = "UK";
      $postcode = "HP1" . $faker->numberBetween(0, 1) . " " . $faker->randomNumber(2, false) . strtoupper($faker->randomLetter) . strtoupper($faker->randomLetter);

      $sql = "INSERT INTO `student` (`studentid`, `password`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, `country`, `postcode`)
              VALUES ('$stID', '$pwd', '$dob', '$fName', '$lName', '$address', '$town', '$county', '$country', '$postcode');";

      $result = mysqli_query($conn, $sql);
    }

    if($result){
      echo "Successful insertion!";
    }
    else{
      echo "An error occured!";
    }
 ?>
