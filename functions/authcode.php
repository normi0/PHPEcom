<?php

session_start();
include('../config/dbcon.php');
include('Myfunctions.php');
if (isset($_POST['register_btn'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    //check email if is already registered 
    $check_email_query = "SELECT email FROM users WHERE email='$email'";
    $check_email_query_run = mysqli_query($con, $check_email_query);
    if (mysqli_num_rows($check_email_query_run) > 0) {
        $_SESSION['message'] = "email already registred";
        header('Location: ../register.php');
    } else {
        if ($password == $cpassword) {
            //insert user data
            $insert_query = "INSERT INTO users (name,email,phone,password) VALUES ('$name','$email','$phone','$password')";
            $insert_query_run = mysqli_query($con, $insert_query);

            if ($insert_query_run) {
                $_SESSION['message'] = "registered Successfully";
                header('Location: ../login.php');
            } else {
                $_SESSION['message'] = "Somthing went wrong";
                header('Location: ../register.php');
            }
        } else {
            $_SESSION['message'] = "password not match";
            header('Location: ../register.php');
        }
    }


} else if (isset($_POST['login_btn'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $login_querry = "SELECT * FROM users WHERE email = '$email' AND password ='$password' ";
    $login_querry_run = mysqli_query($con, $login_querry);
    if (mysqli_num_rows($login_querry_run) > 0) {
        $_SESSION['auth'] = true;
        $userdata = mysqli_fetch_array($login_querry_run);
        $username = $userdata['name'];
        $useremail = $userdata['email'];
        $role_as = $userdata['role_as'];
        $_SESSION['auth_user'] = [
            'name' => $username,
            'email' => $useremail
        ];
        $_SESSION['role_as'] = $role_as;

        if ($role_as == 1) {
            redirect("../admin/index.php", "Welcome to Dashbord");
        } else {
            redirect("../index.php", "Logged in seccessfully");
        }
    } else {
        redirect("../login.php", "invalid Credentials");
    }
}
?>