<?php
    class User {
        public $username;
        public $phone;
        public $email;
        public $password;

        public function get_username()
        {
            return $this->username;
        }

        public function set_username($username)
        {
            $this->username = $username;
        }

        public function get_phone()
        {
            return $this->phone;
        }

        public function set_phone($phone)
        {
            $this->phone = $phone;
        }

        public function get_email()
        {
            return $this->email;
        }

        public function set_email($email)
        {
            $this->email = $email;
        }

        public function get_password()
        {
            return $this->password;
        }

        public function set_password($password)
        {
            $this->password = $password;
        }
    }
?> 