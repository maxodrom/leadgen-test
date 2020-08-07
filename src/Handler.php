<?php

namespace maxodrom\leadgentest;

use LeadGenerator\Lead;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class Handler
 * @package maxodrom\leadgentest
 */
class Handler
{
    /**
     * @var Logger
     */
    public static $logger;
    /**
     * @var string
     */
    public static $logFile;

    /**
     * @return string
     */
    public static function getLogFile(): string
    {
        return self::$logFile;
    }

    /**
     * @param string $logFile
     */
    public static function setLogFile(string $logFile)
    {
        self::$logFile = $logFile;
    }

    /**
     * Initialization work.
     */
    private static function init()
    {
        $appRoot = dirname(__DIR__);
        if (self::$logFile === null) {
            self::$logFile = $appRoot . '/www/log.txt';
        }
        if (self::$logger === null) {
            self::$logger = new Logger('leads_logger');
            $streamHandler = new StreamHandler(self::$logFile);
            $streamHandler->setFormatter(new LineFormatter("%message%\n"));
            self::$logger->pushHandler($streamHandler);
        }
    }

    /**
     * @param Lead $lead
     * @return bool
     */
    final public static function processLead(Lead $lead): bool
    {
        self::init();

        /**
         * В производственном режиме надо бы ставить обработку лидов в очереди (движок пока не критичен, можно
         * взять для начала хотя бы реляционную БД типа MySQL или, если позволяют ресурсы опер. памяти, использовать
         * Memcached, Redis etc).
         * Суть: контроль, проверка и обеспечение отказоустойчивости обработки элемента очереди,
         * перенаправление в альтернативные обработчики, если случается какая-либо внештатная ситуация,
         * обеспечение повторной обработки лидов, если по каким-либо причинам она "упала" и т.д.
         * Если важна скорость и объем обработки лидов, то помимо отказоустойчивости, необходимо хотя бы
         * какое-то горизонтальное масшабирование, алгоритмы распараллеливания обработки лидов.
         */
        // hard work emulation
        sleep(2);

        $logStr = implode('|', [
            $lead->id,
            $lead->categoryName,
            date('c', time())
        ]);

        self::$logger->info($logStr);

        return true;
    }
}