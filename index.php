<?php
  require_once("phpQuery-onefile.php");
  require_once("pathChanger.php");
  $url = "http://www.wakayama-u.ac.jp/scenter/basic/calendar/calendar_h30.html";
  $doc = phpQuery::newDocumentFileHtml($url);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>平成31年度和歌山大学カレンダー</title>
  <link rel="stylesheet" href="/js/fullcalendar.min.css">
</head>
<body>
<h1>平成31年度和歌山大学カレンダー</h1>
<?php
  echo "<p>";
  echo "取得サイト:" . $doc["title"]->text() . "<br>";
  echo sprintf("<a href='%s'>%s</a>", $url, $url);
  echo "</p>";
?>
<div id='calendar'></div>
<script src="/js/lib/jquery.min.js"></script>
<script src="/js/lib/moment.min.js"></script>
<script src="/js/fullcalendar.min.js"></script>
<script src="/js/locale/ja.js"></script>
<script src="index.js"></script>
</body>
</html>
