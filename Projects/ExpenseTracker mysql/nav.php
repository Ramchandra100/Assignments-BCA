<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
        <title>30 Day Expense</title>
        <link rel="stylesheet" href="style.css">
    </head>
<style>
    @import url('https://fonts.googleapis.com/css?family=Poppins:900i');
    @import url('https://fonts.googleapis.com/css2?family=Orbitron&display=swap');
    * {
        margin: 0%;
        padding: 0%;
        box-sizing: border-box;
    }

    html {
        font-size: 62.5%;
    }

    body{
            min-height: 100vh;
            background-color: #9DAAF2;
            background-size: cover;
        }

    nav {
        position: fixed;
        min-width: 30.6rem;
        width: 100vw;
        height: 8rem;
        background: #222;
        border-radius: 1rem;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        z-index: 1;
    }

    nav a {
        text-transform: capitalize;
        position: relative;
        font-size: 2rem;
        color: #898989;
        font-weight: 600;
        text-decoration: none;
        padding: 1rem 2rem 0.5rem 2rem;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
    }

    nav a::before {
        content: '';
        position: absolute;
        bottom: -0.4rem;
        left: 0;

        background: linear-gradient(217deg,
                rgb(255 0 0 / 80%),
                rgb(255 0 0 / 0%) 70.71%), linear-gradient(127deg, rgb(0 255 0 / 80%), rgb(0 255 0 / 0%) 70.71%),
            linear-gradient(336deg, rgb(0 0 255 / 80%), rgb(0 0 255 / 0%) 70.71%);

        width: 0;
        height: 0.3rem;
        margin-top:0.5rem;
        transition: all 0.5s;
    }

    nav a:hover {
        color: #fff;
        background: linear-gradient(217deg,
                rgb(255 0 0 / 80%),
                rgb(255 0 0 / 0%) 70.71%), linear-gradient(127deg, rgb(0 255 0 / 80%), rgb(0 255 0 / 0%) 70.71%),
            linear-gradient(336deg, rgb(0 0 255 / 80%), rgb(0 0 255 / 0%) 70.71%);

    }

    nav a:hover::before {
        width: 100%;
        
    }

    .navBack{
        width: 100vw;
        height: 5rem ;
        background: linear-gradient(217deg,
                rgb(255 0 0 / 80%),
                rgb(255 0 0 / 0%) 70.71%), linear-gradient(127deg, rgb(0 255 0 / 80%), rgb(0 255 0 / 0%) 70.71%),
            linear-gradient(336deg, rgb(0 0 255 / 80%), rgb(0 0 255 / 0%) 70.71%);
        border-radius: 1rem;


    }

    .logo{
        color: #fff;
        font-size: 3rem;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        font-weight: 500;
        padding: 2rem 4rem 2rem 4rem;
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
    }

    .logo:hover{
        background: linear-gradient(217deg,
                rgb(255 0 0 / 80%),
                rgb(255 0 0 / 0%) 70.71%), linear-gradient(127deg, rgb(0 255 0 / 80%), rgb(0 255 0 / 0%) 70.71%),
            linear-gradient(336deg, rgb(0 0 255 / 80%), rgb(0 0 255 / 0%) 70.71%);
    }

    .dis1{
      justify-content: space-evenly;
      font-size: 3rem;
    }
    span a{
      color: rgba(21, 231, 95, 0.919);;
      text-decoration: none;
      font-size: 2rem;
    }
    span a:hover{
      color: red;
    }
    img{
        height: 4rem;
        width: 4rem;
        margin-right: 1rem;
    }

    @media screen and (max-width:450px) {
        html {
            font-size: 25%;
        }
    }
</style>
<?php 
if($_SESSION['role']=='Admin'){
    ?>


    <nav>
    <div class="logo"><img src="images/logo.png" alt=""> Expense Tracker</div>
        <a href="category.php">Category</a>
        <a href="user.php">Users</a>
        <a href="userExpense.php">User Expense</a>
        <a href="logout.php">logout</a>
    </nav>
    <div class="navBack"></div>
    
    <?php 
}
else{
    ?>

<nav>
    <div class="logo"><img src="images/logo.png" alt="" height="80" width="80"> Expense Tracker</div>
    <a href="dashboard.php">Dashboard</a>
    <a href="expense.php">Category View</a>
    <a href="search.php">Search</a>
        <a href="logout.php">logout</a>
    </nav>
    <div class="navBack"></div>
    <style>
        .div3{
      position: relative;
      top: 5rem;
      padding-bottom: 5rem;
    }
.wrapper {
  display: flex;
  justify-content: center;
}

.cta {
    display: flex;
    padding: 1rem 4.5rem;
    text-decoration: none;
    font-family: 'Poppins', sans-serif;
    font-size: 3rem;
    color: white;
    background: #ac1f29d3;
    transition: 1s;
    border-radius: 1rem;
    box-shadow: 0.6rem 0.6rem 0 black;
    transform: skewX(-15deg);
}

.cta:focus {
   outline: none; 
}

.cta:hover {
    transition: 0.5s;
    box-shadow: 1rem 1rem 0 #FBC638;
}

.cta span:nth-child(2) {
    transition: 0.5s;
    margin-right: 0px;
}

.cta:hover  span:nth-child(2) {
    transition: 0.5s;
    margin-right: 4.5rem;
}

  span {
    transform: skewX(15deg) 
  }

  span:nth-child(2) {
    width: 2rem;
    margin-left: 3rem;
    position: relative;
    top: 12%;
  }
  

path.one {
    transition: 0.4s;
    transform: translateX(-60%);
}

path.two {
    transition: 0.5s;
    transform: translateX(-30%);
}

.cta:hover path.three {
    animation: color_anim 1s infinite 0.2s;
}

.cta:hover path.one {
    transform: translateX(0%);
    animation: color_anim 1s infinite 0.6s;
}

.cta:hover path.two {
    transform: translateX(0%);
    animation: color_anim 1s infinite 0.4s;
}

@keyframes color_anim {
    0% {
        fill: white;
    }
    50% {
        fill: #FBC638;
    }
    100% {
        fill: white;
    }
}
    </style>
<?php 
}
?>

