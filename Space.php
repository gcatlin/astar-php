<?php

/**
 *
 */
class Space
{
	/**
	 *
	 */
	protected $goal;

	/**
	 *
	 */
	protected $graph;

	/**
	 *
	 */
	protected $start;

	/**
	 *
	 */
	public function __construct() {
		$this->graph = new Graph();
	}

	/**
	 *
	 */
	public function addEdge($index1, $index2, $weight=1) {
		$this->graph->addEdge($index1, $index2, $weight);
	}

	/**
	 *
	 */
	public function addNode($index, $element) {
		$this->graph->addVertex($index, $element);
	}

	/**
	 *
	 */
	public function getGoalIndex() {
		return $this->goal;
	}

	/**
	 *
	 */
	public function getNeighbors($index) {
		return $this->graph->getEdges($index);
	}

	/**
	 *
	 */
	public function getStartIndex() {
		return $this->start;
	}

	/**
	 *
	 */
	public function getNodes() {
		return $this->graph->getVertices();
	}

	/**
	 *
	 */
	public function goalDistance($index) {
		return;
	}

	/**
	 *
	 */
	public function setGoalNode($index) {
		$this->goal = $index;
	}

	/**
	 *
	 */
	public function setStartNode($index) {
		$this->start = $index;
	}
}
