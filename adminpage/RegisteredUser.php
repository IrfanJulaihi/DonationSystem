<?php

session_start();
if($_SESSION["MM_Username"]) {
?>

<?php
}else 
header("Location: ../index.php");


?>
<?php


   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', '');
   define('DB_DATABASE', 'donation');
 $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

   
      // username and password sent from form 
      

      
      $sql = "SELECT * FROM useraccount ORDER BY ID";
      
      $result = mysqli_query($db,$sql) or die(mysql_error());

      
 $display = mysqli_fetch_assoc($result); 
   
       
 

      $count = mysqli_num_rows($result);
      ?>
<html>
<script>
function goBack() {
    window.history.back();
}
function alert(){
  alert('Form Saved');
}

</script>
<head>
  <link href="../CSS/TableCSSCode.css" rel="stylesheet" type="text/css" >
</head>
<body>
   <button onClick="goBack()">Go Back</button>
<table width="100%" border="1" class="CSSTableGenerator" style="position: relative; left: 150px;">

    <tr>
      <td width="98"><div align="center">No</div></td>
      <td width="120"><div align="center">Name</div></td>
      <td width="111"><div align="center">Username</div></td>
      <td width="130"><div align="center">Email</div></td>
      <td width="137"><div align="center">Phone No</div></td>
     
      <td width="165"><div align="center">Access Level</div></td>
      <td width="169"><div align="center">Date Register</div></td>
       <td width="169"><div align="center">Modify</div></td>
      
    </tr>
    <?php $count=1; ?>
     <?php     do { ?>
      <tr>
        <td><div align="center"><?php echo $count++; ?></div></td>
      
        <td><div align="center"><?php echo $display['Name']; ?></div></td>
        <td><div align="center"><?php echo $display['username']; ?></div></td>
        <td><div align="center"><?php echo $display['email']; ?></div></td>
        <td><div align="center"><?php echo $display['TelNo'];  ?></div></td>
        
         <td><div align="center">  <?php if ($display['accesslevel']==1){?>
        <?php $Access='Admin'; ?>
      <?php }elseif($display['accesslevel']==2){?>
      <?php $Access='Donor';?>
       <?php }?>
       <?php echo $Access;?>
       </div></td>
        <td><div align="center"><?php echo date("d-m-Y H-i-s",strtotime($display['registertime']));  ?>  </div></td>
        <td> </a><a href="DeleteUser.php?ID=<?php echo $display['ID']; ?>" >
        <input type="submit" style="background-color:red;" name="button3" id="button3" value="Delete Account" onClick="return confirm('Are you sure you want to delete?');" />
        </a></td>
        <?php } while ($display = mysqli_fetch_assoc($result)) ;  mysqli_free_result($result)  ?>

    </tr>
</table>
</body>
</html>