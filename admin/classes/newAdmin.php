<?php
require "../../setting.php";

$obj = new Database('admins');


// ==========================
// ADD & UPDATE ADMIN
// ==========================
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get Form Data
    $id               = isset($_POST['id']) ? trim($_POST['id']) : '';
    $name             = trim($_POST['full_name']);
    $username         = trim($_POST['username']);
    $email            = trim($_POST['email']);
    $role             = trim($_POST['role']);
    $status           = trim($_POST['status']);
    $password         = trim($_POST['password']);
    $confirmPassword  = trim($_POST['confirm_password']);

    // ==========================
    // VALIDATION
    // ==========================
    if (
        empty($name) ||
        empty($username) ||
        empty($email) ||
        empty($role) ||
        empty($status)
    ) {

        redirect('admin/admins/new.php', ["error" => "All fields are required"]);
    }

    // ==========================
    // ADD NEW ADMIN
    // ==========================
    if (empty($id)) {

        // Password Validation
        if (
            empty($password) ||
            empty($confirmPassword)
        ) {

            redirect('admin/admins/new.php', ["error" => "Password fields are required"]);
        }

        if ($password != $confirmPassword) {

            redirect('admin/admins/new.php', ["error" => "Password does not match"]);
        }

        // Check Username
        $checkUsername = $obj->where(
            ["username" => $username]
        );

        if (!empty($checkUsername)) {

            redirect('admin/admins/new.php', ["error" => "Username already exists"]);
        }

        // Check Email
        $checkEmail = $obj->where(["email" => $email]);

        if (!empty($checkEmail)) {

            redirect('admin/admins/new.php', ["error" => "Email already exists"]);
        }

        // Hash Password
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Insert Admin
        $insert = $obj->insert([

            'name'      => $name,
            'username'  => $username,
            'email'     => $email,
            'role'      => $role,
            'status'    => $status,
            'password'  => $hashedPassword

        ]);

        // Redirect
        if ($insert) {

            redirect('admin/admins/list.php', ["success" => "Admin added successfully"]);
        } else {

            redirect('admin/admins/new.php', ["error" => "Something went wrong"]);

        }
    }

    // ==========================
    // UPDATE ADMIN
    // ==========================
    else {

        // Check Username Exists
        $checkUsername = $obj->whereCustom(["username" => $username, "id" => $id], "username = :username AND id != :id");

        if (!empty($checkUsername)) {

            redirect('admin/admins/new.php', ["eid" => $id, "error" => "Username already exists"]);
        }

        // Check Email Exists
        $checkEmail = $obj->whereCustom(["email" => $email, "id" => $id], "email = :email AND id != :id");

        if (!empty($checkEmail)) {

            redirect('admin/admins/new.php', ["eid" => $id, "error" => "Email already exists"]);
        }

        // Update Data
        $updateData = [

            'name'      => $name,
            'username'  => $username,
            'email'     => $email,
            'role'      => $role,
            'status'    => $status

        ];

        // Update Password If Filled
        if (!empty($password)) {

            if ($password != $confirmPassword) {

                redirect('admin/admins/new.php', ["eid" => $id, "error" => "Password does not match"]);
            }

            $updateData['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        // Update Query
        $update = $obj->update(
            $updateData,
            ["id" => $id]
        );

        // Redirect
        if ($update) {

            redirect('admin/admins/list.php', ["success" => "Admin updated successfully"]);
        } else {

            redirect('admin/admins/new.php', ["eid" => $id, "error" => "Something went wrong"]);
        }
    }
}
