<?php
include('header.php');
check();
userArea();

if(isset($_GET['str1'])){
    $str1=$_GET['str1'];
    $userId=$_SESSION['id'];
    $res=mysqli_query($con,"SELECT expense.*,category.name from expense,category,users where expense.categoryId=category.id and expense.userId=users.id and users.id=$userId and detail LIKE '$str1%'");
    if (!mysqli_num_rows($res) > 0) {
        echo "No Data Found 🥲!";
    } else {
        while ($row = mysqli_fetch_assoc($res)) {
    ?>
            <div class="record sdiv">
                <div><?php echo $row['name']; ?></div>
                <div><?php echo $row['detail'] ?></div>
                <div><?php echo $row['price'] ?></div>
                <div><?php echo $row['eDate']; ?></div>
                <div class="detial"><a href="manageExpense.php?id=<?php echo $row['id']; ?>&categoryName=<?php echo $row['name']; ?>">Edit</a></div>
        <div class=" detial"><a href="?type=delete&id=<?php echo $row['id']; ?>">Delete</a></div>
            </div>
    <?php
        }
    }
}

?>
