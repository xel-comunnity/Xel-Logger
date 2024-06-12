<?php

namespace Xel\Logger;
use Monolog\Handler\FirePHPHandler;
use Monolog\Logger;

class Loggers extends ApplicationLogger implements LoggerApp
{
    private Logger $logger;
    public function __construct(array $setup, FirePHPHandler $firePHPHandler)
    {
        $this->logger = ApplicationLogger::launch($setup, $firePHPHandler);
    }


    /**
     * @inheritDoc
     */
    public function debug(array|int|string $debug, array $context = []): void
    {
        $this->logger->debug($debug, $context);
    }

    /**
     * @inheritDoc
     */
    public function info(array|int|string $debug, array $context = []): void
    {
        $this->logger->info($debug, $context);
    }

    /**
     * @inheritDoc
     */
    public function notice(array|int|string $debug, array $context = []): void
    {
        $this->logger->notice($debug, $context);
    }

    /**
     * @inheritDoc
     */
    public function warning(array|int|string $debug, array $context = []): void
    {
        $this->logger->warning($debug, $context);
    }

    /**
     * @inheritDoc
     */
    public function error(array|int|string $debug, array $context = []): void
    {
        $this->logger->error($debug, $context);
    }

    /**
     * @inheritDoc
     */
    public function critical(array|int|string $debug, array $context = []): void
    {
        $this->logger->critical($debug, $context);
    }

    /**
     * @inheritDoc
     */
    public function alert(array|int|string $debug, array $context = []): void
    {
        $this->logger->alert($debug, $context);
    }

    /**
     * @inheritDoc
     */
    public function emergency(array|int|string $debug, array $context = []): void
    {
        $this->logger->emergency($debug, $context);
    }

    public function __destruct()
    {
        foreach ($this->logger->getHandlers() as $handler) {
            if (method_exists($handler, 'close')) {
                $handler->close();
            }
        }
    }



    //    private Logger $channel;
//
//    public function __construct(array $setup, FirePHPHandler $firePHPHandler)
//    {
//        parent::__construct($setup, $firePHPHandler);
//        $this->channel = $this->setup["collections"]['my_logger']['channel'];
//
//    }
//
//    /**
//     * @param string $channel
//     * @return Loggers
//     */
//
//    public function channel(string $channel): Loggers
//    {
//        $this->channel = $this->setup["collections"][$channel]['channel'];
//        return $this;
//    }
//
//    public function debug(array|int|string $debug, array $context = []): void
//    {
//        $this->channel->debug($debug, $context);
//    }
//    public function info(array|int|string $debug, array $context = []): void
//    {
//        $this->channel->info($debug, $context);
//    }
//
//    public function notice(array|int|string $debug, array $context = []): void
//    {
//
//        $this->channel->notice($debug, $context);
//    }
//
//    public function warning(array|int|string $debug, array $context = []): void
//    {
//        $this->channel->notice($debug, $context);
//    }
//
//    public function error(array|int|string $debug, array $context = []): void
//    {
//        $this->channel->error($debug, $context);
//    }
//
//    public function critical(array|int|string $debug, array $context = []): void
//    {
//        $this->channel->critical($debug, $context);
//    }
//
//    public function alert(array|int|string $debug, array $context = []): void
//    {
//        $this->channel->alert($debug, $context);
//    }
//
//    public function emergency(array|int|string $debug, array $context = []): void
//    {
//        $this->channel->emergency($debug, $context);
//    }
//
//    public function __destruct()
//    {
//        // Close any resources if necessary, such as file handlers
//        foreach ($this->channel->getHandlers() as $handler) {
//            if (method_exists($handler, 'close')) {
//                $handler->close();
//            }
//        }
//    }

}


