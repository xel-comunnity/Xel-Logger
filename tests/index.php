<?php

use Monolog\Handler\FirePHPHandler;
use Monolog\Level;
use Xel\Logger\LoggerSchedule;
use Xel\Logger\LoggerService;

require __DIR__ . "/../vendor/autoload.php";



// Log messages to the single logger



// Create an HTTP server and listen on 0.0.0.0:9501
$http = new Swoole\Http\Server('0.0.0.0', 9501);

// Handle incoming HTTP requests
$http->on('request', function ($request, $response){
    // Get the request data
    $path = $request->server['path_info'];
    $method = $request->server['request_method'];


    // log
    $firePHPHandler = new FirePHPHandler();
    $setup = [
        "mode" => "stacked", // change to "stacked" to separate the loggers
        "single_logging_generation" => [
            'level' => Level::Debug, // Log level for the single logger
            'format' => LoggerSchedule::Daily->apply(), // Log file name format
        ],
        "path" => __DIR__ . "/xel.log",
        "collections" => [
            "my_logger" => [
                "path" => __DIR__ . "/my_logger.log",
                "logging_generation" => [
                    'level' => Level::Debug, // Log level for the single logger
                    'format' => LoggerSchedule::Daily->apply(), // Log file name format
                ],
            ],
            "security" => [
                "path" => __DIR__ . '/security.log',
                "logging_generation" => [
                    'level' => Level::Debug, // Log level for the single logger
                    'format' => LoggerSchedule::Daily->apply(), // Log file name format
                ],
            ],
        ],
    ];

    $logger = new LoggerService($setup, $firePHPHandler);

    // Handle different routes and methods
    switch ($path) {
        case '/':
//            $logger->debug('single', ['This is a debug message']);
//            $logger->debug('single', ['This is a debug message']);
//            $logger->debug('single',  ['This is a debug message']);

            $logger->debug('single', ['This is a debug message'],'my_logger');
            $logger->debug('single', ['This is a debug message'],'my_logger');
            $logger->debug('single',  ['This is a debug message'],'my_logger');


            $logger->debug('single', ['This is a debug message'],'security');
            $logger->debug('single', ['This is a debug message'],'security');
            $logger->debug('single',  ['This is a debug message'],'security');

            $response->header('Content-Type', 'text/plain');
            $response->end('Hello, Swoole!');
            break;
        case '/user':
            if ($method === 'GET') {
                $response->header('Content-Type', 'application/json');
                $response->end(json_encode(['name' => 'John Doe', 'email' => 'john@example.com']));
            } else {
                $response->status(405);
                $response->end('Method Not Allowed');
            }
            break;
        default:
            $response->status(404);
            $response->end('Not Found');
    }
});

// Start the server
$http->start();





















//$logger = new Loggers($setup, $firePHPHandler);
//
//$debugMessage = 'Debug message';
//$infoMessage = 'Info message';
//$warningMessage = 'Warning message';
//$errorMessage = 'Error message';
//$criticalMessage = 'Critical message';
//$alertMessage = 'Alert message';
//$emergencyMessage = 'Emergency message';
//
//$logger->debug($debugMessage);
//$logger->info($infoMessage);
//$logger->notice($infoMessage);
//$logger->warning($warningMessage);
//$logger->error($errorMessage);
//$logger->critical($criticalMessage);
//$logger->alert($alertMessage);
//$logger->emergency($emergencyMessage);
//$setup = [
//    "mode" => "single", // change to stack to separate the logger,
//    "single_logging_generation" => LoggerSchedule::Daily->apply(),
//    "path" => __DIR__."/xel.log",
//    "collections" => [
//        "my_logger" => [
//            "channel" => new Logger("my_logger"),
//            "path" => __DIR__."/my_logger.log",
//            "logging_generation"=> LoggerSchedule::Daily->apply(),
//            "level" => Level::Debug,
//        ],
//
//        "security" => [
//            "channel" => new Logger("security"),
//            "path" => __DIR__.'/security.log',
//            "logging_generation"=> LoggerSchedule::Daily->apply(),
//            "level" => Level::Error,
//        ],
//    ],
//];
// Create the logger service