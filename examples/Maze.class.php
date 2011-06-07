<?php

require_once('Space.class.php');

class Maze extends Space
{

    var $cols;
    var $goalX;
    var $goalY;
    var $startX;
    var $startY;

    function Maze($cols=1)
    {
        parent::Space();
        $this->cols = max(1, $cols);
    }

    function columns()
    {
        return $this->cols;
    }

    function goalDistance($index)
    {
        $x = (int) ($index / $this->cols);
        $y = $index % $this->cols;
        return abs($x-$this->goalX) + abs($y-$this->goalY);
    }

    function setGoalNode($index)
    {
        parent::setGoalNode($index);
        $this->goalX  = (int) ($index / $this->cols);
        $this->goalY  = $index % $this->cols;
    }

    function setStartNode($index)
    {
        parent::setStartNode($index);
        $this->startX = (int) ($index / $this->cols);
        $this->startY = $index % $this->cols;
    }

}

?>
