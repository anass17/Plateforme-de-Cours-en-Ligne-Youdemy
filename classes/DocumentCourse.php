<?php

    // ------------------------------------
    // Methods
    // ------------------------------------

    class DocumentCourse extends Course {

        // ------------------------------------
        // Methods
        // ------------------------------------

        public function createCourse() {

            $db = Database::getInstance();

            if (
                empty($this -> title) ||
                empty($this -> description) ||
                empty($this -> category) ||
                empty($this -> file_path)
            ) {
                $this -> errors[] = "Please fill In the form";
                return false;
            }

            $columns = [
                'title',
                'description',
                'course_category',
                'image_path',
                'course_owner',
                'type',
                'file_path'
            ];

            $data = [
                $this -> title,
                $this -> description,
                $this -> category -> getCategoryId(),
                $this -> image_path,
                $this -> teacher -> getUserId(),
                'document',
                $this -> file_path
            ];

            $inserted_id = $db -> insert('courses', $columns, $data);

            if (!$inserted_id) {
                array_push($this -> errors, "Could not save your changes");
                return false;
            }

            $this -> course_id = $inserted_id;

            return true;
        }
        
        public function uploadDocument(array $file) {

            $allowed_types = ["application/pdf"];

            if ($file['error'] != 0) {      // File not uploaded
                return false;
            }

            if (!in_array($file["type"], $allowed_types)) {
                array_push($this -> errors, "The type of the document is not allowed");
                return false;
            }

            $file_path = "";

            if (!empty($file)) {
                $image_name = uniqid() . $file["name"];
                $new_path = "../uploads/files/documents/" . $image_name;
                $file_path = "/uploads/files/documents/" . $image_name;
                
                if (!move_uploaded_file($file['tmp_name'], $new_path)) {
                    array_push($this -> errors, "Could not upload the document.");
                    return false;
                }
            }

            $this -> file_path = $file_path;

            return true;

        }

    }