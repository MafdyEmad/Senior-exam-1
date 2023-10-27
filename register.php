<?php 

session_start();
$all_errors=[
    'username_errors '=>[],
    'email_errors '=>[],
    'password_errors '=>[],
    'image_errors '=>[],
  ];



if(isset($_POST['username'])) {
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];
$co_password = $_POST["co-password"];
$type = $_POST["type"];
$targetPath="";




    if(empty($username)){
        $all_errors['username_errors'][]="Username cannot be empty.";
    } 
    else if(strlen($username) <5 ||strlen($username)>20){  
     $all_errors["username_errors"][]="Username must be between 5 and 20 characters long.";
    }
    else if(!preg_match('/^[A-Za-z0-9_]+$/', $username)){
        $all_errors["username_errors"][]="Username can only contain letters, numbers, and underscores.";
    }


    
    if(empty($email)){
        $all_errors['email_errors'][]="Email cannot be empty.";
        
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){  
     $all_errors["email_errors"][]="Invalid email format.";

    }


    if(empty($password)){
        $all_errors['password_errors'][]="Password cannot be empty.";
        
    }
    else if (preg_match('/^[a-zA-Z0-9_]{8,}$/', $password)) {
        $all_errors['password_errors'][]="only contains alphanumeric characters and underscores & min:8";
    } }




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $error = 0;
    $uploadDirectory = 'uploads/profile/';
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
    $maxFileSize = 1.5 * 1024 * 1024; // 1.5 MB in bytes

    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $file = $_FILES['image'];

     
        if (!in_array($file['type'], $allowedTypes)) {
            $error = 1;
            $all_errors['image_errors'][]="Invalid image type. Only JPEG, PNG, and JPG are allowed.";
 
        }

        if ($file['size'] > $maxFileSize) {
            $error = 1;
            $all_errors['image_errors'][]="Image is too large. Maximum size is 1.5 megabytes.";
        }

        if ($error == 0) {
            $fileName = basename($file['name']);
            $targetPath = $uploadDirectory . $fileName;

            move_uploaded_file($file['tmp_name'], $targetPath);
        }
    } else {
        $error = 1;
        $all_errors['image_errors'][]="No file uploaded or an error occurred during upload.";

    }
    if(empty($all_errors["username_errors"])&& empty($all_errors["password_errors"]) && empty($all_errors["email_errors"])&& empty($all_errors["image_errors"])){
        
     $_SESSION=[
        "username" => $username,
        "email" => $email,
        "password" => $password,
        "type" => $type,
        "image" => $targetPath,
      ];
      var_dump($_SESSION);
        header("location: login.php");
    }
    

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Design by foolishdeveloper.com -->
    <title>Glassmorphism login Form Tutorial in html css</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <!--Stylesheet-->

    <style media="screen">
        *,
        *:before,
        *:after {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #080710;
        }

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#1845ad,
                    #23a2f6);
            left: -80px;
            top: 40%;
        }

        .shape:last-child {
            background: linear-gradient(to right,
                    #ff512f,
                    #f09819);
            right: -30px;
            bottom: -65%;
        }

        form {
            margin-top: 300px;
            margin-bottom: 300px;
            height: fit-content;
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 50px 35px;
        }

        form * {
            font-family: 'Poppins', sans-serif;
            color: #ffffff;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        form h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
        }

        ::placeholder {
            color: #e5e5e5;
        }

        button {
            margin-top: 50px;
            width: 100%;
            background-color: #ffffff;
            color: #080710;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .social {
            margin-top: 30px;
            display: flex;
        }

        .social div {
            background: red;
            width: 150px;
            border-radius: 3px;
            padding: 5px 10px 10px 5px;
            background-color: rgba(255, 255, 255, 0.27);
            color: #eaf0fb;
            text-align: center;
        }

        .social div:hover {
            background-color: rgba(255, 255, 255, 0.47);
        }

        .social .fb {
            margin-left: 25px;
        }

        .social i {
            margin-right: 4px;
        }

        input[type=radio] {
            height: 25px;
            width: 25px;
            display: inline-block;
        }

        .spn-radio {
            padding: 5px;
            font-size: 20px;
            color: #EB901A;
        }
    </style>

</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method='post' enctype="multipart/form-data">
        <h3>Register Here</h3>

        <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
            <symbol id="check-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </symbol>
            <symbol id="info-fill" viewBox="0 0 16 16">
                <path
                    d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
            </symbol>
            <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
                <path
                    d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
            </symbol>
        </svg>

        <label for="username">Username</label>
        <input type="text" placeholder="username" id="username" name ="username">
        <?php 
      
      if (!empty($all_errors['username_errors'])) {

        $usernameErrors = $all_errors['username_errors'];
    
        foreach ($usernameErrors as $error) {
            echo $error ;
        }
    }

     
  ?>


        <label for="email">Email</label>
        <input type="text" placeholder="email" id="email" name ="email">

        <?php 
      
      if (!empty($all_errors['email_errors'])) {

        $emailErrors = $all_errors['email_errors'];
    
        foreach ($emailErrors as $error) {
            echo $error ;
        }
    }

     
  ?>


        <label for="img">Profile Image</label>
        <input type="file" id="img" name='image'>

        <?php 
      
      if (!empty($all_errors['image_errors'])) {

        $image_errors = $all_errors['image_errors'];
    
        foreach ($image_errors as $error) {
            echo $error ;
        }
    }

     
  ?>


        <label for="username">User Type</label>
        <input type="radio" name='type' value="admin"><span class="spn-radio">Admin</span>
        <input type="radio" name='type' value="user" checked><span class="spn-radio">User</span>


        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password">

        <?php 
      
      if (!empty($all_errors['password_errors'])) {

        $password_errors = $all_errors['password_errors'];
    
        foreach ($password_errors as $error) {
            echo $error ;
        }
    }

     
  ?>


        <label for="co-password">confirm Password</label>
        <input type="password" placeholder="Confirm Password" id="co-password" name='co-password'>
        <?php 
        
        if(!empty($password)&& $password != $co_password){
            echo 'password does not match';
        }
        ?>


        <button>Log In</button>
        <div class="social">
            <div class="go"><i class="fab fa-google"></i> login </div>
        </div>
    </form>
</body>

</html>