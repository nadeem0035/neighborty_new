<?php
require ('xcrud/xcrud.php');


if (isset($_POST['submit']) && $_POST['submit'] == "Login") {

    $email = trim($_POST['email']);
    $pswd = md5(trim($_POST['pswd']));

    $db = Xcrud_db::get_instance();
    $sql_re = $db->query("SELECT email,password FROM admin WHERE email ='" . $email . "' AND password = '" . $pswd . "' and active=1"); // executes query, returns count of affected rows
    if ($db->row() > 0) {
        $_SESSION['adminName'] = "admin";
        echo '<script>window.location = "index.php";</script>';
    } else {
       
        $msg = "Please enter a valid email and password!";
    }
}
?>
<!DOCTYPE HTML>
<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />  
    <link href="assets/login.css" rel="stylesheet" type="text/css" />



</head>

<body>
    <form action="" method="post" enctype="multipart/form-data" name="frmupdate" id="login">
        <h1>Admin Log In</h1>
        <?php if (isset($msg)) { ?>
            <fieldset class="form-group" id="msg_box">
                <div class="alert alert-error" style="color:#B94A48; background:#F2DEDE;">
                    <strong>Error!</strong> <?= $msg; ?> 
                </div>
            </fieldset>

        <?php } ?>
        <fieldset id="inputs">
            <input id="username" type="text" name="email" placeholder="Email address" autofocus="" required="required">   
            <input id="password" type="password" name="pswd" placeholder="Password" required="required">
        </fieldset>
        <fieldset id="actions">
            <input type="submit" name="submit"  id="submit" value="Login">
            <!--        <a href="">Forgot your password?</a><a href="">Register</a>-->
        </fieldset>

    </form>

</body>
</html>