<?php

namespace Xel\Logger;
interface LoggerApp
{
    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public static function debug(string|array|int $debug, array $context = []):void;

    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public static function info(string|array|int $debug, array $context = []):void;

    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public static function notice(string|array|int $debug, array $context = []):void;

    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public static function warning(string|array|int $debug, array $context = []):void;

    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public static function error(string|array|int $debug, array $context = []):void;

    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public static function critical(string|array|int $debug, array $context = []):void;

    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public static function alert(string|array|int $debug, array $context = []):void;

    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public static function emergency(string|array|int $debug, array $context = []):void;
}