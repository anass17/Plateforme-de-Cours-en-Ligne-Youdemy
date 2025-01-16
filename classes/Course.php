<?php

    abstract class Course {
        protected int $course_id;
        protected string $title;
        protected string $description;
        protected string $image_path;
        protected string $publish_date;
        protected string $type;
        protected string $file_path;

        public function __construct(int $course_id = 0, string $course_title = '', string $description = '', string $image_path = '', string $publish_date = '', string $type = '', string $file_path = '') {
            $this -> course_id = $course_id;
            $this -> title = $course_title;
            $this -> description = $description;
            $this -> image_path = $image_path;
            $this -> publish_date = $publish_date;
            $this -> type = $type;
            $this -> file_path = $file_path;
        }


    }

?>