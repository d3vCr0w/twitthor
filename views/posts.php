<?php 
    session_start();
    if(!isset($_SESSION["user"])){
        $redirect_url = "http://".gethostname().":".$_SERVER['SERVER_PORT']."/twitthor/";
        header("Location: $redirect_url");
        exit();
    }

?>
<html>
    <head>
        <link rel="stylesheet" href="../public/css/app.css"></link>
        <title>Twitthor</title>
    </head>
    <body>
        <?php
            require_once("../model/User.php");
            require_once("../controller/UserController.php");
            $usernameError = $emailError = $phoneError = $passwordError = "";
            $user = new User();
            $user_controller = new UserController();
            $valid_form = true;

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if (empty($_POST["username"])) {
                    $valid_form = false;
                    $usernameError = "Username is required";
                } else {
                    $user->set_username(test_input($_POST["username"]));
                }

                if (empty($_POST["password"])) {
                    $valid_form = false;
                    $passwordError = "Password is required";
                } else {
                    $password = test_input($_POST["password"]);
                    //if (!filter_var($password, FILTER_VALIDATE_EMAIL)) {
                        //$valid_form = false;
                        //$passwordError = "Invalid password format";
                    //} else {
                        $user->set_password($password);
                    //}
                }

                if($valid_form){
                    $user_controller->login($user);
                }

            }

            /**
             * Removes leading and tailing whitespaces, backslashes and converts
             * special characters to html entities
             */
            function test_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
        <div class="container ml-30 mr-30">
            <div class="wrapper fadeInDown">
                <div class="messageView">
                    <h2 class="active">Posts</h2>
                </div>
            </div>
        </div>
    </body>
</html>