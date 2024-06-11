<?php

use Monolog\Handler\FirePHPHandler;
use Monolog\Level;
use Monolog\Logger;
use Xel\Logger\ApplicationLogger;
use Xel\Logger\Loggers;
use Xel\Logger\LoggerSchedule;

it('can initialize and launch logger in stack mode', function () {
    $firePHPHandler = new FirePHPHandler();

    $setup = [
        "mode" => "stack", // change to stack to separate the logger,
        "single_logging_generation" => LoggerSchedule::Daily->apply(),
        "path" => __DIR__."/xel.log",
        "collections" => [
            "my_logger" => [
                "channel" => new Logger("my_logger"),
                "path" => __DIR__."/my_logger.log",
                "logging_generation"=> LoggerSchedule::Daily->apply(),
                "level" => Level::Debug,
            ],

            "security" => [
                "channel" => new Logger("security"),
                "path" => __DIR__.'/security.log',
                "logging_generation"=> LoggerSchedule::Daily->apply(),
                "level" => Level::Error,
            ],
        ],
    ];

    $logger = (new Xel\Logger\Loggers($setup, $firePHPHandler));
    $logger->launch();

    expect($logger)->toBeInstanceOf(Loggers::class);
    expect($logger->logger)->toBeInstanceOf(Logger::class);
    expect($logger->logger->getHandlers())->toHaveCount(count($setup['collections']));
});

it('can initialize and launch logger in single mode', function () {
    $firePHPHandler = new FirePHPHandler();

    $setup = [
        "mode" => "single", // change to stack to separate the logger,
        "single_logging_generation" => LoggerSchedule::Daily->apply(),
        "path" => __DIR__."/xel.log",
        "collections" => [
            "my_logger" => [
                "channel" => new Logger("my_logger"),
                "path" => __DIR__."/my_logger.log",
                "logging_generation"=> LoggerSchedule::Daily->apply(),
                "level" => Level::Debug,
            ],

            "security" => [
                "channel" => new Logger("security"),
                "path" => __DIR__.'/security.log',
                "logging_generation"=> LoggerSchedule::Daily->apply(),
                "level" => Level::Error,
            ],
        ],
    ];

    $logger = new Loggers($setup, $firePHPHandler);
    expect($logger)->toBeInstanceOf(Loggers::class);
    expect($logger->logger)->toBeInstanceOf(Logger::class);
    expect($logger->logger->getHandlers())->toHaveCount(count($setup['collections']));
});

