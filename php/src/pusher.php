<?php
require __DIR__ . '/vendor/autoload.php';

$options = array(
    'cluster' => 'eu',
    'useTLS' => true
);
$pusher = new Pusher\Pusher(
    'f1570dbb17401abd1897',
    '1759dbde6d0c78dab974',
    '1354574',
    $options
);

$data['message'] = 'hello janko';
$pusher->trigger('nexus-fe', 'my-event', $data);
