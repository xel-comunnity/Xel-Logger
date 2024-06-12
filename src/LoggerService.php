<?php

namespace Xel\Logger;

use Monolog\Handler\HandlerInterface;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Logger;

class LoggerService
{
    private array $loggers = [];
    private array $config;

    public function __construct(array $config, HandlerInterface ...$handlers)
    {
        $this->config = $config;
        $this->setupLoggers($handlers);
    }

    /**
     * Set up the loggers based on the provided configuration.
     *
     * @param HandlerInterface[] $handlers
     * @return void
     */
    private function setupLoggers(array $handlers): void
    {
        $mode = $this->config['mode'] ?? 'single';

        if ($mode === 'single') {
            $this->setupSingleLogger($handlers);
        } else {
            $this->setupStackedLoggers($handlers);
        }
    }

    /**
     * Set up a single logger instance with the provided handlers.
     *
     * @param HandlerInterface[] $handlers
     * @return void
     */
    private function setupSingleLogger(array $handlers): void
    {
        $logger = new Logger('single');

        foreach ($handlers as $handler) {
            $logger->pushHandler($handler);
        }

        $this->setupRotatingFileHandler($logger, $this->config['single_logging_generation'], $this->config['path']);
        $this->loggers['single'] = $logger;
    }

    /**
     * Set up multiple stacked loggers based on the configuration.
     *
     * @param HandlerInterface[] $handlers
     * @return void
     */
    private function setupStackedLoggers(array $handlers): void
    {
        foreach ($this->config['collections'] as $name => $loggerConfig) {
            $logger = new Logger($name);

            foreach ($handlers as $handler) {
                $logger->pushHandler($handler);
            }

            $this->setupRotatingFileHandler($logger, $loggerConfig['logging_generation'], $loggerConfig['path']);
            $this->loggers[$name] = $logger;
        }
    }

    /**
     * Set up the rotating file handler for a logger.
     *
     * @param Logger $logger
     * @param array $loggingGeneration
     * @param string $path
     * @return void
     */
    private function setupRotatingFileHandler(Logger $logger, array $loggingGeneration, string $path): void
    {
        $rotatingFileHandler = new RotatingFileHandler(
            $path,
            $loggingGeneration['format']['max'],
            $loggingGeneration['level'],
            true,
            0644,
            false,
            $loggingGeneration['format']['format']
        );

        $logger->pushHandler($rotatingFileHandler);
    }

    /**
     * Log a message at the specified level for a given logger.
     *
     * @param string $loggerName
     * @param mixed $message
     * @param array $context
     * @return void
     */
    public function debug(mixed $message, array $context = [], string $loggerName = 'single'): void
    {
        $this->log($loggerName, 'debug', $message, $context);
    }

    public function info(mixed $message, array $context = [],  string $loggerName = 'single'): void
    {
        $this->log($loggerName, 'info', $message, $context);
    }

    public function notice(mixed $message, array $context = [],  string $loggerName = 'single'): void
    {
        $this->log($loggerName, 'notice', $message, $context);
    }

    public function warning(mixed $message, array $context = [],  string $loggerName = 'single'): void
    {
        $this->log($loggerName, 'warning', $message, $context);
    }

    public function error(mixed $message, array $context = [],  string $loggerName = 'single'): void
    {
        $this->log($loggerName, 'error', $message, $context);
    }

    public function critical(mixed $message, array $context = [],  string $loggerName = 'single'): void
    {
        $this->log($loggerName, 'critical', $message, $context);
    }

    public function alert(mixed $message, array $context = [],  string $loggerName = 'single'): void
    {
        $this->log($loggerName, 'alert', $message, $context);
    }

    public function emergency(mixed $message, array $context = [],  string $loggerName = 'single'): void
    {
        $this->log($loggerName, 'emergency', $message, $context);
    }

    private function log(string $loggerName, string $level, mixed $message, array $context = []): void
    {
        if (isset($this->loggers[$loggerName])) {
            $this->loggers[$loggerName]->$level($message, $context);
        }
    }

    /**
     * Close all handlers and flush any remaining log entries.
     *
     * @return void
     */
    public function __destruct()
    {
        foreach ($this->loggers as $logger) {
            $handlers = $logger->getHandlers();
            foreach ($handlers as $handler) {
                $handler->close();
            }
        }
    }
}