<?php require_once('../../inc/application.inc.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/Level2.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <meta http-equiv="Content-Language" content="en-us" />
    <meta name="Copyright" content="Copyright (c) 2004 codezilla" />
<!-- InstanceBeginEditable name="Meta Information" -->
<meta name="description" content="" />
<meta name="keywords" content="" />
<!-- InstanceEndEditable -->
    <meta name="Robots" content="all" />
    <meta name="MSSmartTagsPreventParsing" content="true" />
<!-- InstanceBeginEditable name="Document Title" -->
<title>A* (A-Star) PHP Project</title>
<!-- InstanceEndEditable -->
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon" />
    <style type="text/css" media="all">@import "/css/bluezeld.css";</style>
<!-- InstanceBeginEditable name="Document Head" -->
<style type="text/css" media="all">@import "/css/bluezeld-projects.css";</style>
<!-- InstanceEndEditable -->
</head>
<body>

<div id="header"><span class="hidden">codezilla.com. PHP programmer extraordinaire.</span></div>

<div id="skipNav"><a href="#content" title="Skip navigation">Skip navigation</a>.</div>

<div id="menu">
    <div id="nav">
        <ul>
            <li>Explore:</li>
            <li id="home"><a href="/" title="">Home</a></li>
            <li id="portfolio"><a href="/portfolio.php" title="">Portfolio</a></li>
            <li id="projects"><a href="/projects.php" title="">Projects</a></li>
            <li id="contact"><a href="/contact.php" title="">Contact</a></li>
        </ul>
    </div>
<!--
    <div id="searchForm">
        <form method="get" action="/search/">
            <label for="q">Search:</label><br />
            <input type="text" value="" name="q" class="query" size="10" title="Type your search terms here." />
            <input type="submit" value="Go!" class="butt" title="" />
        </form>
    </div>
-->
</div>

<div id="content">
<!-- InstanceBeginEditable name="Content Area" -->
<h1><img src="/images/headers/a-star.gif" width="400" height="110" border="0" alt="PHP A*" /></h1>

<h3>NOTE</h3>
<p>I originally developed this for the <a href="http://codewalkers.com/contests/2002-05-13/" target="_blank">Codewalkers "Shortest Path Through a Maze" Contest</a>. I'm in the process of making this page more oriented towards A* and less towards the contest.</p>
<p>Download the <a href="a-star.zip">source code</a> (.zip).</p>
<p>The original page can be found <a href="archived/">here</a>.</p>

<h3>See it in Action</h3>
<form action="output.php" enctype="multipart/form-data" method="post">
    <p>
        <label>Default Maze:
        <select name="default">
            <option value="big.txt">big</option>
            <option value="crazy.txt">crazy</option>
            <option value="cw.txt" selected="selected">cw</option>
            <option value="nopath.txt">nopath</option>
            <option value="open.txt">open</option>
            <option value="tiny.txt">tiny</option>
            <option value="maze1.txt">maze1</option>
            <option value="maze2.txt">maze2</option>
            <option value="maze3.txt">maze3</option>
            <option value="maze4.txt">maze4</option>
            <option value="maze5.txt">maze5</option>
            <option value="maze6.txt">maze6</option>
            <option value="maze7.txt">maze7</option>
            <option value="maze8.txt">maze8</option>
        </select></label>
    </p>
    <p>
        <label>Custom Maze: <input type="file" name="custom"></label>
    </p>
    <p>
        <label>Output Format:
        <select name="type">
            <option value="text/html">HTML</option>
            <option value="text/plain">Text</option>
            <option value="image/png" selected="selected">PNG</option>
        </select></label>
    </p>
    <p>
        <input type="submit" value="Find Shortest Path &gt;&gt;">
    </p>
</form>

<h3>A* Resources</h3>
<p>Here are some great resources that I used to develop my implementation of the A* algorithm:</p>
<ul>
    <li><a href="http://www.gamasutra.com/features/19970801/pathfinding.htm" target="_blank" title="">Smart Moves: Intelligent Pathfinding</a></li>
    <li><a href="http://en.wikipedia.org/wiki/A-star_search_algorithm" target="_blank" title="">A-star search algorithm - Wikipedia</a></li>
    <li><a href="http://theory.stanford.edu/~amitp/GameProgramming/" target="_blank" title="">Amit's Thoughts on Path-Finding and A-Star</a></li>
    <li><a href="http://www.geocities.com/SiliconValley/Lakes/4929/astar.html" target="_blank" title="">A* Algorithm Tutorial</a></li>
</ul>

<!-- InstanceEndEditable -->
</div>

<div id="footer">
    Copyright &copy; 2004 <a href="http://codezilla.com">codezilla</a>. This page may contain: <a href="http://validator.w3.org/check/referer">XHTML</a>, <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a>,  <a href="http://www.contentquality.com/mynewtester/cynthia.exe?Url1=http://codezilla.com/">508</a>. Stylesheet stolen from <a href="http://www.zeldman.com/">Zeldman</a>.<br />
    <timingbufferingfilter />
    <pagecachingfilter />
</div>

</body>
<!-- InstanceEnd --></html>
