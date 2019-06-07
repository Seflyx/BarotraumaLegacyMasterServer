<?php
  define('NON_DIRECT', true);
  require 'database.php';

  $action = $_GET['action'];
  switch($action) {
    case 'listservers':
      if($stmt = $db->prepare('SELECT serverip, serverport, servername, gamestarted, currplayers, maxplayers, password FROM server_list WHERE `timelisted` > (CURRENT_TIMESTAMP - INTERVAL 35 SECOND)')) {
        if($stmt->execute()) {
          http_response_code(200);
          
          $stmt_result = $stmt->get_result();
          while($r = $stmt_result->fetch_assoc()) {
            echo "{$r['serverip']}|{$r['serverport']}|{$r['servername']}|{$r['gamestarted']}|{$r['currplayers']}|{$r['maxplayers']}|{$r['password']}\n";
          }
        } else {
          http_response_code(422);
        }
      } else {
        http_response_code(500);
      }
      break;
    case 'removeserver':
      if($stmt = $db->prepare('DELETE FROM server_list WHERE serverip=? AND serverport=?')) {
        
        $stmt->bind_param('si', $serverip, $serverport);
        $serverip = $_SERVER['REMOTE_ADDR'];
        $serverport = $_GET['serverport'] ?? 14242;
        
        if($stmt->execute()) {
          http_response_code(200);
        } else {
          http_response_code(422);
        }
      } else {
        http_response_code(500);
      }
      break;
    default:
      http_response_code(400);
      break;
  }
?>