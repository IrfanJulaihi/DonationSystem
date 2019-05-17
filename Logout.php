<?php
session_start();
unset($_SESSION["MM_Username"]);  
echo "<script>
alert('You have succesfully logout!!!');
 window.location.href = 'index.php';




</script>
";

?>