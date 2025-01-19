<?php

    session_start();

    require '../classes/Database.php';
    require '../classes/Security.php';
    require '../classes/User.php';
    require '../classes/Admin.php';
    require '../classes/Category.php';

    // header('Content-Type: application/json');

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

        // Create category

        case 'POST':
            
            $categories_list = isset($data -> categories) ? $data -> categories : '';

            $successful_inserts = 0;

            foreach(json_decode($categories_list) as $cat) {
                $category = new Category(0, ucfirst($cat -> value));
                if ($category -> createCategory()) {
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
                    'message' => "$successful_inserts categories were successfully added"
                ]);
                exit;
            }

            break;
        
        // Update category

        case 'PUT':

            $cat_id = isset($data -> catId) ? $data -> catId : '';
            $cat_name = isset($data -> catName) ? $data -> catName : '';
            $cat_name = ucfirst($cat_name);
    
            $category = new Category((int) $cat_id, $cat_name);
            
            if (!$category -> updateCategory()) {
                echo json_encode([
                    'status' => false,
                    'message' => "Could not update this category"
                ]);
            } else {
                echo json_encode([
                    'status' => true,
                    'result' => $cat_name,
                    'message' => "Successfully Updated to $cat_name"
                ]);
            }

            break;

        // Delete category

        case 'DELETE':

            $cat_id = isset($data -> catId) ? $data -> catId : '';
            $cat_name = isset($data -> catName) ? $data -> catName : '';

            $category = new Category((int) $cat_id);

            if (!$category -> deleteCategory()) {
                echo json_encode([
                    'status' => false,
                    'message' => "Could not delete this category"
                ]);
            } else {
                echo json_encode([
                    'status' => true,
                    'message' => "$cat_name was successfully deleted"
                ]);
            }

            break;
        
        default:
            echo json_encode([
                'status' => false,
                'message' => 'Invalid Request!'
            ]);
    }
    