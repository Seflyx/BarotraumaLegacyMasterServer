<?php
  define('NON_DIRECT', true);
  require 'database.php';

  $action = $_GET['action'];
  switch($action) {
    case 'addserver':
      if($stmt = $db->prepare("REPLACE INTO server_list(servername, serverip, serverport, currplayers, maxplayers, password, version, contentpackage) VALUES(?, ?, ?, ?, ?, ?, ?, ?)")) {
        
        $stmt->bind_param('ssiiiiss', $servername, $serverip, $serverport, $currplayers, $maxplayers, $password, $version, $contentpackage);
        $servername = $_GET['servername'] ?? 'Untitled Server';
        $serverip = $_SERVER['REMOTE_ADDR'];
        $serverport = $_GET['serverport'] ?? 14242;
        $currplayers = $_GET['currplayers'] ?? 0;
        $maxplayers = $_GET['maxplayers'] ?? 10;
        $password = $_GET['password'] ?? 0;
        $version = $_GET['version'] ?? 'Unknown';
        $contentpackage = $_GET['contentpackage'] ?? 'Unknown';
        
        if($stmt->execute()) {
          http_response_code(200);
        } else {
          http_response_code(422);
        }
      } else {
        http_response_code(500);
      }
      break;
    case 'refreshserver':
      if($stmt = $db->prepare('UPDATE server_list SET gamestarted=?, currplayers=?, maxplayers=?, timelisted=CURRENT_TIMESTAMP WHERE serverip=? AND serverport=?')) {
        
        $stmt->bind_param('iiisi', $gamestarted, $currplayers, $maxplayers, $serverip, $serverport);
        $gamestarted = $_GET['gamestarted'] ?? 0;
        $currplayers = $_GET['currplayers'] ?? 0;
        $maxplayers = $_GET['maxplayers'] ?? 10;
        $serverip = $_SERVER['REMOTE_ADDR'];
        $serverport = $_GET['serverport'] ?? 14242;
        
        if($stmt->execute()) {
          if($stmt->affected_rows == 0) {
            echo 'Error: server not found';
          }
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