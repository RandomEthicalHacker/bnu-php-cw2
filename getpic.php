<?php

  include('_includes/dbconnect.inc');

  $id = $_GET['id'];
  $sql = "SELECT picture FROM student WHERE studentid= '$id'";

  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

  $jpg = $row["picture"];

  echo $jpg;
?>
