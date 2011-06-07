<?php

/**
 * References:
 *   o http://www.gamasutra.com/features/19970801/pathfinding.htm
 *   o http://www.wikipedia.org/wiki/A-star_search_algorithm
 *   o http://theory.stanford.edu/~amitp/GameProgramming/
 *   o http://www.geocities.com/SiliconValley/Lakes/4929/astar.html
 *   o http://gamedev.net/reference/list.asp?categoryid=18#94
 *   o http://www.policyalmanac.org/games/aStarTutorial.htm
 *   o http://www.policyalmanac.org/games/binaryHeaps.htm
 *   o http://rajiv.macnn.com/tut/search.html
 *   o http://www.aiguru.com/pathfinding.htm
 *   o http://www.cs.montana.edu/~charon/thesis/tutorials/a-star.php
 *   o http://www.student.nada.kth.se/~f93-maj/pathfinder/index.html
 */
class AStarSolver
{
	/**
	 *
	 */
	public function solve($graph, $s) {
		$o = new SplPriorityQueue();
		$l = array();
		$c = array();
		$p = array();
		$a = $s->getStartIndex();
		$z = $s->getGoalIndex();
		$d = $s->goalDistance($a);

		$n0 = array('g'=>0, 'h'=>$d, 'i'=>$a, 'p'=>NULL, 'f'=>$d);
		$o->insert($n0, -$d);
		$l[$a] = TRUE;

		while (! $o->isEmpty()) {
			$n = $o->extract();

			if ($n['i'] == $z) {
				while ($n) {
					$p[] = $n['i'];
					$n = $n['p'];
				}
				break;
			}

			foreach ($s->getNeighbors($n['i']) as $j => $w) {
				if ((isset($l[$j]) || isset($c[$j])) && isset($m) && $m['g'] <= $n['g']+$w) {
					continue;
				}

				$d = $s->goalDistance($j);
				$m = array('g'=>$n['g']+$w, 'h'=>$d, 'i'=>$j, 'p'=>$n, 'f'=>$n['g']+$w+$d);

				if (isset($c[$j])) {
					unset($c[$j]);
				}

				if (!isset($l[$j])) {
					$o->insert($m, -$m['f']);
					$l[$j] = TRUE;
				}
			}
			$c[$n['i']] = $n;
		}
		return $p;
	}
}
