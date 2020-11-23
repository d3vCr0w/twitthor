<?php 

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
        <div class="container ml-50 mr-50">
            <div class="wrapper fadeInDown">
                <div id="formContent">
                    <!-- Tabs Titles -->
                    <h2 class="active">Login</h2>
                    <!-- Login Form -->
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <span class = "error">* <?php echo $usernameError;?></span>
                        <input type="text" class="fadeIn first" id="username" name="username" placeholder="Username" value="<?php echo $user->get_username() != "" ? $user->get_username() : '';?>"><br>
                        <span class = "error">* <?php echo $passwordError;?></span>
                        <input type="password" class="fadeIn fourth" id="password" name="password" placeholder="Password" value="<?php echo $user->get_password() != "" ? $user->get_password() : '';?>">
                        <input type="submit" class="fadeIn fourth" value="Sign In">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>