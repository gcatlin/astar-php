<?php

/**
 * References:
 *   o http://www.nist.gov/dads/HTML/graph.html
 *   o http://www.helsinki.fi/~jbrown/tira/overview.html
 *   o http://www.cs.sunysb.edu/~algorith/files/graph-data-structures.shtml
 */
class Graph
{
	/**
	 *
	 */
	protected $edges;

	/**
	 *
	 */
	protected $vertices;

	/**
	 *
	 */
	public function __construct() {
		$this->edges = array();
		$this->vertices = array();
	}

	/**
	 *
	 */
	public function addEdge($index1, $index2, $weight=1) {
		$this->edges[$index1][$index2] = $weight;
	}

	/**
	 *
	 */
	public function addVertex($index, $element) {
		$this->vertices[$index] = $element;
		if (!isset($this->edges[$index])) {
			$this->edges[$index] = array();
		}
	}

	/**
	 *
	 */
	public function getEdges($index) {
		return $this->edges[$index];
	}

	/**
	 *
	 */
	public function getVertex($index) {
		return $this->vertices[$index];
	}

	/**
	 *
	 */
	public function getVertices() {
		return $this->vertices;
	}

	/**
	 *
	 */
	public function removeEdge($index1, $index2) {
		unset($this->edges[$index1][$index2]);
	}

	/**
	 *
	 */
	public function removeVertex($index) {
		unset($this->vertices[$index], $this->edges[$index]);
		foreach ($this->edges as $edges) {
			unset($edges[$index]);
		}
	}
}
