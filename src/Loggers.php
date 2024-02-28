<?php

namespace Xel\Logger;
use Monolog\Logger;

class Loggers extends ApplicationLogger implements LoggerApp
{
    private static Logger $channel;

    /**
     * @param string $channel
     * @return Loggers
     */
    public static function channel(string $channel): Loggers
    {
        self::$channel = self::$setup["collections"][$channel]['channel'];
        return new self();
    }

    public static function debug(array|int|string $debug, array $context = []): void
    {
        self::$channel->debug($debug, $context);
    }
    public static function info(array|int|string $debug, array $context = []): void
    {
        self::$channel->info($debug, $context);
    }

    public static function notice(array|int|string $debug, array $context = []): void
    {
        self::$channel->notice($debug, $context);
    }

    public static function warning(array|int|string $debug, array $context = []): void
    {
        self::$channel->notice($debug, $context);
    }

    public static function error(array|int|string $debug, array $context = []): void
    {
        self::$channel->error($debug, $context);
    }

    public static function critical(array|int|string $debug, array $context = []): void
    {
        self::$channel->critical($debug, $context);
    }

    public static function alert(array|int|string $debug, array $context = []): void
    {
        self::$channel->alert($debug, $context);
    }

    public static function emergency(array|int|string $debug, array $context = []): void
    {
        self::$channel->emergency($debug, $context);
    }
}


