<?php
  require_once("lib/phpQuery-onefile.php");
  require_once("lib/pathChanger.php");
  $url = "http://www.wakayama-u.ac.jp/scenter/basic/calendar/calendar_h30.html";
  $doc = phpQuery::newDocumentFileHtml($url);
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
  $.get('json.php', function(data) {
    $('#calendar').fullCalendar({
      events: JSON.parse(data).result
    })
  })
})
</script>
</body>
</html>
