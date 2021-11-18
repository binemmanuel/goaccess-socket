 <?php

    use PHPSocketIO\SocketIO;
    use Workerman\Worker;

    require './vendor/autoload.php';

    $io = new SocketIO(8181);

    $io->on('connection', function ($socket) {
        echo "A new User connected {$socket->id} \n";

        $socket->on('guest-arrive', function ($message) use ($socket) {
            echo "$message \n";
            $socket->broadcast->emit('guest-arrive', $message);
        });
    });

    Worker::runAll();
