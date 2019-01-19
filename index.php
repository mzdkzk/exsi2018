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
  <title>Web情報収集システム</title>
  <style>
  div {
    float: left;
    background: #ffffff;
    width: 300px;
    padding: 20px;
    text-align: left;
    border: 1px solid #cccccc;
    margin: 15px 5px 10px 4px;
  }

  body {
    background: #f0f8ff;
    color: #ff6600;
  }
  </style>
</head>
<body>
<h1>Web情報収集システム</h1>
<?php
  echo "<div>";
  echo "取得サイト:" . $doc["title"]->text() . "<br>";
  echo $doc[".update>dd"];
  echo "</div>";

  echo '<div class="image-contents">';
  foreach ($doc[".fl"]->find("li") as $li) {
    echo pq($li)->text() . "<br>";
  }
  echo "</div>";
?>
</body>
</html>
