<?php

    class Category {
        private int $cat_id;
        private string $cat_name;
        private array $errors = [];
        

        public function __construct(int $category_id = 0, string $name = '') {
            $this -> cat_id = $category_id;
            $this -> cat_name = $name;
        }

        // ------------------------------------
        // Setters
        // ------------------------------------

        public function setCategoryName(string $name) {
            $this -> cat_name = $name;
        }

        // ------------------------------------
        // Getters
        // ------------------------------------

        public function getCategoryId() {
            return $this -> cat_id;
        }

        public function getCategoryName() {
            return $this -> cat_name;
        }

        // ------------------------------------
        // Methods
        // ------------------------------------

        public function createCategory() {

            $db = Database::getInstance();
            
            !Security::validateName($this -> cat_name) ? ($this -> errors[] = "Category Name is too short") : '';

            if (!empty($this -> errors)) {
                return false;
            }

            // Insert New Category

            $columns = [
                'cat_name'
            ];

            $parameters = [
                $this -> cat_name
            ];

            $insert_id = $db -> insert('categories', $columns, $parameters);

            if (!$insert_id) {
                array_push($this -> errors, "Could not process your request");
                return false;
            }

            $this -> cat_id = $insert_id;
        }

        public function updateCategory() {

            $db = Database::getInstance();
            
            !Security::validateName($this -> cat_name) ? ($this -> errors[] = "Category Name is too short") : '';

            if (!empty($this -> errors)) {
                return false;
            }

            // Update Category

            $columns = [
                'cat_name'
            ];

            $parameters = [
                $this -> cat_name,
                $this -> cat_id
            ];

            if (!$db -> update('categories', $columns, 'cat_id = ?', $parameters)) {
                $this -> errors[] = "Could not process your request";
                return false;
            }
        }

        public function deleteCategory() {

            $db = Database::getInstance();

            // Delete Category

            $parameters = [
                $this -> cat_id
            ];

            if (!$db -> delete('categories', 'cat_id = ?', $parameters)) {
                $this -> errors[] = "Could not process your request";
                return false;
            }
        }

        public function loadCategory(int $id) {
            $db = Database::getInstance();
        
            $result = $db -> select('SELECT * FROM categories WHERE cat_id = ?', [$id]);
        
            if (!$result) {
                $this -> errors[] = "This category does not exist";
                return false;
            }
            
            $this -> cat_id = $result["cat_id"];
            $this -> cat_name = $result["cat_name"];
        
            return true;
        }
    }

?>