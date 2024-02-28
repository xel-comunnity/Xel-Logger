<?php
namespace Xel\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Handler\FirePHPHandler;

class ApplicationLogger
{
    protected static FirePHPHandler $firePHPHandler;
    /**
     * @var array<int|string, mixed>
     */
    protected static array $setup;
    public static Logger $logger;

    /**
     * @param array<string|int, mixed> $setup
     * @param FirePHPHandler $firePHPHandler
     * @return ApplicationLogger
     */
    public static function init(array $setup, FirePHPHandler $firePHPHandler): ApplicationLogger
    {
        // ? inject to property
        self::$firePHPHandler = $firePHPHandler;
        // ? inject setup
        self::$setup = $setup;
        // ? launch process
        self::launch();
        return new self();
    }

    protected static function launch(): void
    {
        if (self::$setup["mode"] !== "single") {
            foreach (self::$setup["collections"] as $setup){
                // ? logger instance
                self::$logger = $setup['channel'];
                // ? Rotating Handler
                $loggingGeneration = new RotatingFileHandler
                (
                    $setup["path"],
                    $setup["logging_generation"]["max"],
                    $setup["level"],
                    true,
                    0644,
                    false,
                    $setup["logging_generation"]["format"],
                );

                self::$logger->pushHandler($loggingGeneration);
                self::$logger->pushHandler(self::$firePHPHandler);
            }
        } else {
            foreach (self::$setup["collections"] as $setup){
                // ? logger instance
                self::$logger = $setup['channel'];
                // ? Rotating Handler
                $loggingGeneration = new RotatingFileHandler
                (
                    self::$setup['path'],
                    self::$setup['single_logging_generation']['max'],
                    $setup["level"],
                    true,
                    0644,
                    false,
                    self::$setup['single_logging_generation']['format'],
                );

                self::$logger->pushHandler($loggingGeneration);
                self::$logger->pushHandler(self::$firePHPHandler);
            }
        }
    }
}