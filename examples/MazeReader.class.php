<?php

class MazeReader
{

    var $file;

    function MazeReader($filename)
    {
        $this->file = $filename;
    }

    function read()
    {
        $lines = @file($this->file);
        foreach ($lines as $i => $line)
            $lines[$i] = preg_split('//', trim($line), -1, PREG_SPLIT_NO_EMPTY);

        include_once('Maze.class.php');
        $rows = count($lines);
        $cols = count($lines[0]);
        $maze = new Maze($cols);

        for ($x=0, $i=0; $x < $rows; $x++)
        {
            for ($y=0; $y < $cols; $y++, $i++)
            {
                $cell = (isset($lines[$x][$y]) ? $lines[$x][$y] : NULL);
                $maze->addNode($i, $cell);
                if ($cell != 'W')
                {
                    if ($cell == 'S')
                        $maze->setStartNode($i);

                    if ($cell == 'E')
                        $maze->setGoalNode($i);

                    if (! empty($lines[$x+1][$y]))
                        $maze->addEdge($i, $i+$cols, 1);

                    if (! empty($lines[$x][$y+1]))
                        $maze->addEdge($i, $i+1, 1);

                    if (! empty($lines[$x-1][$y]))
                        $maze->addEdge($i, $i-$cols, 1);

                    if (! empty($lines[$x][$y-1]))
                        $maze->addEdge($i, $i-1, 1);
                }
            }
        }

        return $maze;
    }

}

?>
