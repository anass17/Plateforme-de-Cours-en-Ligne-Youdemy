<?php

    class Enrollement {
        private int $user_id;
        private int $course_id;
        private string $enrollement_date;
        

        public function __construct(int $user_id = 0, int $course_id = 0, string $enrollement_date) {
            $this -> user_id = $user_id;
            $this -> course_id = $course_id;
            $this -> enrollement_date = $enrollement_date;
        }

        // ------------------------------------
        // Setters
        // ------------------------------------

        public function setUserId(int $tag_id) {
            $this -> user_id = $tag_id;
        }

        public function setCourseId(int $course_id) {
            $this -> course_id = $course_id;
        }

        // ------------------------------------
        // Getters
        // ------------------------------------

        public function getUserId() {
            return $this -> user_id;
        }

        public function getCourseId() {
            return $this -> course_id;
        }

        public function getEnrollementDate() {
            return $this -> enrollement_date;
        }

    }

?>