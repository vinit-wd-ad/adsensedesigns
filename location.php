<?php
// visit.php
// function get_client_ip() {
//     $keys = ['HTTP_CLIENT_IP','HTTP_X_FORWARDED_FOR','HTTP_X_FORWARDED','HTTP_X_CLUSTER_CLIENT_IP','HTTP_FORWARDED_FOR','HTTP_FORWARDED','REMOTE_ADDR'];
//     foreach ($keys as $k) {
//         if (!empty($_SERVER[$k])) {
//             $ips = explode(',', $_SERVER[$k]);
//             return trim($ips[0]);
//         }
//     }
//     return 'UNKNOWN';
// }

// $ip = get_client_ip();
// $geoJson = @file_get_contents("http://ip-api.com/json/{$ip}");
// $geo = $geoJson ? json_decode($geoJson, true) : null;

// // get raw user-agent header
// $ua = $_SERVER['HTTP_USER_AGENT'] ?? '';

// // simple UA parse (naive) — better use ua-parser-php / browscap
// function parse_simple_ua($ua) {
//     $info = ['browser'=>'Unknown','browser_version'=>'','os'=>'Unknown','device'=>'Unknown'];
//     if (preg_match('/Android\s+([\d\.]+)/i', $ua, $m)) { $info['os'] = 'Android '.$m[1]; }
//     elseif (preg_match('/iPhone OS\s*([\d_]+)/i', $ua, $m)) { $info['os'] = 'iOS '.str_replace('_','.', $m[1]); }
//     elseif (preg_match('/Windows NT\s*([\d\.]+)/i', $ua, $m)) { $info['os'] = 'Windows '.$m[1]; }
//     // device guesses
//     if (preg_match('/iPhone/i', $ua)) $info['device'] = 'iPhone';
//     elseif (preg_match('/iPad/i', $ua)) $info['device'] = 'iPad';
//     elseif (preg_match('/Android/i', $ua)) {
//         if (preg_match('/SM-|Pixel|GT-|Nexus|Mi |Redmi|M200|OPR/i', $ua, $m)) {
//             $info['device'] = trim($m[0]);
//         } else $info['device'] = 'Android device';
//     }
//     // browser
//     if (preg_match('/Chrome\/([\d\.]+)/i',$ua,$m)) $info['browser']='Chrome '.$m[1];
//     elseif (preg_match('/Firefox\/([\d\.]+)/i',$ua,$m)) $info['browser']='Firefox '.$m[1];
//     elseif (preg_match('/Safari\/([\d\.]+)/i',$ua,$m) && !preg_match('/Chrome/i',$ua)) $info['browser']='Safari';

//     return $info;
// }

// $ua_info = parse_simple_ua($ua);

// // log
// $log = [
//   'time' => date('Y-m-d H:i:s'),
//   'ip' => $ip,
//   'geo' => $geo,
//   'ua_raw' => $ua,
//   'ua_parsed' => $ua_info
// ];
// file_put_contents('visitors.log', json_encode($log, JSON_UNESCAPED_SLASHES).PHP_EOL, FILE_APPEND);

// header('Content-Type: application/json');
// echo json_encode($log);


?>

