<?php

session_start();
date_default_timezone_set("Asia/Bangkok");
require_once './phpfunctions/connectDB.php';
?>

<?php

$this_datetime = date("Y-m-d H:i:s");

$topic_id = $_POST["hid_id"];
$topic_name = $_POST["topic_name"];
$topic_cate_id = $_POST["topic_cate"];
$topic_text = $_POST["topic_text"];
$topic_image = $_FILES["topic_image"];
$account_id = $_SESSION["userID"];

$index = 1;
$sql = "SELECT * FROM topic_cate WHERE id = '$topic_cate_id'";
$result = mysqli_query($conDB, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $webboard_id = $row["webboard_id"];
        $webboard_cate_id = $row["webboard_cate_id"];
    }
}


$target_folder = "upload_images/";
$target_files = $target_folder . basename($_FILES["topic_image"]["name"]);
$image_type = pathinfo($target_files, PATHINFO_EXTENSION);

$check_image = getimagesize($_FILES["topic_image"]["tmp_name"]);
if ($check_image !== false) {
    if (move_uploaded_file($_FILES["topic_image"]["tmp_name"], $target_files)) {
        $sql = "UPDATE topic_data SET (topic_image = '$target_files', topic_name = '$topic_name') WHERE (topic_id = '$topic_id')";

        if (mysqli_query($conDB, $sql)) {
            ?>
            <script>
                alert("Update");
                window.location = "./index.php";
            </script>
            <?php

        }
    }
} else {
    ?>
    <script>
        alert("Error");
        var topic_id = "<?php echo $topic_id; ?>";
        window.location = "./topic_edit.php?id="+topic_id;
    </script>
    <?php

}
?>