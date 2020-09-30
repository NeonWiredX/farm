<?php


namespace Farm\Infrastructure;


use Farm\Infrastructure\Exceptions\InvalidConfigurationException;
use http\Exception\RuntimeException;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class Logger implements LoggerInterface
{
    protected string $path;
    protected int $logLevel;

    public const NONE = 'none';

    private array $messageBuffer = [];

    /**
     * array for capability to override
     *
     * @return int[]
     */
    protected function priority(): array
    {
        return [
            self::NONE => 0,
            LogLevel::EMERGENCY => 1,
            LogLevel::ALERT => 2,
            LogLevel::CRITICAL => 3,
            LogLevel::ERROR => 4,
            LogLevel::WARNING => 5,
            LogLevel::NOTICE => 6,
            LogLevel::INFO => 7,
            LogLevel::DEBUG => 8,
        ];
    }


    public function __construct(array $params)
    {

        $path = $params['path'] ?? '';
        $logLevel = $params['logLevel'] ?? 'info';

        $this->path = $path;
        if (!array_key_exists($logLevel, $this->priority())) {
            throw new InvalidConfigurationException("Default log level not found");
        }
        $this->logLevel = $this->priority()[$logLevel];
    }

    public function emergency($message, array $context = array()): void
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    public function alert($message, array $context = array()): void
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    public function critical($message, array $context = array()): void
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    public function error($message, array $context = array()): void
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    public function warning($message, array $context = array()): void
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    public function notice($message, array $context = array()): void
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    public function info($message, array $context = array()): void
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    public function debug($message, array $context = array()): void
    {
        $this->log(LogLevel::DEBUG, $message, $context);
    }

    public function log($level, $message, array $context = array()): void
    {
        if (!array_key_exists($level, $this->priority())) {
            throw new RuntimeException("Log level not found");
        }

        if ($this->logLevel >= $this->priority()[$level]) {
            //TODO: implement standart: __toString objects method
            $this->messageBuffer[] = $message;
        }
    }

    public function __destruct()
    {
        $text = implode("\n", $this->messageBuffer);
        //TODO: investigate better method here
        file_put_contents($this->path, $text);
    }
}