<?php
include('header.php');
check();
adminArea();
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
            <td><input type="text" name="name" required value="<?php echo $category; ?>"></td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="center"><input type="submit" name="submit" value="submit" required class="submit"></div>
            </td>
        </tr>
        <?php 
        if (isset($_POST['submit'])) {
            $name = getSafeValue($_POST['name']);
            $res = pg_query($con, "SELECT * FROM category WHERE name = '$name'");
            if (pg_num_rows($res) > 0) {
                echo "<tr>
                    <td colspan='2'>
                        <div class='center'><h3>This $name category is already existing 🤨</h3></div>
                    </td>
                </tr>";
            } else {
                pg_query($con, "INSERT INTO category (name) VALUES ('$name')");
                redirect('category.php');
            }
        }
        ?>
    </table>
</form>