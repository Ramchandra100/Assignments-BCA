<?php 
include('header.php');
if(isset($_POST['signup'])){
    $name=getSafeValue($_POST['name']);
    $email=getSafeValue($_POST['email']);
    $pass=getSafeValue($_POST['pass']);
    $checkpass=getSafeValue($_POST['checkpass']);
    if($pass == $checkpass){
        $pass=password_hash($pass,PASSWORD_DEFAULT);
    $res=pg_query($con,"INSERT INTO users (userName, email, pass, role, principleAmount, leftAmount) VALUES ('$name','$email','$pass','User',0,0)");
    $res=pg_query($con,"SELECT * FROM users WHERE email ='$email'");
    $row=pg_fetch_assoc($res);
        $_SESSION['id']=$row['id'];
        $_SESSION['name']=$_POST['name'];
        $_SESSION['role']='User';
        $_SESSION['principleAmount']=$row['principleAmount'];
        $_SESSION['leftAmount']=$row['leftAmount'];
        redirect('dashboard.php');
    }
 else{
    echo"Password doesn't match please check !";
}
}

if(isset($_POST['login'])){
    $email=getSafeValue($_POST['email']);
    $pass=getSafeValue($_POST['pass']);
    
    $res=pg_query($con,"SELECT * FROM users WHERE email='$email'");
    if(pg_num_rows($res)>0){
        $row=pg_fetch_assoc($res);
        $check=password_verify($pass,$row['pass']);
        if($check==1){
        $_SESSION['id']=$row['id'];
        $_SESSION['name']=$row['userName'];
        $_SESSION['role']=$row['role'];
        $_SESSION['principleAmount']=$row['principleAmount'];
        $_SESSION['leftAmount']=$row['leftAmount'];
        if($_SESSION['role']=='Admin'){
            redirect('category.php');
        }else{
        redirect('dashboard.php');
        }
    }
    else{
        echo "Please enter correct password";
        
    }
}
    else{
        echo "Please enter valid username";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>LoginSignup</title>
    </head>
    <style>
        *{
            margin: 0%;
            padding: 0%;
            box-sizing: border-box;
        }
        html{
            font-size: 62.5%;
        }
        body{
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: url(images/b1.jpg);
            background-size: cover;
        }
        
        .wrapper{
            position: relative;
            max-width: 50rem;
            background-color: aqua;
            width: 100%;
            padding: 1rem 3rem 10.2rem;
            border-radius: 1rem;
            box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
            overflow: hidden;

        }

        .formSignup header,.formLogin header{
            font-size: 3rem;
            color: #fff;
            font-weight: 600;
            text-align: center;
            margin-bottom: 4rem;
            cursor: pointer;
        }

        .wrapper form{
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        form input{
            height: 6rem;
            border: none;
            outline: none;
            font-size: 1.6rem;
            padding: 0rem 1.5rem;
            color: #333;
            background-color: #ffffffec;
            font-weight: 400;
            border-radius: 1rem;
        }

        form input[type="submit"]{
            padding: 0rem;
            margin-top: 4rem;
            margin-bottom: 4rem;
            font-size: 1.8rem;
            font-weight: 600;
            cursor: pointer;
            background-color: #fff;

        }

        .formLogin{
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% + 20.4rem);
            padding: 2rem 13.4rem;
            border-radius: 25rem;
            height:  calc(100% + 4rem);;
            bottom: -90%;
            background-color: #fff;
            transition: all 0.6s ease;
        }

        .wrapper.active .formLogin {
            bottom: -15%;
        }

        .formLogin input{
            border: 0.1rem solid #333;
        }

        .formLogin input:focus{
            box-shadow: 0.8rem 0.8rem 0.8rem #ddd;
        }

        .formLogin input[type="submit"]{
            background-color: #4070f4;
            color: #fff;
            border: none;
        }

        .formLogin header{
            color: #333;
            opacity: 0.6;
            margin-bottom: 5rem;
        }

        @media screen and (max-width:450px) {
            html{
                font-size: 25%;
            }
            body{
            background-image: url(images/b2.jpg);
            }
            
            
        }

    </style>
    <body>
        <div class="wrapper">
            <div class="formSignup">
                <header>Signup</header>
                <form method="post">
                    <input type="text" name="name" id="name" placeholder="User Name"required>
                    <input type="email" name="email" id="email" placeholder="Email"required>
                    <input type="password" placeholder="Create  password" name="pass" required>
                    <input type="text" placeholder="Comfirm password" required name="checkpass">
                    <input type="submit" value="Signup" name="signup" class="submit">
                </form>
            </div>
            <div class="formLogin">
                <header>Login</header>
                <form  method="post">
                    <input type="email" name="email" id="email" placeholder="Email"required>
                    <input type="password" placeholder="Create  password" name="pass" required>                    
                    <input type="submit" value="Login" name="login" class="submit">
                </form>
            </div>
        </div>

        <script>
            const wrapper=document.querySelector(".wrapper"),
            signupHeader=document.querySelector(".formSignup header"),
            loginHeader=document.querySelector(".formLogin header");

            loginHeader.addEventListener("click",()=>{
                wrapper.classList.add("active");
            })

            signupHeader.addEventListener("click",()=>{
                wrapper.classList.remove("active");
            })
        </script>
    </body>
</html>