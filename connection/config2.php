<?php
$dns = 'mysql:host=localhost;dbname=system_managefood';
$username = 'root';
$password = '';

// Create connection
try {
  $obj = new PDO($dns, $username, $password);
?>
  <script>
    console.log("success full connection")
  </script>

<?php
echo "success connec";
} catch (PDOException $e) { ?>
  <script>
    console.log("not connection")
  </script>
<?php }
?>