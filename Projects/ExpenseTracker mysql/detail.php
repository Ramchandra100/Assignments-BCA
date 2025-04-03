<?php
include('header.php');
check();
userArea();
$n = $_SESSION['name'];
if(isset($_GET['categoryId']) && isset($_GET['categoryName'])){
    $categoryId=$_GET['categoryId'];
    $_SESSION['temp1']=$_GET['categoryId'];
    $_SESSION['temp2']=$_GET['categoryName'];
    $res = mysqli_query($con, "SELECT category.name,expense.* from expense,users,category where expense.categoryId=category.id and expense.userId=users.id and users.userName='$n' and category.id=$categoryId order by eDate DESC");
}

if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id']) && $_GET['id'] > 0) {
    $categoryId=$_SESSION['temp1'];
    $res = mysqli_query($con, "SELECT category.name,expense.* from expense,users,category where expense.categoryId=category.id and expense.userId=users.id and users.userName='$n' and category.id=$categoryId order by eDate DESC");
    $userId=$_SESSION['id'];
    $id = $_GET['id'];
    $r = mysqli_query($con, "select price from expense where id=$id");
    $r1 = mysqli_fetch_assoc($r);
    $b = $_SESSION['leftAmount'];
    $b = $b + $r1['price'];
    $_SESSION['leftAmount'] = $b;
    mysqli_query($con, "UPDATE `users` SET `leftAmount` = '$b' WHERE `users`.`id` = '$userId'");
    mysqli_query($con, "delete from  expense where id=$id");
    
}
?>

<body>
    <?php
    include('nav.php');
    ?>
    <style>
        .cat{
            position: relative;
            background: rgba(255, 170, 0, 0.477);
            width: 50rem;
            top: 5rem;
        }
        @import url('https://fonts.googleapis.com/css2?family=Orbitron&display=swap');
        @media screen and (max-width:450px) {
            html {
                font-size: 25%;
            }

            .dis2 {
                height: 96rem;
            }

            .record div {
                width: 10rem;
            }

            .sdiv {
                margin-bottom: 3rem;
                margin-top: 1rem;
            }
        }
        .record {
            grid-template-columns: auto auto auto auto auto auto;
            padding: 1rem;
        }
    </style>
<div class="regDiv">
    <div class="welcomeTag">
      <?php 
        echo "Welcome " . $_SESSION['name']." 😁";
      ?>
    </div>
  </div>
    
    <div class="dis1">
        <div>
            <?php echo "Principle Amount: " . $_SESSION['principleAmount']; ?>
            <span><a href="principleChange.php">Edit</a></span>
        </div>
        <div>
            <?php echo "Left Amount: " . $_SESSION['leftAmount']; ?>
        </div>
    </div>

    <div class="dis1 cat">
        <div>
            <?php echo "Category : ". $_SESSION['temp2']; ?>
        </div>
    </div>
   

    <div class="dis2">
        <div class="record rNav">
            <div>Category</div>
            <div>Item</div>
            <div>Price</div>
            <div>Date</div>
            <div>Edit</div>
            <div>Delete</div>
        </div>
        <hr>
        <?php
        if (!mysqli_num_rows($res) > 0) {
            echo "no data found !";
        } else {
            while ($row = mysqli_fetch_assoc($res)) {
        ?>
                <div class="record sdiv">
                    <div><?php echo $row['name']; ?></div>
                    <div><?php echo $row['detail'] ?></div>
                    <div><?php echo $row['price'] ?></div>
                    <div><?php echo $row['eDate']; ?></div>
                    <div class="detial"><a href="manageExpense.php?id=<?php echo $row['id']; ?>&categoryName=<?php echo $row['name']; ?>"">Edit</a></div>
            <div class=" detial"><a href="?type=delete&id=<?php echo $row['id']; ?>">Delete</a></div>
                </div>
        <?php
            }
        }
        ?>
    </div>
</body>


<?php
include('footer.php');
?>