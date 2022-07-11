<?php
    session_start();
    $user_email = $_SESSION['email'];
    if (isset($_SESSION['email'])) {//ログインしているとき
        $msg = 'Hello, ' . htmlspecialchars($user_email, \ENT_QUOTES, 'UTF-8') .  ' &emsp;<a href="logout.php" class="btn">LOGOUT</a>';
    } else {//ログインしていないとき
        $msg = 'You have not logged in. &emsp;<a href="login_form.php" class="btn">LOGIN</a>';
    }
?>
<h1><?php echo $msg; ?></h1>

<!doctype html>
<html lang="'ja">
    <head>
        <meta charset="UTF-8">
        <title>Calendar_Registration</title>
        <meta name="description" content="カレンダー">
        <link rel="stylesheet" href="calender.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Arima:wght@300;700&display=swap" rel="stylesheet">
    </head>

    <body>
        <?php
            $data = array('user_email'=>$user_email);
            $data_json = json_encode($data);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL, 'http:/localhost:8090/calender');
            $result=curl_exec($ch);
            $res_json = json_decode($result , true );
        ?>


        <script type="text/javascript">

            var result = JSON.parse('<?php echo $result; ?>'); //JSONデコード
            const dayResult = result.map(schedule => {
            return schedule['day'];
            });
            console.log(dayResult);

            const week = ["日", "月", "火", "水", "木", "金", "土"];
            const today = new Date();
            // 月末だとずれる可能性があるため、1日固定で取得
            var showDate = new Date(today.getFullYear(), today.getMonth(), 1);

            // 初期表示
            window.onload = function () {
                showProcess(today, calendar);
            };
            // 前の月表示
            function prev(){
                showDate.setMonth(showDate.getMonth() - 1);
                showProcess(showDate);
            }

            // 次の月表示
            function next(){
                showDate.setMonth(showDate.getMonth() + 1);
                showProcess(showDate);
            }

            // 予定登録ページへ移動
            function schedule(){
                location.href = 'schedule_entry.php';
            }

            // ログインページへ移動
            function logout(){
                location.href = 'logout.php';
            }

            // カレンダー表示
            function showProcess(date) {
                var year = date.getFullYear();
                var month = date.getMonth();
                document.querySelector('#header').innerHTML = year + "年 " + (month + 1) + "月";

                var calendar = createProcess(year, month);
                console.log(calendar);
                document.querySelector('#calendar').innerHTML = calendar;
            }

            // カレンダー作成
            function createProcess(year, month) {
                // 曜日
                var calendar = "<table><tr class='dayOfWeek'>";
                for (var i = 0; i < week.length; i++) {
                    calendar += "<th width='30'>" + week[i] + "</th>";
                }
                calendar += "</tr>";

                var count = 0;
                var startDayOfWeek = new Date(year, month, 1).getDay();
                var endDate = new Date(year, month + 1, 0).getDate();
                var lastMonthEndDate = new Date(year, month, 0).getDate();
                var row = Math.ceil((startDayOfWeek + endDate) / week.length);

                // 1行ずつ設定
                for (var i = 0; i < row; i++) {
                    calendar += "<tr>";
                    // 1colum単位で設定
                    for (var j = 0; j < week.length; j++) {
                        if (i == 0 && j < startDayOfWeek) {
                            // 1行目で1日まで先月の日付を設定
                            calendar += "<td class='disabled'>" + (lastMonthEndDate - startDayOfWeek + j + 1) + "</td>";
                        } else if (count >= endDate) {
                            // 最終行で最終日以降、翌月の日付を設定
                            count++;
                            calendar += "<td class='disabled'>" + (count - endDate) + "</td>";
                        } else {
                            // 当月の日付を曜日に照らし合わせて設定
                            count++;
                            month_today = (month+1).toString().padStart(2, '0');
                            day_today = (count).toString().padStart(2, '0');

                            let firstDayIndex = dayResult.indexOf(year+"-"+month_today+"-"+day_today);
                            let lastDayIndex = dayResult.lastIndexOf(year+"-"+month_today+"-"+day_today);
                            if (firstDayIndex != -1) {
                                let schedule_cnt_per_day = lastDayIndex - firstDayIndex +1;
                                console.log(schedule_cnt_per_day);
                                console.log(day_today);
                                calendar += `<td class="schedule_day" data-date="${year}-${month_today}-${day_today}">${count}<br><div align="center" style="font-size: 2rem;color: #800000">${schedule_cnt_per_day}</div></td>`
                            }else{
                                calendar += `<td class="not_schedule_day" data-date="${year}-${month_today}-${day_today}">${count}</td>`
                            }  
                        }
                    }
                    calendar += "</tr>";
                }
                return calendar;
            }

            //引数で取得した日付をPOST
            function postForm(value) {
                var form = document.createElement('form');
                var request = document.createElement('input');

                form.method = 'POST';
                form.action = 'schedule.php';
                request.type = 'hidden'; //入力フォームが表示されないように
                request.name = 'day';
                request.value = value;
                form.appendChild(request);
                document.body.appendChild(form);
                form.submit();
            }

            //クリックしたセルの日付取得
            document.addEventListener("click", function(e) {
                if(e.target.classList.contains("schedule_day")) {
                    postForm(e.target.dataset.date)
                } else if(e.target.classList.contains("not_schedule_day")){
                    postForm(e.target.dataset.date)
                }
            })
            

        </script>
        <div class="wrapper">
            <!-- xxxx年xx月を表示 -->
            <h1 id="header"></h1>

            <!-- ボタンクリックで月移動 -->
            <div id="next-prev-button">
                <button id="prev" onclick="prev()">‹</button>
                <button id="next" onclick="next()">›</button>
            </div>
        
            <!-- カレンダー -->
            <div id="calendar"></div>
            <div id="innerHTMLtxt"></div>

            <!--　予定追加ボタン　-->
            <div id="schedule_entry">
                <button id="schedule" onclick="schedule()">+</button>
            </div>

        </div>   

    </body>
</html>