<?php
/**
 * @package    Publisher
 * @subpackage Model
 * @version    $Id$
 */

if (!class_exists('SplPriorityQueue')) {
	/**
	 * Adapted from:
	 * http://framework.zend.com/svn/framework/standard/trunk/library/Zend/Search/Lucene/PriorityQueue.php
	 *
	 * @package    Publisher
	 * @subpackage Model
	 */
	class SplPriorityQueue implements Iterator, Countable
	{
		/**
		 *
		 */
		const EXTR_DATA = 1;
		const EXTR_PRIORITY = 2;
		const EXTR_BOTH = 3;

		/**
		 *
		 */
		protected $extract_flags = self::EXTR_DATA;

		/**
		 * Queue heap
		 *
		 * Heap contains balanced partial ordered binary tree represented in array
		 * [0] - top of the tree
		 * [1] - first child of [0]
		 * [2] - second child of [0]
		 * ...
		 * [2*n + 1] - first child of [n]
		 * [2*n + 2] - second child of [n]
		 *
		 * @var array
		 */
		public $heap = array();

		/**
		 * Stores a copy of the heap for iteration
		 */
		protected $iterator;

		/**
		 * Compare priorities in order to place elements correctly in the heap while
		 * sifting up. Returns 1 if priority1 is greater than priority2, 0 if they 
		 * are equal, -1 otherwise.
		 *
		 * @param mixed $priority1 The priority of the first node being compared.
		 * @param mixed $priority2 The priority of the second node being compared.
		 * @return boolean
		 */
		public function compare($priority1, $priority2)
		{
			if ($priority1 < $priority2) {
				return -1;
			} elseif ($priority1 == $priority2) {
				return 0;
			} else {
				return 1;
			}
		}

		/**
		 * Counts the number of elements in the queue.
		 *
		 * @return int
		 */
		public function count()
		{
			return count($this->heap);
		}

		/**
		 * Return current node pointed by the iterator.
		 *
		 * @return mixed
		 */
		public function current()
		{
			return $this->peek($this->iterator);
		}

		/**
		 * Extracts a node from top of the heap and sift up. O(log(N)) time
		 *
		 * @return mixed
		 */
		public function extract()
		{
			return $this->pop($this->heap);
		}

		/**
		 * Inserts an element in the queue by sifting it up. O(log(N)) time
		 *
		 * @param mixed $value
		 * @param mixed $priority
		 */
		public function insert($value, $priority)
		{
			$this->push($this->heap, $value, $priority);
		}

		/**
		 * Checks whether the queue is empty.
		 *
		 * @return bool
		 */
		public function isEmpty()
		{
			return (count($this->heap) == 0);
		}

		/**
		 * Return current node index.
		 *
		 * @return mixed
		 */
		public function key()
		{
			return 0;
		}

		/**
		 * Move to the next node.
		 */
		public function next()
		{
			$this->pop($this->iterator);
		}
		
		/**
		 * Recover from the corrupted state and allow further actions on the queue.
		 */
		public function recoverFromCorruption()
		{
		}

		/**
		 * Rewind iterator back to the start.
		 */
		public function rewind()
		{
			$this->iterator = $this->heap;
		}

		/**
		 * Sets the mode of extraction. Used by current(), extract(), and top().
		 * 
		 * @param int $flags
		 */
		public function setExtractFlags($flags)
		{
			$this->extract_flags = $flags;
		}

		/**
		 * Peaks at the node from the top of the queue.
		 *
		 * Constant time
		 *
		 * @return mixed
		 */
		public function top()
		{
			return $this->peek($this->heap);
		}

		/**
		 * Check whether the queue contains more nodes.
		 *
		 * @return bool
		 */
		public function valid()
		{
			return (count($this->iterator) > 0);
		}
		
		/**
		 *
		 */
		protected function peek(&$heap, $index=0, $flags=null)
		{
			if (count($heap) == 0) {
				return null;
			}

			$flags = ($flags === null ? $this->extract_flags : $flags);
			if ($flags == self::EXTR_DATA) {
				return $heap[$index][0];
			} elseif ($flags == self::EXTR_PRIORITY) {
				return $heap[$index][1];
			} else {
				return $heap[$index];
			}
		}
		
		/**
		 *
		 */
		protected function pop(&$heap)
		{
			if (count($heap) == 0) {
				return null;
			}

			$top = $this->peek($heap);
			$lastId = count($heap) - 1;
			$nodeId = 0;
			$childId = 1;

			if ($lastId > 2 && $this->compare($heap[2][1], $heap[1][1]) <= 0) {
				$childId = 2;
			}

			while ($childId < $lastId && $this->compare($heap[$childId][1], $heap[$lastId][1]) <= 0) {
				$heap[$nodeId] = $heap[$childId];
				$nodeId  = $childId;
				$childId = ($nodeId << 1) + 1;
				if (($childId+1) < $lastId && $this->compare($heap[$childId+1][1], $heap[$childId][1]) <= 0) {
					$childId++;
				}
			}

			$heap[$nodeId] = $heap[$lastId];
			unset($heap[$lastId]);

			return $top;
		}
		
		/**
		 *
		 */
		protected function push(&$heap, $value, $priority)
		{
			$nodeId = count($heap);
			$parentId = ($nodeId-1) >> 1;
			while ($nodeId != 0 && $this->compare($priority, $heap[$parentId][1]) <= 0) {
				$heap[$nodeId] = $heap[$parentId];
				$nodeId = $parentId;
				$parentId = ($nodeId-1) >> 1;
			}
			$heap[$nodeId] = array($value, $priority);
		}
	}
}
