<?php

  //Includes
  include("_includes/config.inc");
  include('_includes/dbconnect.inc');
  include("_includes/functions.inc");

  //Executing deletion if form submitted
  if(isset($_POST['delete'])){
    //Pulling all studentids to an array
    $IDs = array();
    $sql = "SELECT studentid FROM student";
    $result = mysqli_query($conn, $sql);
    $numberOfRows = 0;
    while($row = mysqli_fetch_assoc($result)){
      $IDs[] = $row['studentid'];
      $numberOfRows++;
    }
    //Deletion of rows selected
    for ($i = 0; $i < $numberOfRows; $i++){
      if(isset($_POST[$i])){
        $sql = "DELETE FROM student WHERE studentid = {$IDs[$i]}";
        $result = mysqli_query($conn, $sql);
      }
    }
  }
  //Header and Navigation Bar display
  echo template("templates/partials/header.php");
  echo template("templates/partials/nav.php");

  //Setting page content (Table headers)
  $data['content'] = "
    <form action='students.php' method='post'>
    <table class='studentList' align='center'>
    <tr>
    <th>Picture</th>
    <th>Student ID</th>
    <th>Password</th>
    <th>Date of Birth</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>House Adress</th>
    <th>Town</th>
    <th>County</th>
    <th>Country</th>
    <th>Postcode</th>
    <th>X</th>
    </tr>";

    //Display table headers
    echo template("templates/default.php", $data);

    //Setting and displaying page content (student table)
    $i = 0;
    $sql = "SELECT * FROM student";
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
    if($i%2 == 0){
      echo "<tr>";
    }
    else{
      echo "<tr style='background-color:#dae0db'>";
    }
    $data['content'] = "
    <td><img src='getpic.php?id=" . $row['studentid']. "' height='100' width='100'</td>
    <td><center>" . $row['studentid'] . "</center></td>
    <td><center>" . $row['password'] . "</center></td>
    <td><center>" . $row['dob'] . "</center></td>
    <td><center>" . $row['firstname'] . "</center></td>
    <td><center>" . $row['lastname'] . "</center></td>
    <td><center>" . $row['house'] . "</center></td>
    <td><center>" . $row['town'] . "</center></td>
    <td><center>" . $row['county'] . "</center></td>
    <td><center>" . $row['country'] . "</center></td>
    <td><center>" . $row['postcode'] . "</center></td>
    <td><center><input type='checkbox' name = " . $i . " value='set'/></center></td>
    </tr>";
    echo template("templates/default.php", $data);
    $i++;
  }

  $data['content'] = "
  </table>
  <div class='delButtonDiv'>
  <input type='submit' name='delete' value='Delete'class='submitButton'/>
  </div>
  </form>";

  echo template("templates/default.php", $data);
  echo template("templates/partials/footer.php");

  mysqli_close($conn);
?>
