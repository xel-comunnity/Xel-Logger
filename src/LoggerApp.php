<?php

namespace Xel\Logger;
interface LoggerApp
{
    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public  function debug(string|array|int $debug, array $context = []):void;

    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public  function info(string|array|int $debug, array $context = []):void;

    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public function notice(string|array|int $debug, array $context = []):void;

    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public function warning(string|array|int $debug, array $context = []):void;

    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public  function error(string|array|int $debug, array $context = []):void;

    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public function critical(string|array|int $debug, array $context = []):void;

    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public function alert(string|array|int $debug, array $context = []):void;

    /**
     * @param string|array|int $debug
     * @param array $context
     * @return void
     */
    public function emergency(string|array|int $debug, array $context = []):void;
}