<?php
namespace Xel\Logger;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;
use Monolog\Handler\FirePHPHandler;

class ApplicationLogger
{
    protected FirePHPHandler $firePHPHandler;
    /**
     * @var array<int|string, mixed>
     */
    protected array $setup;
    public Logger $logger;

    /**
     * @param array<string|int, mixed> $setup
     * @param FirePHPHandler $firePHPHandler
     * @return ApplicationLogger
     */
    public function init(array $setup, FirePHPHandler $firePHPHandler): ApplicationLogger
    {
        // ? inject to property
        $this->firePHPHandler = $firePHPHandler;
        // ? inject setup
        $this->setup = $setup;
        // ? launch process
        $this->launch();
        return $this;
    }

    public function launch(): void
    {
        if ($this->setup["mode"] !== "single") {
            foreach ($this->setup["collections"] as $setup){
                // ? logger instance
                $this->logger = $setup['channel'];
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

                $this->logger->pushHandler($loggingGeneration);
                $this->logger->pushHandler($this->firePHPHandler);
            }
        } else {
            foreach ($this->setup["collections"] as $setup){
                // ? logger instance
                $this->logger = $setup['channel'];
                // ? Rotating Handler
                $loggingGeneration = new RotatingFileHandler
                (
                    $this->setup['path'],
                    $this->setup['single_logging_generation']['max'],
                    $setup["level"],
                    true,
                    0644,
                    false,
                    $this->setup['single_logging_generation']['format'],
                );

                $this->logger->pushHandler($loggingGeneration);
                $this->logger->pushHandler($this->firePHPHandler);
            }
        }
    }
}