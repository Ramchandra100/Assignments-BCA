<?php
include('header.php');
check();
userArea();

if(isset($_GET['str1'])){
    $str1=$_GET['str1'];
    $userId=$_SESSION['id'];
    $res=pg_query($con,"SELECT expense.*, category.name FROM expense, category, users WHERE expense.categoryId = category.id AND expense.userId = users.id AND users.id = $userId AND detail LIKE '%$str1%'");
    if (!pg_num_rows($res) > 0) {
        echo "No Data Found 🥲!";
    } else {
        while ($row = pg_fetch_assoc($res)) {
    ?>
            <div class="record sdiv">
                <div><?php echo $row['name']; ?></div>
                <div><?php echo $row['detail']; ?></div>
                <div><?php echo $row['price']; ?></div>
                <div><?php echo $row['eDate']; ?></div>
                <div class="detial"><a href="manageExpense.php?id=<?php echo $row['id']; ?>&categoryName=<?php echo $row['name']; ?>">Edit</a></div>
                <div class="detial"><a href="?type=delete&id=<?php echo $row['id']; ?>">Delete</a></div>
            </div>
    <?php
        }
    }
}
?>