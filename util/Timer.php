<?php

/**
 *
 */
class Timer
{
	/**
	 *
	 */
	protected $elapsedTime = 0;

	/**
	 *
	 */
	protected $isRunning = false;

	/**
	 *
	 */
	protected $markers = array();

	/**
	 *
	 */
	protected $startTime = null;

	/**
	 *
	 */
	public function __construct() {
		$this->start();
	}

	/**
	 *
	 */
	public function elapsed() {
		if ($this->isRunning) {
			if ($this->startTime !== null) {
				return microtime(true) - $this->startTime;
			}
			return 0;
		}
		return $this->elapsedTime;
	}

	/**
	 *
	 */
	public function reset() {
		$this->elapsedTime = 0;
		$this->isRunning = false;
		$this->startTime = null;
	}

	/**
	 *
	 */
	public function resume() {
		$this->isRunning = true;
		$this->startTime = microtime(true);
	}

	/**
	 *
	 */
	public function set($time) {
		$this->start();
		$this->startTime = $time;
	}

	/**
	 *
	 */
	public function setMarker($name) {
		$this->marker[$name] = $this->elapsed();
	}

	/**
	 *
	 */
	public function start() {
		$this->elapsedTime = 0;
		$this->isRunning = true;
		$this->startTime = microtime(true);
	}

	/**
	 *
	 */
	public function stop() {
		$this->elapsedTime = $this->elapsed();
		$this->isRunning = false;
		return $this->elapsedTime;
	}
}
