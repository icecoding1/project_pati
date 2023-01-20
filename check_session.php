<?php
!isset($_SESSION["session_name"]) ? header("Location:login.php") : '';

$sql_check_member = "SELECT count(*) AS count_member FROM 	table_member WHERE id = :id";
$select_member = $obj->prepare($sql_check_member);
$select_member->execute(["id" => $_SESSION["id_member"]]);
$result_count_member =   $select_member->fetch();
if ($result_count_member['count_member'] == 0) {
  echo "<script>
if(confirm('Session หมดอายุ')){
location.assign('logout.php');
}else {
  location.assign('logout.php');
}
</script>";
}
