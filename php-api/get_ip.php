<?php
header('Content-Type: application/json');

if (!isset($_GET['ip'])) {
    echo json_encode(['error' => 'IP not provided']);
    exit;
}

$ip = $_GET['ip'];
$api_url = "http://ip-api.com/json/{$ip}?fields=status,message,country,regionName,city,isp,query";

$response = file_get_contents($api_url);
$data = json_decode($response, true);

if ($data['status'] === 'fail') {
    echo json_encode(['error' => $data['message']]);
    exit;
}

echo json_encode([
    'original_ip' => $data['query'],
    'city' => $data['city'],
    'country' => $data['country'],
    'regionName' => $data['regionName'],
    'isp' => $data['isp'],
]);
?>
