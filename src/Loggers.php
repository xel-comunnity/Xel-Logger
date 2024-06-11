<?php

namespace Xel\Logger;
use Monolog\Handler\FirePHPHandler;
use Monolog\Logger;

class Loggers extends ApplicationLogger implements LoggerApp
{
    private Logger $channel;

    public function __construct(array $setup, FirePHPHandler $firePHPHandler)
    {
        parent::__construct($setup, $firePHPHandler);
        $this->channel = $this->setup["collections"]['my_logger']['channel'];

    }

    /**
     * @param string $channel
     * @return Loggers
     */

    public function channel(string $channel): Loggers
    {
        $this->channel = $this->setup["collections"][$channel]['channel'];
        return $this;
    }

    public function debug(array|int|string $debug, array $context = []): void
    {
        $this->channel->debug($debug, $context);
    }
    public function info(array|int|string $debug, array $context = []): void
    {
        $this->channel->info($debug, $context);
    }

    public function notice(array|int|string $debug, array $context = []): void
    {

        $this->channel->notice($debug, $context);
    }

    public function warning(array|int|string $debug, array $context = []): void
    {
        $this->channel->notice($debug, $context);
    }

    public function error(array|int|string $debug, array $context = []): void
    {
        $this->channel->error($debug, $context);
    }

    public function critical(array|int|string $debug, array $context = []): void
    {
        $this->channel->critical($debug, $context);
    }

    public function alert(array|int|string $debug, array $context = []): void
    {
        $this->channel->alert($debug, $context);
    }

    public function emergency(array|int|string $debug, array $context = []): void
    {
        $this->channel->emergency($debug, $context);
    }
}


