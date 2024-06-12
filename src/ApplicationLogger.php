<?php
namespace Xel\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Handler\FirePHPHandler;

class ApplicationLogger
{
    private static array $loggers = [];

    public static function launch(array $setup, FirePHPHandler $firePHPHandler): Logger
    {
        $key = serialize($setup);

        if (!isset(self::$loggers[$key])) {
            $logger = new Logger($setup['name']);
            $logger->pushHandler($firePHPHandler);
            $logger->pushHandler(self::createRotatingFileHandler($setup));

            self::$loggers[$key] = $logger;
        }

        return self::$loggers[$key];
    }

    private static function createRotatingFileHandler(array $setup): RotatingFileHandler
    {
        $loggingGeneration = $setup['mode'] === 'single'
            ? $setup['single_logging_generation']
            : $setup['logging_generation'];

        return new RotatingFileHandler(
            $setup['path'],
            $loggingGeneration['max'],
            $setup['level'],
            true,
            0644,
            false,
            $loggingGeneration['format']
        );
    }

    public static function flush(): void
    {
        self::$loggers = [];
    }
//    public Logger $logger;
//
//    public function __construct(protected array $setup, protected FirePHPHandler $firePHPHandler)
//    {}
//
//
//    public function launch(): void
//    {
//        if ($this->setup["mode"] !== "single") {
//            foreach ($this->setup["collections"] as $setup){
//                // ? logger instance
//                $this->logger = $setup['channel'];
//                // ? Rotating Handler
//                $loggingGeneration = new RotatingFileHandler
//                (
//                    $setup["path"],
//                    $setup["logging_generation"]["max"],
//                    $setup["level"],
//                    true,
//                    0644,
//                    false,
//                    $setup["logging_generation"]["format"],
//                );
//
//                $this->logger->pushHandler($loggingGeneration);
//                $this->logger->pushHandler($this->firePHPHandler);
//            }
//        } else {
//            foreach ($this->setup["collections"] as $setup){
//                // ? logger instance
//                $this->logger = $setup['channel'];
//                // ? Rotating Handler
//                $loggingGeneration = new RotatingFileHandler
//                (
//                    $this->setup['path'],
//                    $this->setup['single_logging_generation']['max'],
//                    $setup["level"],
//                    true,
//                    0644,
//                    false,
//                    $this->setup['single_logging_generation']['format'],
//                );
//
//                $this->logger->pushHandler($loggingGeneration);
//                $this->logger->pushHandler($this->firePHPHandler);
//            }
//        }
//    }
}