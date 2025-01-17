<?php
    class VideoCourse extends Course {

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
                'video',
                $this -> file_path
            ];

            $inserted_id = $db -> insert('courses', $columns, $data);

            if (!$inserted_id) {
                array_push($this -> errors, "Could not save your changes -> " . $db -> getError() );
                return false;
            }

            $this -> course_id = $inserted_id;

            return true;
        }

        public function uploadVideo(array $file) : bool {

            $allowed_types = ["video/mp4"];

            if ($file['error'] != 0) {      // File not uploaded
                return false;
            }

            if (!in_array($file["type"], $allowed_types)) {
                array_push($this -> errors, "The type of the video is not allowed");
                return false;
            }

            $file_path = "";

            if (!empty($file)) {
                $image_name = uniqid() . $file["name"];
                $new_path = "../uploads/files/videos/" . $image_name;
                $file_path = "/uploads/files/videos/" . $image_name;
                
                if (!move_uploaded_file($file['tmp_name'], $new_path)) {
                    array_push($this -> errors, "Could not upload the video.");
                    return false;
                }
            }

            $this -> file_path = $file_path;

            return true;
        }
    }
?>