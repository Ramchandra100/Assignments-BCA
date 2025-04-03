<?php
include('header.php');
check();
adminArea();
if(isset($_GET['userId'])){
$userId=$_GET['userId'];
$res = mysqli_query($con, "SELECT users.id as userId,users.userName,category.name,expense.* from expense,users,category where expense.categoryId=category.id and expense.userId=users.id and users.id=$userId order by eDate DESC");
}
?>

<body>
    <?php
    include('nav.php');
    ?>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron&display=swap');
        @media screen and (max-width:450px) {
            html {
                font-size: 25%;
            }

            .dis2 {
                height: 120rem;
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
    

    <div class="dis2">
        <div class="record rNav">
            <div>User Id</div>
            <div>User Name</div>
            <div>Category Name</div>
            <div>Item</div>
            <div>Price</div>
            <div>Date</div>
        </div>
        <hr>
        <?php
        if (!mysqli_num_rows($res) > 0) {
            echo "no data found !";
        } else {
            while ($row = mysqli_fetch_assoc($res)) {
        ?>
                <div class="record sdiv">
                    <div><?php echo $row['userId']; ?></div>
                    <div><?php echo $row['userName']; ?></div>
                    <div><?php echo $row['name']; ?></div>
                    <div><?php echo $row['detail'] ?></div>
                    <div><?php echo $row['price'] ?></div>
                    <div><?php echo $row['eDate']; ?></div>
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