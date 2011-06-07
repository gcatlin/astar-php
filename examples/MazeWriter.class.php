<?php

class MazeWriter
{

    var $maze;
    var $path;
    var $steps;
    var $time;

    function MazeWriter($maze, $path, $time = NULL)
    {
        $nodes = $maze->getNodes();
        $cols  = $maze->columns();
        $maze  = array();

        foreach ($nodes as $index => $element)
        {
            $x = (int) ($index/$cols);
            $y = $index % $cols;
            $maze[$x][$y] = ($element == ' ' && in_array($index, $path) ? 'X' : $element);
        }

        $this->maze  = $maze;
        $this->path  = $path;
        $this->steps = max(0, count($path)-1);
        $this->time  = (is_null($time) ? '???' : sprintf('%.3fs', $time));
    }

    function write($type)
    {
        switch ($type)
        {
            case 'image/png':
                $this->writePng();
                break;

            case 'text/html':
                $this->writeHtml();
                break;

            case 'text/plain':
            default:
                $this->writeText();
                break;
        }
    }

    function writeHtml()
    {
        $maze  = $this->maze;
        $rows = count($maze);
        $cols = count($maze[0]);

        $output  = '<font size="1" color="#000000">';
        $output .= 'Steps: '.$this->steps."<br>\n";
        $output .= 'Time:  '.$this->time."<br>\n<br>\n";
        $output .= '</font>';
        $output .= '<table bgcolor="#8C8C80" border="0" cellpadding="0" cellspacing="1">';

        for ($row = 0; $row < $rows; $row++)
        {
            $output .= '<tr>';
            for ($col = 0; $col < $cols; $col++)
            {
                switch ($maze[$row][$col])
                {
                    case 'W':
                        $output .= '<td bgcolor="#8C8C80" width="10" height="10"></td>';
                        break;

                    case 'S':
                        $output .= '<td bgcolor="#FF8080" width="10" height="10"><font size="1" color="#000000">S</font></td>';
                        break;

                    case 'E':
                        $output .= '<td bgcolor="#8080FF" width="10" height="10"><font size="1" color="#ffffff">E</font></td>';
                        break;

                    case 'X':
                        $output .= '<td bgcolor="#FFFF33" width="10" height="10"></td>';
                        break;

                    case ' ':
                        $output .= '<td bgcolor="#E0E0D8" width="10" height="10"></td>';
                        break;

                    default:
                        $output .= '<td bgcolor="#FFFFFF" width="10" height="10"><font size="1" color="#000000">'.$maze[$row][$col].'</font></td>';
                        break;
                }
            }
            $output .= '<tr>'."\n";
        }
        $output .= '</table>'."\n";

        header('Content-Type: text/html');
        echo $output;
    }

    function writePng()
    {
        $maze = $this->maze;
        $rows = count($maze);
        $cols = count($maze[0]);
        $tile = 10;
        $fs   = 2;
        $fh   = imagefontheight($fs);
        $fw   = imagefontwidth($fs);
        $fy   = $tile/2-$fh/2+1;
        $fx   = $tile/2-$fw/2+1;
        $offy = 3*$fh;

        $im = imagecreate(max($cols*$tile+1, $fw*14), $rows*$tile+1+$fh*3);
        $color = array(
            'white'  => imagecolorallocate($im, 255, 255, 255),
            'black'  => imagecolorallocate($im,   0,   0,   0),
            'lgray'  => imagecolorallocate($im, 224, 224, 216),
            'mgray'  => imagecolorallocate($im, 140, 140, 128),
            'pink'   => imagecolorallocate($im, 255, 128, 128),
            'purple' => imagecolorallocate($im, 128, 128, 255));

        if ($this->steps)
        {
            $g = array();
            $s = 204/$this->steps;
            foreach ($this->path as $step => $index)
            {
                $d = (int) ($step*$s);
                if (! in_array($d, $g))
                    $c = imagecolorallocate($im, 51+$d, 255, 255-$d);
                $color[$index] = $c;
                $g[] = $d;
            }
        }

        imagestring($im, $fs, 0, 0, 'Steps: '.$this->steps, $color['black']);
        imagestring($im, $fs, 0, $fh, 'Time:  '.$this->time, $color['black']);

        for ($row = 0; $row < $rows; $row++)
        {
            for ($col = 0; $col < $cols; $col++)
            {
                $id = $row*$cols+$col;
                $x1 = $col*$tile;
                $y1 = $row*$tile+$offy;
                $x2 = $x1+$tile-1;
                $y2 = $y1+$tile-1;
                $xf = $x1+$fx;
                $yf = $y1+$fy;
                imagefilledrectangle($im, $x1, $y1, $x2, $y2, $color['lgray']);
                imagerectangle($im, $x1, $y1, $x2+1, $y2+1, $color['mgray']);

                switch ($maze[$row][$col])
                {
                    case 'W':
                        imagefilledrectangle($im, $x1+1, $y1+1, $x2, $y2, $color['mgray']);
                        break;

                    case 'S':
                        imagefilledrectangle($im, $x1+1, $y1+1, $x2, $y2, $color['pink']);
                        imagestring($im, $fs, $xf, $yf, 'S', $color['black']);
                        break;

                    case 'E':
                        imagefilledrectangle($im, $x1, $y1+1, $x2, $y2, $color['purple']);
                        imagestring($im, $fs, $xf, $yf, 'E', $color['white']);
                        break;

                    case 'X':
                        imagefilledrectangle($im, $x1+1, $y1+1, $x2, $y2, $color[$id]);
                        break;

                    case ' ':
                        break;

                    default:
                        imagefilledrectangle($im, $x1, $y1, $x2+1, $y2+1, $color['white']);
                        imagestring($im, $fs, $xf, $yf, $maze[$row][$col], $color['black']);
                        break;
                }
            }
        }
        header('Content-Type: image/png');
        imagepng($im);
    }

    function writeText()
    {
        $maze  = $this->maze;

        $output  = "Steps: ".$this->steps."\n";
        $output .= "Time:  ".$this->time."\n\n";
        foreach ($maze as $row)
        {
            foreach ($row as $cell)
                $output .= $cell;
            $output .= "\n";
        }

        header('Content-Type: text/plain');
        echo $output;
    }

}

?>
