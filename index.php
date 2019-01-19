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
  <title>2019年和歌山大学カレンダー</title>
  <link rel="stylesheet" href="/js/fullcalendar.min.css">
</head>
<body>
<h1>2019年和歌山大学カレンダー</h1>
<?php
  echo "<div style='margin-bottom: 20px'>";
  echo "取得サイト:" . $doc["title"]->text() . "<br>";
  echo sprintf("<a href='%s'>%s</a>", $url, $url);
  echo $doc[".update>dd"];
  echo "</div>";
?>
<div id='calendar'></div>
<script src="/js/lib/jquery.min.js"></script>
<script src="/js/lib/moment.min.js"></script>
<script src="/js/fullcalendar.min.js"></script>
<script src="/js/locale/ja.js"></script>
<script src="index.js"></script>
</body>
</html>
