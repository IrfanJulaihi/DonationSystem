<?php
 define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE','donation');
 $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   session_start();
   
   $name=$_POST['name'];
   $UserId=$_POST['username'];
   $Password=$_POST['Password'];
   $Password2=$_POST['Password2'];
   $Email=$_POST['email'];
   $PhoneNo=$_POST['phoneNo'];
$PostCode=$_POST['Postcode'];
   $address=$_POST['Address'];
   
   
      
   
     $insertSQL = "INSERT INTO useraccount (Name, username, password, Address, postcode, TelNo, email,accesslevel,registertime) VALUES ('$name','$UserId','$Password','$address','$PostCode','$Email','$PhoneNo','2',NOW())";
$sql_u = "SELECT * FROM useraccount WHERE username='$UserId'";
    $sql_e = "SELECT * FROM useraccount WHERE email='$Email'";
    $res_u = mysqli_query($db, $sql_u);
    $res_e = mysqli_query($db, $sql_e);


 if (mysqli_num_rows($res_u) > 0) {
   echo "<script>alert('Sorry... username already taken');
  window.history.back();
  </script>";
  }else if(mysqli_num_rows($res_e) > 0){
       echo "<script>alert('Sorry... Email already taken');
  window.history.back(); 
  </script>";
    }else if($Password!=$Password2){
       echo "<script>alert('Both password doesn`t match');
  window.history.back();
  </script>";
    }else{
      if (mysqli_query($db,$insertSQL)) {
   echo "<script>alert('Congratulations..!!You have successfully registered');
  window.history.back();
  </script>";
} else {
    echo "Error: " ;}   
}

       
                  
     

   
  
  
   
    
   
   
?>