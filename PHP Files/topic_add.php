<?php
session_start();
require_once './phpfunctions/connectDB.php';
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
        <h1>Add Topic</h1>
        <br/>
        <br/>
        <form method="post" action="./topic_add_action.php" enctype="multipart/form-data">
            <div>Topic Name : <input type="text" id="topic_name" name="topic_name"/></div>
            <br/>
            <div>Topic Category : 
                <select id="topic_cate" name="topic_cate">
                    <?php
                    $sql_n = "SELECT * FROM topic_cate";
                    $result_n = mysqli_query($conDB, $sql_n);
                    if (mysqli_num_rows($result_n) > 0) {
                        while ($row_n = mysqli_fetch_assoc($result_n)) {
                            ?>
                            <option value="<?php echo $row_n["id"]; ?>"><?php echo $row_n["name"]; ?></option>
                            <?php
                        }
                    }
                    ?>  


                </select>
            </div>
            <br/>
            <br/>
            <div>Topic Image : </div>
            <input type="file" name="topic_image" id="topic_image">

            <br/>
            <br/>
            <div>Topic Description : <br/><textarea id="topic_text" name="topic_text" style="height:150px; width: 300px;"></textarea></div>
            <br/>
            <br/>
            <div><input type="submit" id="submit" value="Submit"/></div>
        </form>
        <br/>
        <br/>
        <div><a href="./index.php"><< Back</a></div>
        <br/>
    </body>
</html>