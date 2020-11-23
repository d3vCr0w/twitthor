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

                if (empty($_POST["phone"])) {
                    $valid_form = false;
                    $phoneError = "Phone is required";
                } else {
                    $phone = test_input($_POST["phone"]);
                    if (!preg_match('/[0-9]{10,}/', $phone)) {
                        $valid_form = false;
                        $phoneError = "Phone must have at least 10 numbers";
                    }
                    $user->set_phone($phone);
                }

                if (empty($_POST["email"])) {
                    $valid_form = false;
                    $emailError = "Email is required";
                } else {
                    $email = test_input($_POST["email"]);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $valid_form = false;
                        $emailError = "Invalid email format";
                    } else {
                        $user->set_email($email);
                    }
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
                    $user_controller->create_account($user);
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
                    <h2 class="active">Create Account</h2>
                    <!-- Login Form -->
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <span class = "error">* <?php echo $usernameError;?></span>
                        <input type="text" class="fadeIn first" id="username" name="username" placeholder="Username" value="<?php echo $user->get_username() != "" ? $user->get_username() : '';?>"><br>
                        <span class = "error">* <?php echo $phoneError;?></span>
                        <input type="tel" class="fadeIn second" id="phone" name="phone" placeholder="Phone" value="<?php echo $user->get_phone() != "" ? $user->get_phone() : '';?>"><br>
                        <span class = "error">* <?php echo $emailError;?></span>
                        <input type="email" class="fadeIn third" id="email" name="email" placeholder="Email" value="<?php echo $user->get_email() != "" ? $user->get_email() : '';?>"><br>
                        <span class = "error">* <?php echo $passwordError;?></span>
                        <input type="password" class="fadeIn fourth" id="password" name="password" placeholder="Password" value="<?php echo $user->get_password() != "" ? $user->get_password() : '';?>">
                        <input type="submit" class="fadeIn fourth" value="Sign Up">
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>