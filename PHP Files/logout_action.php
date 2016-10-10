<?php
session_start();

session_destroy();
?>


<script>
    alert("LogOut");
    window.location = "./index.php";
</script>