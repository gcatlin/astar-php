<?php

set_include_path(get_include_path().PATH_SEPARATOR.dirname(__FILE__).'/classes');
require_once('AStarSolver.class.php');
require_once('MazeReader.class.php');
require_once('MazeWriter.class.php');
require_once('Timer.class.php');

if ($_REQUEST)
{
    if ($_FILES['custom']['tmp_name'])
        $file = $_FILES['custom']['tmp_name'];
    elseif ($_REQUEST['default'])
        $file = dirname(__FILE__).'/mazes/'.str_replace(array('..','/','\\'), '', $_REQUEST['default']);

    if (file_exists($file))
    {
        $time = new Timer();
        $mrdr = new MazeReader($file);
        $maze = $mrdr->read();
        $path = AStarSolver::solve($maze);
        $mwrt = new MazeWriter($maze, $path, $time->elapsed());
        $outp = $mwrt->write($_REQUEST['type']);
        exit;
    }
}

?>
