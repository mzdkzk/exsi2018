<?php
  require_once("phpQuery-onefile.php");
  require_once("pathChanger.php");
  $url = "http://www.wakayama-u.ac.jp/scenter/basic/calendar/calendar_h31.html";
  $doc = phpQuery::newDocumentFileHtml($url);

  function get_date($data) {
    $event = mb_strcut($data, 22, strlen($data));
    $event = preg_replace('/　/', ' ', $event);
    $event = preg_replace('/\s+/', ',', $event);
    // $events = explode(",", $event);

    $data = explode("月", $data);
    $month = mb_convert_kana($data[0], 'n');
    $data = explode("日", $data[1]);
    $day = mb_convert_kana($data[0], 'n');

    return ["title" => $event, "start" => sprintf("2019-%02d-%02d", $month, $day)];
  }

  $result = [];
  foreach ($doc[".fl"]->find("li") as $li) {
    $data = pq($li)->text();
    array_push($result, get_date($data));
  }
  foreach ($doc[".fr"]->find("li") as $li) {
    $data = pq($li)->text();
    array_push($result, get_date($data));
  }

  header('Content-type: text/plain');
  echo json_encode(["result" => $result, "length" => count($result)], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
