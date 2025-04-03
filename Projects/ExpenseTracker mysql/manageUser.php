<?php
include('header.php');
check();
include('nav.php');
$id = 0;
$principleAmount = 0;
$leftAmount = 0;
$name = '';
$email = '';
$pass = '';
$role = '';
$choice = '';

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $_SESSION['tem'] = getSafeValue($_GET['id']);
    $id=$_SESSION['tem'];
    $res = mysqli_query($con, "select * from users where id=$id");
    $row = mysqli_fetch_assoc($res);
    $name = $row['userName'];
    $email = $row['email'];
    $pass = $row['pass'];
    $role = $row['role'];
    $principleAmount = $row['principleAmount'];
    $leftAmount = $row['leftAmount'];
    $choice = 'Edit';
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
        width: 30rem;
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

<form method="post" class="center">
    <table>
        <tr>
            <td>User Name : </td>
            <td><input type="text" name="name" required value="<?php echo $name ?>"></td>
        </tr>
        <tr>
            <td>User Email : </td>
            <td><input type="text" name="email" required value="<?php echo $email ?>"></td>
        </tr>
        <tr>
            <td>User Password : </td>
            <td><input type="text" name="pass" required value="<?php echo $pass ?>"></td>
        </tr>
        <tr>
            <td>user Role : </td>
            <td><input type="text" name="role" required value="<?php echo $role ?>"></td>
        </tr>
        <tr>
            <td>Principle Amount : </td>
            <td><input type="text" name="principleAmount" required value="<?php echo $principleAmount ?>"></td>
        </tr>
        <tr>
            <td>Left Amount : </td>
            <td><input type="text" name="leftAmount" required value="<?php echo $leftAmount ?>"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="submit" required class="submit"></td>
        </tr>
        <?php
        if (isset($_POST['submit'])) {
            $name = getSafeValue($_POST['name']);
            $email = getSafeValue($_POST['email']);
            $pass = getSafeValue($_POST['pass']);
            $role = getSafeValue($_POST['role']);
            $principleAmount = getSafeValue($_POST['principleAmount']);
            $leftAmount = getSafeValue($_POST['leftAmount']);
            $pass = password_hash($pass, PASSWORD_DEFAULT);
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id=$_SESSION['tem'];
                mysqli_query($con, "UPDATE `users` SET `userName` = '$name', `email` = '$email', `pass` = '$pass', `role` = '$role', `principleAmount` = '$principleAmount', `leftAmount` = '$leftAmount' WHERE `users`.`id` = '$id';");
                redirect('user.php');
            } else {
                $res = mysqli_query($con, "select * from users where Username='$name'");
                if (mysqli_num_rows($res) > 0) {
                    echo "<tr>
                    <td colspan='2'>
                        <div class='center'><h3>This $name User is already existing 🤨</h3></div>
                    </td>
                </tr>";
                } else {
                    mysqli_query($con, "INSERT INTO `users` (`id`, `userName`, `email`, `pass`, `role`, `principleAmount`, `leftAmount`) VALUES (NULL, '$name', '$email', '$pass', '$role', '$principleAmount', '$leftAmount');");
                    redirect('user.php');
                }
            }
        }

        ?>
    </table>
</form>


