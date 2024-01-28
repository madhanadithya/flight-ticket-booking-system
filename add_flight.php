<?php
  $ffrom = $_POST['ffrom'];
  $fto = $_POST['fto'];
  $departure  = $_POST['departure'];
  $arrival = $_POST['arrival'];
  $dur = $_POST['duration'];
  $airline = $_POST['airline'];
  $price = $_POST['price'];
  


  if ( !empty($ffrom) || !empty($fto) || !empty($departure) || !empty($arrival) || !empty($dur) || !empty($airline) || !empty($price)  )
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
      $SELECT = "SELECT duration From flights Where duration = ? Limit 1";

      $INSERT = "INSERT Into flights (ffrom,fto,departure,arrival,duration,airline,price)values(?,?,?,?,?,?,?)";

      //Prepare statement
      $stmt = $conn->prepare($SELECT);
      $stmt->bind_param("s", $dur);
      $stmt->execute();
      $stmt->bind_result($dur);
      $stmt->store_result();
      $rnum = $stmt->num_rows;

      //checking username
      if ($rnum==0) 
      {
        $stmt->close();
        $stmt = $conn->prepare($INSERT);
        $stmt->bind_param("sssssss", $ffrom, $fto , $departure , $arrival , $dur , $airline , $price );
        $stmt->execute();
        echo "New record inserted sucessfully";
        header("Location: adminpanel.html");
      } 
      else 
      {
        echo "Someone already register using this duration";
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