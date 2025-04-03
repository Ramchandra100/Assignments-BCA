<?php
include('header.php');
check();
userArea();
include('nav.php');
$category = '';
$id = 0;
?>

<style>
    .center {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 5rem;
    }

    td {
        width: 28rem;
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
        width: 22rem;
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
            <td>Principle Amount : </td>
            <td><input type="text" name="amount" required value="<?php echo $_SESSION['principleAmount'] ?>"></td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="center"><input type="submit" name="submit" value="submit" required class="submit"></div>
            </td>
        </tr>
        <?php
        if (isset($_POST['amount'])) {
            $newPrinciple = getSafeValue($_POST['amount']);
            $a = $_SESSION['principleAmount'];
            $b = $_SESSION['leftAmount'];
            $expenseAmount = $a - $b;
            $_SESSION['principleAmount'] = $newPrinciple;
            $_SESSION['leftAmount'] = $newPrinciple - $expenseAmount;
            $a = $_SESSION['principleAmount'];
            $b = $_SESSION['leftAmount'];
            $userId = $_SESSION['id'];
            $res = mysqli_query($con, "UPDATE `users` SET `principleAmount` = '$a', `leftAmount` = '$b' WHERE `users`.`id` = $userId");
                redirect('dashboard.php');
            }
        ?>
    </table>

</form>