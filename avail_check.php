<?php
  $bfrom = $_POST['bfrom'];
  $bto = $_POST['bto'];
  $dep  = $_POST['departure'];
  $breturn = $_POST['breturn'];
  $tripType = $_POST['tripType'];
  $class = $_POST['class'];
  $passcnt = $_POST['passcnt'];
  


  if ( !empty($bfrom) || !empty($bto) || !empty($dep) || !empty($breturn) || !empty($tripType) || !empty($class) || !empty($passcnt)  )
  {
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "project";



    // Create connection
    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

    if (mysqli_connect_error())
    {
      die('Connect Error ('. mysqli_connect_errno() .') '
      . mysqli_connect_error());
    }
    else
    {
      $SELECT = "SELECT departure From booking Where departure = ? Limit 1";

      $INSERT = "INSERT Into booking (bfrom,bto,departure,breturn,tripType,class,passcnt)values(?,?,?,?,?,?,?)";

      //Prepare statement
      $stmt = $conn->prepare($SELECT);
      $stmt->bind_param("s", $dep);
      $stmt->execute();
      $stmt->bind_result($dep);
      $stmt->store_result();
      $rnum = $stmt->num_rows;

      //checking username
      if ($rnum==0) 
      {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sssssss", $bfrom, $bto , $dep , $breturn , $tripType , $class , $passcnt );
        $stmt->execute();
        echo "New record inserted sucessfully";
        header("Location: viewbooking.php");
      } 
      else 
      {
        echo "Someone already register using this departure";
      }
      $stmt->close();
      $conn->close();
    }
  } 
  else 
  {
    echo "All field are required";
    die();
  }
?>