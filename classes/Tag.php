<?php

    class Tag {
        private int $tag_id;
        private string $tag_name;
        private array $errors = [];
        

        public function __construct(int $tag_id = 0, string $tag_name = '') {
            $this -> tag_id = $tag_id;
            $this -> tag_name = $tag_name;
        }

        // ------------------------------------
        // Setters
        // ------------------------------------

        public function setTagName(string $name) {
            $this -> tag_name = $name;
        }

        // ------------------------------------
        // Getters
        // ------------------------------------

        public function getTagId() {
            return $this -> tag_id;
        }

        public function getTagName() {
            return $this -> tag_name;
        }

        // ------------------------------------
        // Methods
        // ------------------------------------

        public function createTag() : bool {

            $db = Database::getInstance();
            
            !Security::validateName($this -> tag_name) ? ($this -> errors[] = "Tag Name is too short") : '';

            if (!empty($this -> errors)) {
                return false;
            }

            // Insert New Tag

            $columns = [
                'tag_name'
            ];

            $parameters = [
                $this -> tag_name
            ];

            $insert_id = $db -> insert('tags', $columns, $parameters);

            if (!$insert_id) {
                array_push($this -> errors, "Could not process your request");
                return false;
            }

            $this -> tag_id = $insert_id;

            return true;
        }

        public function updateTag() : bool {

            $db = Database::getInstance();
            
            !Security::validateName($this -> tag_name) ? ($this -> errors[] = "Tag Name is too short") : '';

            if (!empty($this -> errors)) {
                return false;
            }

            // Update Tag

            $columns = [
                'tag_name'
            ];

            $parameters = [
                $this -> tag_name,
                $this -> tag_id
            ];

            if (!$db -> update('tags', $columns, 'tag_id = ?', $parameters)) {
                $this -> errors[] = "Could not process your request";
                return false;
            }

            return true;
        }

        public function deleteTag() : bool {

            $db = Database::getInstance();

            // Delete Tag

            $parameters = [
                $this -> tag_id
            ];

            if (!$db -> delete('tags', 'tag_id = ?', $parameters)) {
                $this -> errors[] = "Could not process your request";
                return false;
            }

            return true;
        }

        public function loadTag(int $id) {
            $db = Database::getInstance();
        
            $result = $db -> select('SELECT * FROM tags WHERE tag_id = ?', [$id]);
        
            if (!$result) {
                $this -> errors[] = "This tag does not exist";
                return false;
            }
            
            $this -> tag_id = $result["tag_id"];
            $this -> tag_name = $result["tag_name"];
        
            return true;
        }

        // ------------------------------------
        // Static Methods
        // ------------------------------------

        public static function getAllTags() {
            $db = Database::getInstance();

            $tags_list = $db -> selectAll("SELECT * FROM tags ORDER BY tag_id ASC");

            $tags = [];

            foreach($tags_list as $tag) {
                $instance = new Tag($tag['tag_id'], $tag['tag_name']);
                $tags[] = $instance;
            }

            return $tags;
        }
    }

?>