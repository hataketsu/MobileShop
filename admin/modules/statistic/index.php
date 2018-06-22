<?php require_once __DIR__ . "/../../autoload/autoload.php";
require_once '../../../libraries/Carbon.php';

use Carbon\Carbon;

function getYears(Carbon $start, Carbon $end)
{
    $years = $end->diffInYears($start);
    $result = [];

    for ($i = 0; $i <= $years; $i++) {
        $nextYear = $start->copy();
        $nextYear->addYear(1);
        $item = [];

        foreach (['page_view', 'new_transaction', 'process_transaction', 'user_reg', 'revenue'] as $key) {
            $query = "select sum($key) from logs where date >= $start->timestamp and date <= $nextYear->timestamp";
            $sum = intval($db->link->query($query)->fetch_array()[0]);
            $item[$key] = $sum;
        }
        $item['label'] = $start->year;
        $result[$i] = $item;
        $start = $nextYear;
    }
    return $result;
}


function getMonths(Carbon $start, Carbon $end)
{
    $months = $end->diffInMonths($start);

    $result = [];

    for ($i = 0; $i <= $months; $i++) {
        $nextMonth = $start->copy();
        $nextMonth->addMonth(1);
        $item = [];
        foreach (['page_view', 'new_transaction', 'process_transaction', 'user_reg', 'revenue'] as $key) {
            $query = "select sum($key) from logs where date >= $start->timestamp and date <= $nextMonth->timestamp";
            $sum = intval($db->link->query($query)->fetch_array()[0]);
            $item[$key] = $sum;
        }
        $item['label'] = $start->year . '/' . $start->month;
        $result[$i] = $item;
        $start = $nextMonth;
    }
    return $result;
}


function getDays(Carbon $start, Carbon $end)
{
    $days = $end->diffInDays($start);

    $result = [];

    for ($i = 0; $i <= $days; $i++) {
        $result[$i] = getLogOrEmpty($start->timestamp);
        $result[$i]['label'] = $start->toDateString();
        $start->addDay(1);
    }
    return $result;
}


if (isset($_REQUEST['start'])) {
    $start = $_REQUEST['start'];
} else {
    $start = 'today - 29 day';
}
$start = new Carbon($start);


if (isset($_REQUEST['end'])) {
    $end = $_REQUEST['end'];
} else {
    $end = 'today';
}

$end = new Carbon($end);
$end = $end->addDay(1);
$end = $end->addSecond(-1);

$data = ['title' => 'Thống kê'];
if ($end->diffInYears($start) > 2) {
    $logs = getYears($start, $end);
} else if ($end->diffInMonths($start) > 3) {
    $logs = getMonths($start, $end);
} else {
    $logs = getDays($start, $end);
}
if (isset($_REQUEST['export'])) {
    $file = fopen('data.csv','w');
    fseek($file,0);
    $titles = ['page_view' => 'Lượt xem trang', 'new_transaction' => 'Đơn hàng mới', 'process_transaction'=>'Xử lý đơn hàng', 'user_reg' => 'Lượt đăng ký mới', 'revenue' => 'Doanh thu', 'label' => 'Thời gian'];

    foreach ($titles as $key => $value) {
        fwrite($file,$value. ',');
    }
    fwrite($file,"\n");

    foreach ($logs as $row) {
        foreach ($titles as $key => $value) {
            fwrite($file,$row[$key]. ',');
        }
        fwrite($file,"\n");
    }
    fclose($file);
    redirect("admin/modules/statistic/download.php?filename=Báo cáo bán hàng $start - $end.csv");
    die();
}

$open = "dashboard";

?>
<?php require_once __DIR__ . "/../../layouts/header.php"; ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
    <form method="get" id="time_form">
        <input type="hidden" id="start_time" name="start" ">
        <input type="hidden" id="end_time" name="end" ">
    </form>
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="">Thống kê</a>
                </li>

            </ol>
            <div id="reportrange"
                 style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc;display: inline ">
                <i class="fa fa-calendar"></i>&nbsp;
                <span></span> <i class="fa fa-caret-down"></i>
            </div>

            <h3 class="ui header">Đơn hàng</h3>
            <canvas id="orders_chart"></canvas>
            <br>
            <h3 class="ui header">Doanh thu</h3>
            <canvas id="revenue_chart"></canvas>
            <br>
            <h3 class="ui header">Lượt khách xem trang</h3>
            <canvas id="visits_chart"></canvas>
            <br>
            <center>
                <a class="btn btn-primary"
                   href="<?= modules('statistic') . '/index.php?' . http_build_query($_GET) . '&export' ?>">
                    <i class="fa fa-download" style="margin-right: 10px"></i>
                    Tải về báo cáo</a>

            </center>
            <br>
        </div>
        <script>
            var start = moment("<?=$start->format('M d,Y')?>");
            var end = moment("<?=$end->format('M d,Y')?>");

            function cb(start, end, update = true) {
                $("#start_time").val(start.format('MMMM D, YYYY'));
                $("#end_time").val(end.format('MMMM D, YYYY'));
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                if (update)
                    $('#time_form').submit();
            }

            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Trong 1 tuần': [moment().subtract(6, 'days'), moment()],
                    'Trong 1 tháng': [moment().subtract(29, 'days'), moment()],
                    'Tháng này': [moment().startOf('month'), moment().endOf('month')],
                    'Tháng trước': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);

            cb(start, end, false);
            //visits chart
            visits_chart_canvas = $('#visits_chart').get(0).getContext('2d');
            new Chart(visits_chart_canvas, {
                type: 'line',
                data: {
                    labels: <?= json_encode(array_column($logs, 'label')) ?>,
                    datasets: [{
                        label: 'Lượt truy cập',
                        data: <?= json_encode(array_column($logs, 'page_view')) ?>,
                        borderColor: '#3c8dbc',
                        borderWidth: 2
                    }]
                }
            });
            revenue_chart_canvas = $('#revenue_chart').get(0).getContext('2d');
            new Chart(revenue_chart_canvas, {
                type: 'line',
                data: {
                    labels: <?= json_encode(array_column($logs, 'label')) ?>,
                    datasets: [{
                        label: 'Doanh thu',
                        data: <?= json_encode(array_column($logs, 'revenue')) ?>,
                        borderColor: '#a035bc',
                        borderWidth: 2
                    }]
                }
            });

            orders_chart_canvas = $('#orders_chart').get(0).getContext('2d');
            new Chart(orders_chart_canvas, {
                type: 'bar',
                data: {
                    labels: <?= json_encode(array_column($logs, 'label')) ?>,
                    datasets: [{
                        label: 'Đơn hàng mới',
                        data: <?=  json_encode(array_column($logs, 'new_transaction')) ?>,
                        borderColor: '#58cd73',
                        borderWidth: 2
                    }, {
                        label: 'Xác nhận đơn',
                        data: <?=  json_encode(array_column($logs, 'process_transaction')) ?>,
                        borderColor: '#2773cd',
                        borderWidth: 2
                    },]
                }
            });
        </script>

<?php require_once __DIR__ . "/../../layouts/footer.php" ?>