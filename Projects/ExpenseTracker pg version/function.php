<?php
function prx($data)
{
    echo '<pre>';
    print_r($_POST);
    die();
}

function getSafeValue($data)
{
    global $con;
    if ($data) {
        return pg_escape_string($con, $data);
    }
}

function redirect($link)
{
?>
    <script>
        window.location.href = "<?php echo $link ?>";
    </script>
<?php
}

function check()
{
    if (isset($_SESSION['id']) && $_SESSION['id'] != '') {
    } else {
        redirect('index.php');
    }
}

function getDashExpense($type)
{
    global $con;
    if ($type == 'week' || $type == 'year' || $type == 'today' || $type == 'month' || $type == 'yesterday') {
        $subQuery = '';
        $from='';
        $to='';
        if ($type == 'today') {
            $subQuery = "WHERE expenseDate='" . date('Y-m-d') . "'";
            $from=date('Y-m-d');
            $to=date('Y-m-d');
        } elseif ($type == 'yesterday') {
            $subQuery = "WHERE expenseDate='" . date('Y-m-d', strtotime('yesterday')) . "'";
            $from=date('Y-m-d', strtotime('yesterday'));
            $to=date('Y-m-d');
        } elseif ($type == 'month' || $type == 'week' || $type == 'year') {
            $subQuery = "WHERE expenseDate BETWEEN '" . date('Y-m-d', strtotime("-1 $type")) . "' AND '" .  date('Y-m-d') . "'";
            $from=date('Y-m-d', strtotime("-1 $type"));
            $to=date('Y-m-d');
        }

        $res = pg_query($con, "SELECT SUM(expenset.price) AS Price FROM expenset $subQuery");
        $row = pg_fetch_assoc($res);
        $p=0;
        $link='';
        if($row['Price']>0){
            $p=$row['Price'];
            $link="&nbsp;<a href='dashReport.php?from=$from&to=$to' target='_blank'>Details</a>";
        }
        return $p.$link;
    }
}

function userArea(){
    if($_SESSION['role']!='User'){
        redirect('category.php');
    }
}

function adminArea(){
    if($_SESSION['role']!='Admin'){
        redirect('dashboard.php');
    }
}
?>