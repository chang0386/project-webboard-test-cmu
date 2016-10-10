<?php

require_once './phpfunctions/connectDB.php';
$regis_username = $_POST["username"];
$regis_password = $_POST["password"];
$regis_password_con = $_POST["password_con"];
$regis_email = $_POST["email"];

if ($regis_password != $regis_password_con) {
    ?>
    <script>
        alert("Error ! Password not match");
        window.location = "./register.php";
    </script>
    <?php

} else {

    $sql = "INSERT INTO account_data (username, password, email)
VALUES ('$regis_username', '$regis_password', '$regis_email')";

    if (mysqli_query($conDB, $sql)) {
        ?>
        <script>
            alert("Done");
            window.location = "./login.php";
        </script>
        <?php

    } else {
        ?>
        <script>
            alert("Error");
            window.location = "./register.php";
        </script>
        <?php

    }
}
?>
