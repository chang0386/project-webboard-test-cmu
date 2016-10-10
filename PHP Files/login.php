<?php
//require_once './phpfunctions/connectDB.php';

?>


<html>
    <head>
        <title></title>
    </head>
    <body>
        
        <h1>Login</h1>
        <br/>
        <form method="post" action="./login_action.php">
        <div>Username : <input type="text" name="username" id="username"/></div>
        <div>Password : <input type="password" name="password" id="password"/></div>
        
        <div></div>
        <div><input type="submit" value="Login"/></div>
        
        </form>
        <div><a href="./register.php"><button>Register</button></a> </div>
    </body>
</html>