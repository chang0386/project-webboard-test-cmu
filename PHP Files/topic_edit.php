<?php
session_start();
require_once './phpfunctions/connectDB.php';
?>

<?php
$topic_id = $_GET["id"];

$sql = "SELECT * FROM topic_data WHERE topic_id = '$topic_id'";
$result = mysqli_query($conDB, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $topic_name = $row["topic_name"];
        $topic_cate_id = $row["topic_cate_id"];
        $topic_text = $row["topic_text"];
        $topic_image = $row["topic_image"];
    }
}
?>

<html>
    <head>
        <title></title>
        <meta http-equiv=Content-Type content="text/html; charset=utf-8">
        <style>
            table {
                border-collapse: collapse;
            }

            table, th, td {
                border: 1px solid black;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <h1>Update Topic</h1>
        <br/>
        <br/>
        <form method="post" action="./topic_edit_action.php" enctype="multipart/form-data">
            <div>Topic Name : <input type="text" id="topic_name" name="topic_name" value="<?php echo $topic_name; ?>"/></div>
            <br/>
            <div>Topic Category : 
                <select id="topic_cate" name="topic_cate">
                    <?php
                    $sql_n = "SELECT * FROM topic_cate";
                    $result_n = mysqli_query($conDB, $sql_n);
                    if (mysqli_num_rows($result_n) > 0) {
                        while ($row_n = mysqli_fetch_assoc($result_n)) {
                            if($row_n["id"] == $topic_cate_id){
                                ?>
                    <option value="<?php echo $row_n["id"]; ?>" selected><?php echo $row_n["name"]; ?></option>
                            <?php
                            }else{
                                ?>
                            <option value="<?php echo $row_n["id"]; ?>"><?php echo $row_n["name"]; ?></option>
                            <?php
                            }
                            
                        }
                    }
                    ?>  


                </select>
            </div>
            <br/>
            <br/>
            <br/>
        <img src="./<?php echo $topic_image; ?>" style="width: 400px; height: 350px;">
        <br/>
        <br/>
            <div>Topic Image : </div>
            <input type="file" name="topic_image" id="topic_image">

            <br/>
            <br/>
            <div>Topic Description : <br/><textarea id="topic_text" name="topic_text" style="height:150px; width: 300px;"><?php echo $topic_text; ?></textarea></div>
            <br/>
            <br/>
            <input type="hidden" id="hid_id" name="hid_id" value="<?php echo $_GET["id"];?>" />
            <div><input type="submit" id="submit" value="Update"/></div>
        </form>
        <br/>
        <br/>
        <div><a href="./index.php"><< Back</a></div>
        <br/>
    </body>
</html>