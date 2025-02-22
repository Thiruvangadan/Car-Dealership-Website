<?php
    session_start();
    $passerror='';
    $emailerror='';
    $email='';
    $Phoneerror='';
    $emailexist='';
    $passworderror='';
    $PhoneNumber = '';
    include "Connect.php";
?>

<?php
if(isset($_POST["submit"]))
{
    $email=$_POST["contact"];
    $password=$_POST["password"];

    $sql = "SELECT * FROM user WHERE Email='$email'";
    $result = mysqli_query($conn,$sql);
    $user = mysqli_fetch_array($result,MYSQLI_ASSOC);

    $sqll = "SELECT * FROM user WHERE PhoneNumber='$email'";
    $resultt = mysqli_query($conn,$sqll);
    $userr = mysqli_fetch_array($resultt,MYSQLI_ASSOC);
    if ($user) 
    {
        if(password_verify($password,$user["Password"]))
        {
            $_SESSION['user']=$user['Name'];
            header("Location:Home-Page/loader.php");
            die();
        }
        else{
            $passerror="Invalid Password!!!";
        }
    }
    if($userr)
    {
        $emailerror = "";
        if(password_verify($password,$userr["Password"]))
        {
            $_SESSION['user']=$userr['Name'];
            header("Location:Home-Page/loader.php");
            die();
        }
        else{
            $passerror="Invalid Password!!!";
        }
    }
    if(!($user || $userr))
    {
        $emailerror = "Email Or Phone Number Does Not Exist";
    }
}
?>

<?php
   if(isset($_POST["register"]))
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $PhoneNumber=$_POST["phone"];
        $password = $_POST["password"];
        $passwordRepeat = $_POST["password-repeat"];
        $tot=0;
        $passwordHash = password_hash($password,PASSWORD_DEFAULT);
        
        $sql = "SELECT * FROM user WHERE Email='$email'";
        $result = mysqli_query($conn,$sql);
        $count = mysqli_num_rows($result);

        $sql = "SELECT * FROM user WHERE PhoneNumber='$PhoneNumber'";
        $resultt = mysqli_query($conn,$sql);
        $countt = mysqli_num_rows($resultt); 
        if($count >0)
        {
            $tot=$tot+1;
            $emailexist="Email Already Exists!!!!";
        }
        if($countt >0)
        {
            $Phoneerror="Phone Number Already Exists!!!";
            $tot=$tot+1;
        }
        if($password!==$passwordRepeat)
        {
            $passworderror="Password Does Not Match!!!";
            $tot=$tot+1;
        }
        if($tot>0){}
        else
        {
            $sql = "INSERT INTO user (Name, Email, PhoneNumber ,Password) VALUES (? , ? , ? , ?)";
            $stmt = mysqli_stmt_init($conn);
            $prepare = mysqli_stmt_prepare($stmt,$sql);
            echo $prepare;
            if($prepare)
            {
                mysqli_stmt_bind_param($stmt,"ssis", $name, $email, $PhoneNumber, $passwordHash);
                mysqli_stmt_execute($stmt);
                header("Location:success.html");
            }
            else{
                die("Something Went Wrong");
            }
        }
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Car Dealership Project</title>
    <link rel="stylesheet" href="Register-login.css">
    <link rel="website icon" type="png" href="logo3.png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <section>
        <div class="container">
            <div class="flip">
                <div class="user signinbx">
                    <div class="login-box">
                        <form action="index.php" method="POST" >
                            <h2>Login</h2>
                            <div class="input-box">
                                <input type="text" id="contact" name="contact" value="<?php if($emailerror=='')
                                    {echo $email;}?>" placeholder="Email Or Phone Number" required>
                                <i class='bx bxs-user'></i>
                                <p class="blinking-text" style="color:red ; visibility:visible"><?php echo $emailerror ?></p>
                            </div>
                            <div class="input-box">
                                <input type="password" name="password" placeholder="Password" required>
                                <i class='bx bxs-lock-alt'></i>
                                <p class="blinking-text" style="color:red ; visibility:visible"><?php echo $passerror ?></p>
                            </div>

                            <div class="remember-me">
                                <label><input type="checkbox">Remember me</label>
                                <a href="#">Forgot Password?</a>
                            </div>

                            <button type="submit" id="submit" class="btn btn1" name="submit">Login</button>

                            <div class="signup">
                                <p>Don't have an account?
                                    <a href="#" onclick="toggleform();">Register</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="user signupbx">
                    <div class="login-box">
                        <form action="index.php" method="post" id="myform">
                            <h2>Register</h2>                            
                            <div class="input-box">
                                <input type="text" name="name" placeholder="Name" required>
                                <i class='bx bxs-user'></i>
                            </div>
                           
                            <div class="input-box">
                                <input type="email" name="email" placeholder="Email" value="<?php if($emailexist=='')
                                    {echo $email;}?>" required>
                                <i class='bx bxs-user'></i>
                                <p class="blinking-text" style="color:red ; visibility:visible"><?php echo $emailexist ?></p>
                            </div>

                            <div class="input-box">
                                <input type="tel" pattern="[0-9]{10}" name="phone" value="<?php if($Phoneerror=='')
                                     {echo $PhoneNumber;}?>" placeholder="10 Digit Phone Number" required>
                                <i class='bx bxs-user'></i>
                                <p class="blinking-text" style="color:red ; visibility:visible"><?php echo $Phoneerror ?></p>
                            </div>

                            <div class="input-box">
                                <input type="password" name="password" placeholder="Password" required>
                                <i class='bx bxs-lock-alt'></i>
                            </div>

                            <div class="input-box">
                                <input type="password" name="password-repeat" placeholder="Confirm Password" required>
                                <i class='bx bxs-lock-alt'></i>
                                <p class="blinking-text" style="color:red ; visibility:visible"><?php echo $passworderror ?></p>
                            </div>

                            <div class="terms">
                                <input type="checkbox" id="check" onclick="checke()"><a href="Terms&Conditions.html" target="_blank">Accept Terms & Conditions</a>
                            </div>

                            <button type="submit"  id="btnactive" class ="btn" name="register" style="opacity: 0.5;cursor:not-allowed;">Create Account</button>
                            <div class="signup">
                                <p>
                                    Already have an account?
                                    <a onclick="toggleform();">Sign In</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="Register-login.js"></script>
</body>
</html>

