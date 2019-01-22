<?php
  mb_internal_encoding("UTF-8");
  require_once("lib/phpQuery-onefile.php");
  require_once("lib/pathChanger.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>平成31年度和歌山大学カレンダー</title>
  <link rel="stylesheet" href="css/fullcalendar.min.css">
</head>
<body>
<h1>平成31年度和歌山大学カレンダー</h1>
<?php
  $url = "http://www.wakayama-u.ac.jp/scenter/basic/calendar/calendar_h31.html";
  $doc = phpQuery::newDocumentFileHtml($url);
  echo "<p>";
  echo sprintf("取得サイト:%s<br>", $doc["title"]->text());
  echo sprintf("<a href='%s'>%s</a>", $url, $url);
  echo "</p>";
?>
<div id='calendar'></div>
<script src="js/jquery.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/fullcalendar.min.js"></script>
<script src="js/locale/ja.js"></script>
<script>
$(document).ready(function() {
  <?php
  $url = "http://www.wakayama-u.ac.jp/scenter/basic/calendar/calendar_h31.html";
  $doc = phpQuery::newDocumentFileHtml($url);

  function get_date($data)
  {
    preg_match("/(?<=）)(.*)/", $data, $event);
    // 無関係なデータを除外
    if (!$event) {
      return [];
    }

    // 全角スペース除去
    $event = preg_replace('/　/', ' ', $event[0]);
    $event = trim($event);
    // 整形して中に残った半角スペースを区切り文字に
    $event = preg_replace('/\s+/', ',', $event);
    $events = explode(",", $event);

    $data = explode("月", $data);
    $month = mb_convert_kana($data[0], 'n');
    $data = explode("日", $data[1]);
    $day = mb_convert_kana($data[0], 'n');

    $year = 2018;
    if (intval($month) < 4) {
      $year = 2019;
    }

    $r = [];
    foreach ($events as $e) {
      $r[] = ["title" => $e, "start" => sprintf("%d-%02d-%02d", $year, $month, $day)];
    }
    return $r;
  }

  $result = [];
  foreach ($doc[".block"]->find("li") as $li) {
    $data = pq($li)->text();
    $result = array_merge($result, get_date($data));
  }

  $json = json_encode(["result" => $result, "length" => count($result)], JSON_UNESCAPED_UNICODE);
  echo sprintf("let data = %s;", $json);
  ?>
  $('#calendar').fullCalendar({
    events: data.result
  })
})
</script>
</body>
</html>
