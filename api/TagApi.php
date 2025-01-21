<?php

    session_start();

    require '../classes/Database.php';
    require '../classes/Security.php';
    require '../classes/User.php';
    require '../classes/Admin.php';
    require '../classes/Tag.php';

    header('Content-Type: application/json');

    $authorized_roles = ['admin'];
    
    // Check if access token does not exist

    $user_row = Security::isAccessTokenValid();

    // if (!$user_row || !Security::isAuthorized($user_row['role'], $authorized_roles)) {
    //     echo json_encode([
    //         'result' => false,
    //         'error' => 'Unauthorized'
    //     ]);
    //     exit;
    // }

    // $user = new Admin($user_row["user_id"], $user_row['first_name'], $user_row['last_name'], $user_row['email']);

    $get_payload_date = file_get_contents('php://input');
    $data = json_decode($get_payload_date);

    switch ($_SERVER["REQUEST_METHOD"]) {

        // Create tag

        case 'POST':
            
            $tags_list = isset($data -> tags) ? $data -> tags : '';

            $successful_inserts = 0;

            foreach(json_decode($tags_list) as $tag) {
                $tag = new Tag(0, ucfirst($tag -> value));
                if ($tag -> createTag()) {
                    $successful_inserts++;
                }
            }

            if ($successful_inserts == 0) {
                echo json_encode([
                    'status' => false,
                    'message' => "Error! Something Went Wrong"
                ]);
                exit;
            } else {
                echo json_encode([
                    'status' => true,
                    'message' => "$successful_inserts tags were successfully added"
                ]);
                exit;
            }

            break;
        
        // Update tag

        case 'PUT':

            $tag_id = isset($data -> tagId) ? $data -> tagId : '';
            $tag_name = isset($data -> tagName) ? $data -> tagName : '';
            $tag_name = ucfirst($tag_name);
    
            $tag = new Tag((int) $tag_id, $tag_name);
            
            if (!$tag -> updateTag()) {
                echo json_encode([
                    'status' => false,
                    'message' => "Could not update this tag"
                ]);
            } else {
                echo json_encode([
                    'status' => true,
                    'result' => $tag_name,
                    'message' => "Successfully Updated to $tag_name"
                ]);
            }

            break;

        // Delete tag

        case 'DELETE':

            $tag_id = isset($data -> tagId) ? $data -> tagId : '';
            $tag_name = isset($data -> tagName) ? $data -> tagName : '';

            $tag = new Tag((int) $tag_id);

            if (!$tag -> deleteTag()) {
                echo json_encode([
                    'status' => false,
                    'message' => "Could not delete this tag"
                ]);
            } else {
                echo json_encode([
                    'status' => true,
                    'message' => "$tag_name was successfully deleted"
                ]);
            }

            break;
        
        default:
            echo json_encode([
                'status' => false,
                'message' => 'Invalid Request!'
            ]);
    }
    