<?php
include('header.php');
check();
userArea();
include('nav.php');
$category = '';
$id = 0;
?>

<style>
    .record {
        grid-template-columns: auto auto auto auto auto auto;
        padding: 1rem;
    }

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
<style>
    @import url('https://fonts.googleapis.com/css2?family=Orbitron&display=swap');
    @media screen and (max-width:450px) {
        html {
            font-size: 25%;
        }

        .dis2 {
            height: 110rem;
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

<script>
    function show(str1) {
        document.getElementById("result").innerHTML = "<div class='record rNav'><div>Category</div><div>Item</div><div>Price</div><div>Date</div><div>Edit</div><div>Delete</div></div><hr>";
        if (str1.length == 0) {
            document.getElementById("result").innerHTML += "Please Enter a expense name 🖋️!";
            return;
        }
        const xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState === 4 && xmlhttp.status === 200) {
                const response = xmlhttp.responseText;
                document.getElementById("result").innerHTML += response;
            }
        };
        xmlhttp.open("GET", "getSearchedRecord.php?str1=" + str1, true);
        xmlhttp.send();
    }
</script>
<div class="center form">
    <table>
        <tr>
            <td>Expense Name : </td>
            <td><input type="text" name="str1" onkeyup="show(this.value)"></td>
        </tr>
    </table>

</div>
<div class="dis2" id="result">
    <div class="record rNav">
        <div>Category</div>
        <div>Item</div>
        <div>Price</div>
        <div>Date</div>
        <div>Edit</div>
        <div>Delete</div>
    </div>
    <hr>
</div>

<?php
include('footer.php');
?>