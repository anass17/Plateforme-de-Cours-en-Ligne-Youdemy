<?php

    class Review {
        private int $review_id;
        private string $review_content;
        private int $review_rating;
        private string $review_date;
        private int $review_author;
        private array $errors = [];

        public function __construct(int $review_id = 0, string $review_content = '', int $review_rating = 0, string $review_date = '', int $review_author = 0) {
            $this -> review_id = $review_id;
            $this -> review_content = $review_content;
            $this -> review_rating = $review_rating;
            $this -> review_date = $review_date;
            $this -> review_author = $review_author;
        }

        // ------------------------------------
        // Setters
        // ------------------------------------

        public function setReviewContent(string $content) {
            $this -> review_content = $content;
        }

        public function setReviewRating(int $rating) {
            $this -> review_rating = $rating;
        }

        // ------------------------------------
        // Getters
        // ------------------------------------

        public function getReviewId() {
            return $this -> review_id;
        }
        
        public function getReviewAuthorId() {
            return $this -> review_author;
        }

        public function getReviewContent() {
            return htmlspecialchars($this -> review_content);
        }

        public function getReviewRating() {
            return $this -> review_rating;
        }

        public function getReviewDate() {
            return $this -> review_date;
        }

        public function getErrors() {
            return $this -> errors;
        }

        // ------------------------------------
        // Methods
        // ------------------------------------

        public function addReview(int $user_id, int $course_id) : bool {

            $db = Database::getInstance();
            
            !Security::validateName($this -> review_content) ? ($this -> errors[] = "Review content is too short") : '';

            if (!empty($this -> errors)) {
                return false;
            }

            if ($user_id == 0 || $course_id == 0 || $this -> review_rating < 1 || $this -> review_rating > 5) {
                $this -> errors[] = "Could not process your request";
                return false;
            }

            // Insert New Review

            $columns = [
                'content',
                'rating',
                'review_course',
                'review_author'
            ];

            $parameters = [
                $this -> review_content,
                $this -> review_rating,
                $course_id,
                $user_id
            ];

            $insert_id = $db -> insert('reviews', $columns, $parameters);

            if (!$insert_id) {
                array_push($this -> errors, "Could not process your request");
                return false;
            }

            $this -> review_id = $insert_id;

            return true;
        }

        public function updateReview() {
            
        }
        public function deleteReview() {

        }

        // ------------------------------------
        // Static Methods
        // ------------------------------------

        

    }

?>