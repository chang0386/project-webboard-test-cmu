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
        <?php
        $topic_id = $_GET["id"];
        $sql_n = "SELECT * FROM topic_data a JOIN topic_cate b ON a.topic_cate_id = b.id JOIN account_data c ON a.account_id = c.account_id JOIN webboard_data d ON a.webboard_id = d.board_id JOIN webboard_cate e ON d.webboard_cate_id = e.id WHERE (a.topic_id = $topic_id)";
        $result_n = mysqli_query($conDB, $sql_n);
        if (mysqli_num_rows($result_n) > 0) {
            while ($row_n = mysqli_fetch_assoc($result_n)) {
                $topic_name = $row_n["topic_name"];
                $topic_user = $row_n["username"];
                $topic_date = $row_n["topic_datetime"];
                $webboard_name = $row_n["board_topic"];
                $webboard_cate = $row_n["name"];
                $webboard_id = $row_n["webboard_id"];
                $topic_cate = $row_n["name"];
                $topic_text = $row_n["topic_text"];
                $topic_image = $row_n["topic_image"];
                $topic_cate_id = $row_n["topic_cate_id"];
            }
        }
        ?>
        <h1>Topics Name : <?php echo $topic_name; ?></h1>
        <h4>Webboard Category : <a href="./index.php"><?php echo $webboard_name; ?></a>



            <?php
            
            $index = 1;
            $sql = "SELECT * FROM topic_cate WHERE (id = $topic_cate_id)";
            $result = mysqli_query($conDB, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $topic_cate = $row["name"];
                    $topic_cate_id = $row["id"];
                   
                    $index++;
                }
            }
            ?>
            / <a href="./topic.php?id=<?php echo $webboard_id; ?>&filter_id=<?php echo $topic_cate_id; ?>"><?php echo $topic_cate; ?></a>
        </h4>
        <h4>Author : <?php echo $topic_user; ?></h4>
        <h4>Date : <?php echo $topic_date; ?></h4>

        <br/>
        <br/>
        <img src="./<?php echo $topic_image; ?>" style="width: 400px; height: 350px;">
        <br/>
        <br/>
        <div>
            <?php echo $topic_text; ?>
        </div>
        <br/>
        <br/>
        <br/>
        <br/>
        <div>Message : </div>
        <table>
            <th>Author</th>
            <th>DateTime</th>
            <th>Message</th>
            <tbody>
                <?php
                $sql_m = "SELECT * FROM comment_data a JOIN account_data b ON a.account_id = b.account_id WHERE (a.topic_id = $topic_id)";
                $result_m = mysqli_query($conDB, $sql_m);
                if (mysqli_num_rows($result_m) > 0) {
                    while ($row_m = mysqli_fetch_assoc($result_m)) {
                        ?>
                        <tr>
                            <td><?php echo $row_m["username"]; ?></td>
                            <td><?php echo $row_m["comment_datetime"]; ?></td>
                            <td><?php echo $row_m["comment_text"]; ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>

        <?php
        if ($_SESSION["userID"] != "") {
            ?>
            <br/>
            <br/>
            <div>Comment : <?php echo $_SESSION["userName"]; ?></div>
            <form method="post" action="./comment_action.php">
                <div><textarea id="txt_comment" name="txt_comment" style="height:150px; width: 300px;"></textarea></div>
                <input type="hidden" id="hid_topic_id" name="hid_topic_id" value="<?php echo $topic_id; ?>"/>
                <div><input type="submit" id="submit" value="Submit"/></div>
            </form>

            <br/>
            <?php
        }
        ?>

        <br/>
        <div><a href="./topic.php?id=<?php echo $webboard_id; ?>"><< Back</a></div>
    </body>
</html>