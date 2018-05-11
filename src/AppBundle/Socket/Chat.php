<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 19.04.2018
 * Time: 21:50
 */

namespace AppBundle\Socket;


use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);

        echo "Added a new connection: ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {

        foreach ($this->clients as $client) {
            if ($from !== $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);

    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}