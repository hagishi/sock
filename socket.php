<?php
// サーバーソケットの作成
$socket = stream_socket_server('tcp://0.0.0.0:8888', $errno, $errstr);
if (!$socket) {
    die("$errstr ($errno)\n");
}

// 接続待ちループ
while ($conn = @stream_socket_accept($socket, -1)) {

    echo "client connected.\n";

    // welcome メッセージを送信
    $welcome = "welcome to simple php echo server!\n";
    fwrite($conn, $welcome, strlen($welcome));

    // 送受信ループ
    while ($read = fread($conn, 4096)) {
        echo "message receive: $read\n";
        // エコーバックする
		$msg = json_decode($read, true);

		$msg[1]= 'hogehog';

		$read = json_encode($msg);

		echo $read;

        fwrite($conn, $read, strlen($read));
    }
    if(!fclose($conn)) {
        echo "fclose failed.\n";
    } else {
        echo "connection closed.\n";
    }
}
