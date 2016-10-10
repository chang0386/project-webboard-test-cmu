<?php

session_start();
require_once './phpfunctions/connectDB.php';

$login_user = $_POST["username"];
$login_password = $_POST["password"];
$account_id = "";

//echo $login_user . " | " . $login_password . "<br/>";

$sql = "SELECT * FROM account_data WHERE username = '$login_user'";
$result = mysqli_query($conDB, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $account_id = $row["account_id"];
        $account_password = $row["password"];
        $account_name = $row["username"];
    }
}

if ($account_id != "") {
    if ($login_password != $account_password) {
        ?>
        <script>
            alert("Error ! Invalid Username or Password");
            window.location = "./login.php";
        </script>
        <?php

    } else {
        $_SESSION["userID"] = $account_id;
        $_SESSION["userName"] = $account_name;
        ?>
        <script>     
            window.location = "./index.php";
        </script>
        <?php
    }
} else {
    ?>
    <script>
        alert("Error ! Invalid Username or Password");
        window.location = "./login.php";
    </script>
    <?php

}
?>