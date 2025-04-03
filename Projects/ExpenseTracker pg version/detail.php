<?php
include('header.php');
check();
userArea();
$n = $_SESSION['name'];
if(isset($_GET['categoryId']) && isset($_GET['categoryName'])){
    $categoryId=$_GET['categoryId'];
    $_SESSION['temp1']=$_GET['categoryId'];
    $_SESSION['temp2']=$_GET['categoryName'];
    $res = pg_query($con, "SELECT category.name, expense.* FROM expense, users, category WHERE expense.categoryId = category.id AND expense.userId = users.id AND users.userName = '$n' AND category.id = $categoryId ORDER BY eDate DESC");
}

if (isset($_GET['type']) && $_GET['type'] == 'delete' && isset($_GET['id']) && $_GET['id'] > 0) {
    $categoryId=$_SESSION['temp1'];
    $res = pg_query($con, "SELECT category.name, expense.* FROM expense, users, category WHERE expense.categoryId = category.id AND expense.userId = users.id AND users.userName = '$n' AND category.id = $categoryId ORDER BY eDate DESC");
    $userId=$_SESSION['id'];
    $id = $_GET['id'];
    $r = pg_query($con, "SELECT price FROM expense WHERE id = $id");
    $r1 = pg_fetch_assoc($r);
    $b = $_SESSION['leftAmount'];
    $b = $b + $r1['price'];
    $_SESSION['leftAmount'] = $b;
    pg_query($con, "UPDATE users SET leftAmount = '$b' WHERE id = '$userId'");
    pg_query($con, "DELETE FROM expense WHERE id = $id");
    
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
        if (!pg_num_rows($res) > 0) {
            echo "no data found !";
        } else {
            while ($row = pg_fetch_assoc($res)) {
        ?>
                <div class="record sdiv">
                    <div><?php echo $row['name']; ?></div>
                    <div><?php echo $row['detail']; ?></div>
                    <div><?php echo $row['price']; ?></div>
                    <div><?php echo $row['eDate']; ?></div>
                    <div class="detial"><a href="manageExpense.php?id=<?php echo $row['id']; ?>&categoryName=<?php echo $row['name']; ?>">Edit</a></div>
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