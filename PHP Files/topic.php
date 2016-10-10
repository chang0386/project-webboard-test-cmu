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
        <h1>Topics</h1>
        <br/>
        <br/>
        <div><a href="./index.php"><< Back</a></div>
        <br/>
        <table>

            <th>Index</th>
            <th>DateTime</th>
            <th>Topic Name</th>
            <th>Topic Category</th>
            <th>Authors</th>
            <th>Option</th>

            <tbody>
                <?php
                $webboard_id = $_GET["id"];
                $index = 1;
                $sql = "SELECT * FROM topic_data a JOIN topic_cate b ON a.topic_cate_id = b.id JOIN account_data c ON a.account_id = c.account_id WHERE (a.webboard_id = $webboard_id AND a.is_delete != 1)";
                $result = mysqli_query($conDB, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <tr>
                            <td><?php echo $index; ?></td>
                            <td><?php echo $row["topic_datetime"]; ?></td>
                            <td><a href="./topic_detail.php?id=<?php echo $row["topic_id"]; ?>"><?php echo $row["topic_name"];?></a></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php echo $row["username"]; ?></td>
                            <td><?php
                            if($row["account_id"] == $_SESSION["userID"] || $_SESSION["userID"] == 1){
                                ?>
                                <a href="./topic_edit.php?id=<?php echo $row["topic_id"]; ?>"><button>Edit</button></a> &nbsp; <a href="./topic_remove_action.php?id=<?php echo $row["topic_id"]; ?>"><button>Remove</button></a>
                                <?php
                            }
                            ?></td>
                        </tr>
                        <?php
                        $index++;
                    }
                }
                ?>
            </tbody>
        </table>
    </body>
</html>