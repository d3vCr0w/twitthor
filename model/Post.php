<?php
    class Post {
        public $date;
        public $content;

        public function get_date()
        {
            return $this->date;
        }

        public function set_date($date)
        {
            $this->date = $date;
        }

        public function get_content()
        {
            return $this->content;
        }

        public function set_content($content)
        {
            $this->content = $content;
        }
    }
?> 