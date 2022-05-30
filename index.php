<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>線上月曆</title>

    <!-- <link rel="stylesheet" href="./css/style.css"> -->
    <script src="https://kit.fontawesome.com/f14dbee59e.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@1,500&family=Roboto+Slab&display=swap" rel="stylesheet">


<style>
    * {
        box-sizing: border-box;
        margin: 0 auto;
        overflow: hidden;
    }

    body {
        width: 100vw;
        height: 100vh;
        /* background-image: linear-gradient(to right, #f5df4d, #939597); */
        font-family: 'Roboto Mono', monospace;
        /* font-family: 'Roboto Slab', serif; */
        background: linear-gradient(-70deg, #939597 40%, #f5df4d 30%);

    }

    form{
        margin:4rem auto 1rem;
        width: 900px;
        font-family: 'Roboto Mono', monospace;
        

    }
    
    form .btn{
        border-radius: 20px;
        /* border: 2px solid #91b54d; */
        border: 2px solid #aaa;
        font-family: 'Roboto Mono', monospace;
        /* background: #91b54d;  */
        background: #aaa; 
        font-size: 16px;

    }


    .container {
        background-color: rgba(244, 245, 240, .4);
        border-radius: 20px;
        display: flex;
        margin: 1rem auto;
        width: 950px;
        height: 630px;
        box-shadow: 4px 4px 12px -2px rgba(0, 0, 0, 0.5);
    }

    img {
        border-radius: 20px 0 0 20px;
        margin-right: 5px;

    }

    .aside {
        width: 560px;
        margin: 0 30px 0 10px;
    }

    .calendar {
        width: 560px;
        height: 560px;
        /* border:1px solid green; */
        display: flex;
        align-content: space-between;
        flex-wrap: wrap;
        /* margin: auto; */
        margin-top: 0;
        text-align: center;
    }

    .calendar div {
        /* border: 1px solid #999; */
        display: inline-block;
        width: 80px;
        height: 80px;
        box-sizing: border-box;
        /* margin-left: -1px; */
        margin-top: -2px;
        padding: 20px;
        margin-top: 10px;
    }

    .calendar div:hover {
        font-size: 22px;
        text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2);
    }

    .calendar div.week {
        border-bottom: 1px solid #333;
        font-weight: 800;
        color: #333;
        height: 50px;
        font-size: 16px;
        padding: 15px 10px;
        margin-bottom: -20px;
    }

    .weekend {
        font-weight: bold;
        color: #c8102e;
    }


    .workday {
        color: #333;
    }

    .today {
        background-color: rgba(244, 245, 240, .8);
        border-radius: 50%;
        color: #718B5A;
        padding: 12px;
    }

    .wrapper {
        width: 950px;
        /* margin: 2rem auto; */
    }

    .nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 560px;
        height: 50px;
        padding-top: 8px;
    }

    .year>a {
        font-weight: bold;
        text-decoration: none;
        color: #333;
        font-size: 20px;
    }

    .year>a:hover {
        font-size: 26px;
        text-shadow: 2px 2px 0px rgba(0, 0, 0, 0.2);
    }


    .header>a {
        font-size: 30px;
        font-weight: bold;
        color: #333;
        text-decoration: none;

    }
</style>
</head>

<?php

if (isset($_GET['month'])) {
    $month = $_GET['month'];
    $year = $_GET['year'];
} else {
    $month = date('n');
    $year = date("Y");
}

if ($month == 1) {
    $prevMonth = 12;
    $prevYear = $year - 1;
    $nextMonth = $month + 1;
    $nextYear = $year;
} else if ($month == 12) {
    $prevMonth = $month - 1;
    $prevYear = $year;
    $nextMonth = 1;
    $nextYear = $year + 1;
} else {
    $prevMonth = $month - 1;
    $prevYear = $year;
    $nextMonth = $month + 1;
    $nextYear = $year;
}

$monthEn = array(
    1 => "JAN",
    2 => "FEB",
    3 => "MAR",
    4 => "APR",
    5 => "May",
    6 => "JUN",
    7 => "JUL",
    8 => "AUG",
    9 => "SEP",
    10 => "OCT",
    11 => "NOV",
    12 => "DEC"
);


?>

<body class="background">

    <!-- <div class="wrapper"> -->
    <?php


    $firstDay = $year . "-" . $month . "-1";
    $firstWeekday = date("w", strtotime($firstDay));
    $monthDays = date("t", strtotime($firstDay));
    $lastDay =  $year . "-"  . $month . "-" . $monthDays;
    $today = date("Y-m-d");
    $lastWeekday = date("w", strtotime($lastDay));
    $dateHouse = [];

    for ($i = 0; $i < $firstWeekday; $i++) {
        $dateHouse[] = "";
    }

    for ($i = 0; $i < $monthDays; $i++) {
        $date = date("Y-m-d", strtotime("+$i days", strtotime($firstDay)));
        $dateHouse[] = $date;
    }

    for ($i = 0; $i < (6 - $lastWeekday); $i++) {
        $dateHouse[] = "";
    }

    ?>
        <form action="./index.php" method="get">
            <input type="number" name="year" id="year" oninput="if(value.length>4)value=value.slice(0,4)" style="width:100px;" placeholder="Year: <?= $year; ?>">
            <input type="number" name="month" id="month" oninput="if(value>12)value=12;if(value.length>2)value=value.slice(0,2)"  style="width:80px;" placeholder="Month: <?= $month; ?>">
           <button class="btn"> GO <i class="fa-solid fa-plane"></i> </button> 
        </form>

    <div class="container">
        <img src="./img/air<?= $month; ?>0<?= 1 ?>.jpg" alt="" width="350px" height="630px">
        <div class="aside">
            <div class="nav">
                <span class="year">
                    <a href="index.php?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>">
                        <i class="fa-solid fa-arrow-left"></i></a>
                </span>
                <span class="header">
                    <a href="index.php"><?= $year; ?> <?= $monthEn[$month]; ?>
                </span>
                <span class="year">
                    <a href="index.php?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>">
                        <i class="fa-solid fa-arrow-right"></i></a>
                </span>
            </div>

            <div class="calendar">
                <div class='week'>SUN</div>
                <div class='week'>MON</div>
                <div class='week'>TUE</div>
                <div class='week'>WED</div>
                <div class='week'>THU</div>
                <div class='week'>FRI</div>
                <div class='week'>SAT</div>
                <?php
                foreach ($dateHouse as $k => $day) { //$k指的是索引值
                    if ($day == $today) {
                        $hol = 'today';
                    } else if ($k % 7 == 0 || $k % 7 == 6) {
                        $hol = 'weekend';
                    } else {
                        $hol = '';
                    }

                    // $hol = ($k % 7 == 0 || $k % 7 == 6) ? 'weekend' : "";

                    if (!empty($day)) {
                        $dayFormat = date("j", strtotime($day));
                        echo "<div class='{$hol}'>{$dayFormat}</div>";
                    } else {
                        echo "<div class='{$hol}'></div>";
                    }
                }

                ?>


            </div>
        </div>
    </div>
    <!-- </div> -->

</body>

</html>