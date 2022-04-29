<?php
  require __DIR__ . '/vendor/autoload.php';

  $options = array(
    'cluster' => 'ap1',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '340619b6612437aee2af',
    '3a67e7e0388d0ddb562d',
    '1324607',
    $options
  );

  $data['message'] = 'hello worlddddddddddddd';
  $pusher->trigger('new-cms', 'my-event', $data);
?>
