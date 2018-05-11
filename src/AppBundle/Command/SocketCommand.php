<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 19.04.2018
 * Time: 22:03
 */

namespace AppBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;


use AppBundle\Socket\Chat;

class SocketCommand extends Command
{
    protected function configure()
    {
        $this->setName('sockets:messeger');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new Chat()
                )
            ),
            8000
        );

        $server->run();
    }
}