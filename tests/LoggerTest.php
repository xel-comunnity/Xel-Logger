<?php

use Monolog\Handler\FirePHPHandler;
use Monolog\Level;
use Monolog\Logger;
use Xel\Logger\ApplicationLogger;
use Xel\Logger\Loggers;
use Xel\Logger\LoggerSchedule;

it('can call function of logger channel',function (){
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

    ApplicationLogger::init($setup, $firePHPHandler);
    $logger = Loggers::channel('my_logger');

    $debugMessage = 'Debug message';
    $infoMessage = 'Info message';
    $warningMessage = 'Warning message';
    $errorMessage = 'Error message';
    $criticalMessage = 'Critical message';
    $alertMessage = 'Alert message';
    $emergencyMessage = 'Emergency message';

    $logger::debug($debugMessage);
    $logger::info($infoMessage);
    $logger::notice($infoMessage);
    $logger::warning($warningMessage);
    $logger::error($errorMessage);
    $logger::critical($criticalMessage);
    $logger::alert($alertMessage);
    $logger::emergency($emergencyMessage);
    expect(true)->toBeTrue(); // Placeholder assertion

});