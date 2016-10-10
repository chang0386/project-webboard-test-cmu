<?php

session_start();
date_default_timezone_set("Asia/Bangkok");
require_once './phpfunctions/connectDB.php';
?>

<?php
$topic_id = $_GET["id"];
$this_datetime = date("Y-m-d H:i:s");

$sql = "UPDATE topic_data SET is_delete = 1 WHERE (topic_id = '$topic_id')";

if (mysqli_query($conDB, $sql)) {
    ?>
    <script>
        alert("Delete");
        window.location = "./index.php";
    </script>
    <?php

}