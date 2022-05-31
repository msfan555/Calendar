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
    <link rel="stylesheet" href="./style.css">
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
            <input class="input1" type="number" name="year" id="year" oninput="if(value.length>4)value=value.slice(0,4)" style="width:120px;" placeholder="Year: <?= $year; ?>">
            <input class="input2" type="number" name="month" id="month" oninput="if(value>12)value=12;if(value.length>2)value=value.slice(0,2)"  style="width:100px;" placeholder="Month: <?= $month; ?>">
           <button class="btn"> GO <i class="fa-solid fa-plane"></i> </button> 
        </form>

    <div class="container">
        <img src="./img/air<?= $month; ?>0<?= 1 ?>.jpg" alt="" width="350px" height="630px">
        <div class="aside">
            <div class="nav">
                <span >
                    <a class="year" href="index.php?year=<?= $prevYear; ?>&month=<?= $prevMonth; ?>">
                        <i class="fa-solid fa-arrow-left"></i></a>
                </span>
                <span>
                    <a class="header" href="index.php"><?= $year; ?> <?= $monthEn[$month]; ?></a>
                </span>
                <span>
                    <a class="year" href="index.php?year=<?= $nextYear; ?>&month=<?= $nextMonth; ?>">
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