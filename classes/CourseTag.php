<?php

    class CourseTag {
        private int $tag_id;
        private string $course_id;
        

        public function __construct(int $tag_id = 0, int $course_id = 0) {
            $this -> tag_id = $tag_id;
            $this -> course_id = $course_id;
        }

        // ------------------------------------
        // Setters
        // ------------------------------------

        public function setTagId(int $tag_id) {
            $this -> tag_id = $tag_id;
        }

        public function setCourseId(int $course_id) {
            $this -> course_id = $course_id;
        }

        // ------------------------------------
        // Getters
        // ------------------------------------

        public function getTagId() {
            return $this -> tag_id;
        }

        public function getCourseId() {
            return $this -> course_id;
        }

    }

?>