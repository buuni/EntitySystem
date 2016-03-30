<?php
/**
 * Author: Demko Igor
 */

namespace App\Helpers;

use \Monolog\Logger;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

class LoggerEntityMigration implements LoggerInterface, LoggerAwareInterface {

	/**
	 * @var LoggerInterface
	 */
	protected $logger;

	public function __construct(Logger $logger) {
		$this->setLogger($logger);
	}

	public function setLogger(LoggerInterface $logger) {
		$this->logger = $logger;
	}

	public function emergency($message, array $context = array()) {
		$this->logger->emergency($message, $context);
	}
	
	public function alert($message, array $context = array()) {
		$this->logger->alert($message, $context);
	}

	public function critical($message, array $context = array()) {
		$this->logger->critical($message, $context);
	}

	public function error($message, array $context = array()) {
		$this->logger->error($message, $context);
	}

	public function warning($message, array $context = array()) {
		$this->logger->warning($message, $context);
	}

	public function notice($message, array $context = array()) {
		$this->logger->notice($message, $context);
	}

	public function info($message, array $context = array()) {
		$this->logger->info($message, $context);
	}

	public function debug($message, array $context = array()) {
		$this->logger->debug($message, $context);
	}

	public function log($level, $message, array $context = array()) {
		$this->logger->log($level, $message, $context);
	}
}