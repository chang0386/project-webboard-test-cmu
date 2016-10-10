<?php

session_start();
date_default_timezone_set("Asia/Bangkok");
require_once './phpfunctions/connectDB.php';

$topic_id = $_POST["hid_topic_id"];
$account_id = $_SESSION["userID"];
$comment_text = $_POST["txt_comment"];
$this_datetime = date("Y-m-d H:i:s");

$sql = "INSERT INTO comment_data (topic_id, account_id, comment_text, comment_datetime)
VALUES ('$topic_id', '$account_id', '$comment_text', '$this_datetime')";

if (mysqli_query($conDB, $sql)) {
    ?>
    <script>
        alert("Done");
        var return_id = "<?php echo $topic_id; ?>";
        window.location = "./topic_detail.php?id="+return_id;
    </script>
    <?php

}
?>