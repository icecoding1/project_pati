<?php
$dns = 'mysql:host=172.28.0.1;dbname=system_managefood';
$username = 'root';
$password = '64150';

// Create connection
try {
  $obj = new PDO($dns, $username, $password);
} catch (PDOException $e) { ?>
  <script>
    console.log("not connection")
  </script>
<?php }
?>