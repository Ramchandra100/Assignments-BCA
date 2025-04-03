<?php
include('header.php');
check();
userArea();
include('nav.php');
$userId = $_SESSION['id'];
$expenseId = 0;
$categoryId = '';
$price = '';
$details = '';
$expenseDate = '';
$choice = '';

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $label = 'EDIT';
    $_SESSION['tem'] = getSafeValue($_GET['id']);
    $expenseId = $_SESSION['tem'];
    $res = pg_query($con, "SELECT * FROM expense WHERE id = $expenseId");
    $row = pg_fetch_assoc($res);
    $categoryId = $row['categoryId'];
    $price = $row['price'];
    $details = $row['detail'];
    $expenseDate = $row['eDate'];
}

if (isset($_POST['submit'])) {
    $categoryId = getSafeValue($_POST['id']);
    $price = getSafeValue($_POST['price']);
    $details = getSafeValue($_POST['details']);
    $expenseDate = getSafeValue($_POST['expenseDate']);
    $userId = $_SESSION['id'];

    if ($_POST['expenseDate'] == '') {
        $expenseDate = date('Y-m-d');
    }

    if (isset($_GET['id']) && $_GET['id'] > 0) {
        $choice = 'edit';
    }
    if ($choice == 'edit') {
        $expenseId = $_SESSION['tem'];
        $r = pg_query($con, "SELECT price FROM expense WHERE id = $expenseId");
        $r1 = pg_fetch_assoc($r);
        $b = $_SESSION['leftAmount'];
        $b = $b + $r1['price'];
        $b = $b - $price;
        $_SESSION['leftAmount'] = $b;
        pg_query($con, "UPDATE users SET leftAmount = '$b' WHERE id = '$userId'");
        pg_query($con, "UPDATE expense SET eDate = '$expenseDate', categoryId = '$categoryId' WHERE id = $expenseId");
        pg_query($con, "UPDATE expense SET price = '$price', detail = '$details' WHERE id = $expenseId");
        redirect('dashboard.php');
    } else {
        pg_query($con, "INSERT INTO expense (price, detail, eDate, userId, categoryId) VALUES ('$price', '$details', '$expenseDate', '$userId', '$categoryId')");
        $b = $_SESSION['leftAmount'];
        $b = $b - $price;
        $_SESSION['leftAmount'] = $b;
        $c = pg_query($con, "UPDATE users SET leftAmount = '$b' WHERE id = '$userId'");
        if ($c) {
            redirect('dashboard.php');
        }
    }
}
?>

<style>
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 5rem;
    }

    td {
        width: 25rem;
        font-size: 3rem;
        font-weight: 700;
        padding-top: 1.5rem;
        padding-right: 1.5rem;
    }

    td input,
    select {
        height: 4rem;
        width: 30rem;
        font-size: 2.5rem;
        border-radius: 1rem;
        padding-left: 1.5rem;
    }

    .submit {
        width: 20rem;
        height: 4rem;
        border-radius: 1rem;
        font-weight: 650;
        font-size: 2rem;
        background-color: #22ccfc;
        color: #f2f7f5;
        margin-top: -5rem;
    }

    .submit:active {
        background-color: #04bef1;
        color: #aab9bd;
    }

    @media screen and (max-width:450px) {
        .form {
            margin-top: 15rem;
        }
    }
</style>
<form method="post" class="center form">
    <table>
        <tr>
            <td>Category Name : </td>
            <td><select required name="id">
                    <?php
                    if (isset($_GET['id']) && $_GET['id'] > 0) {
                        echo "<option value=" . $_GET['id'] . ">" . $_GET['categoryName'] . "</option>";
                    } else {
                        echo "<option value=''>select category</option>";
                    }
                    ?>

                    <?php
                    $r = pg_query($con, "SELECT * FROM category ORDER BY name DESC");
                    while ($row1 = pg_fetch_assoc($r)) {
                    ?>
                        <option value="<?php echo $row1['id'] ?>"><?php echo $row1['name'] ?></option>
                    <?php
                    }
                    ?>
                </select></td>
        </tr>
        <tr>
            <td>Price : </td>
            <td><input type="text" name="price" required value="<?php echo $price; ?>"></td>
        </tr>
        <tr>
            <td>Details : </td>
            <td><input type="text" name="details" required value="<?php echo $details; ?>"></td>
        </tr>
        <tr>
            <td>Date(Optional if its current) : </td>
            <td><input type="date" name="expenseDate" value="<?php echo $expenseDate; ?>" max="<?php echo date('Y-m-d'); ?>"></td>
        </tr>

        <tr>
            <td colspan="2">
                <div class="center"><input type="submit" name="submit" value="submit" required class="submit"></div>
            </td>
        </tr>
    </table>

</form>