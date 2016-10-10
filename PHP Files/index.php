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
        <h1>Welcome to My Webboard</h1>
        <br/>
        <div>

            <?php
            if ($_SESSION["userID"] != "") {
                ?>
                <a href="./topic_add.php"><button>Add Topic</button></a>
                <a href="./logout_action.php"><button>LogOut</button></a>
                <?php
            } else {
                ?>
                <a href="./login.php"><button>Login</button></a>
                <?php
            }
            ?>

        </div>
        <br/>
        <br/>
        <table>

            <th>Index</th>
            <th>DateTime</th>
            <th>Webboard Topics</th>
            <th>Webboard Category</th>
            <th>No. Topics</th>
            <th>Authors</th>

            <tbody>
                <?php
                $index = 1;
                $sql = "SELECT * FROM webboard_data a JOIN webboard_cate b ON a.webboard_cate_id = b.id JOIN account_data c ON a.account_id = c.account_id";
                $result = mysqli_query($conDB, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <tr>
                            <td><?php echo $index; ?></td>
                            <td><?php echo $row["board_datetime"]; ?></td>
                            <td><a href="./topic.php?id=<?php echo $row["board_id"]; ?>"><?php echo $row["board_topic"]; ?></a></td>
                            <td><?php echo $row["name"]; ?></td>
                            <td><?php
                                $webboard_id = $row["board_id"];
                                $sql_c = "SELECT COUNT(topic_id) AS numTopic FROM topic_data WHERE webboard_id = $webboard_id AND is_delete != 1";
                                $result_c = mysqli_query($conDB, $sql_c);
                                if (mysqli_num_rows($result_c) > 0) {
                                    while ($row_c = mysqli_fetch_assoc($result_c)) {
                                        echo $row_c["numTopic"];
                                    }
                                }
                                ?></td>
                            <td><?php echo $row["username"]; ?></td>
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