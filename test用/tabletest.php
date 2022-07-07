<!doctype html>
<html lang="'ja">
    <head>
        <meta charset="UTF-8">
        <title>Calender_Registration</title>
        <meta name="description" content="カレンダー">
        <link rel="stylesheet" href="calender3.css">
    </head>

    <body>
    <table id="tbl">
      <tr>
        <th>比較</th><th>テックアカデミー</th><th>テックキャンプ</th>
      </tr>
      <tr>
        <th>学習方式</th><td>オンライン</td><td>教室</td>
      </tr>
      <tr>
        <th>言語</th><td>いろいろ</td><td>Ruby on Rails</td>
      </tr>
      <tr>
        <th>料金</th><td>20万円</td><td>10万円</td>
      </tr>
      </tbody>
    </table>
    <p id="result"></p>
    
    <script>
    var mytable = document.getElementById("tbl");
 
    for (var i=0; i < mytable.rows.length; i++) {
    for (var j=0; j < mytable.rows[i].cells.length; j++) {
        mytable.rows[i].cells[j].id = i + "-" + j;
        mytable.rows[i].cells[j].onclick = clicked;
    }
    }
    
    function clicked(e) {
    var txt = document.getElementById("result");
    txt.textContent = e.target.id + "がクリックされました。値は：" + e.target.innerHTML;
    }
    </script>


    </body>
</html>
