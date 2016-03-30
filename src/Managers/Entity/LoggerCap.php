<?php
/**
 * Author: Demko Igor
 */

namespace Entity;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

class LoggerCap extends AbstractLogger implements LoggerAwareInterface {
	protected $logger;

	public function setLogger(LoggerInterface $logger) {
		$this->logger = $logger;
	}

	public function emergency($message, array $context = array()) {}

	public function alert($message, array $context = array()) {}

	public function critical($message, array $context = array()) {}

	public function error($message, array $context = array()) {}

	public function warning($message, array $context = array()) {}

	public function notice($message, array $context = array()) {}

	public function info($message, array $context = array()) {}

	public function debug($message, array $context = array()) {}

	public function log($level, $message, array $context = array()) {}
}