<?php
    class UserController{
        public function __construct(){
            if(isset($_POST["action"]) && $_POST["action"] != ""){
                switch($_POST["action"]){
                    case "create_account":
        
                    break;
                    case "login":
                        
                    break;
                }
            }
        }

        public function create_account($user){
            $data_file =  file_get_contents('../data/data.json');
            $json_file = json_decode($data_file, true);
            $json_file[time()] = [
                "user" => (array) $user,
                "posts" => []
            ];

            $json_file = json_encode($json_file, JSON_PRETTY_PRINT);
            $saved = file_put_contents('../data/data.json', $json_file);
            if($saved)
                var_export($saved);
            exit();
        }

        public function login($user){
            $data_file = file_get_contents('../data/data.json');
            $json_file = json_decode($data_file, true);
            $user_match = array_filter($json_file, function($data_user) use($user){
                return $data_user["user"]["username"] == $user->username && $data_user["user"]["password"] == $user->password;
            });
            if(!$user_match){
                //Message
            }else{
                session_destroy();
                session_start();
                $user_id = array_keys($user_match)[0];
                $user_match = ($user_match[$user_id]);
                $_SESSION["user"] = $user_id;
                $_SESSION["username"] = $user_match["user"]["username"];
                $redirect_url = "http://".gethostname().":".$_SERVER['SERVER_PORT']."/twitthor/views/posts.php";
                header("Location: $redirect_url");
                exit();
            }
            
        }
    }
?>