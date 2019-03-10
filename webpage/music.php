<?php

$files = scandir('songs');
$files = array_diff(scandir('songs'), array('.', '..'));

if (isset($_REQUEST['playlist']) and file_exists("songs/$_REQUEST[playlist]")) {
    $playlist = file_get_contents("songs/$_GET[playlist]");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
        "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Music Viewer</title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    <link href="viewer.css" type="text/css" rel="stylesheet"/>
</head>
<body>
<div id="header">

    <h1>190M Music Playlist Viewer</h1>
    <h2>Search Through Your Playlists and Music</h2>
</div>


<div id="listarea">
    <ul id="musiclist">
        <?php if ($playlist != ''): ?>
            <?php foreach ($files as $file): ?>
                <?php if (strpos($file, '.mp3') AND strpos($playlist, $file)): ?>
                    <li class="mp3item">
                        <a href="songs/<?= $file ?>"><?= $file ?></a>
                        <?php $filesize = filesize("songs/$file"); ?>
                        <?php if ($filesize >= 0 AND $filesize < 1024): ?>
                            (<?= $filesize ?> b)
                        <?php elseif ($filesize >= 1024 AND $filesize < 1048576): ?>
                            (<?= round($filesize / 1024, 2) ?> Kb)
                        <?php elseif ($filesize >= 1048576): ?>
                            (<?= round($filesize / 1024 / 1024, 2) ?> Mb)
                        <?php endif; ?>                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <?php foreach ($files as $file): ?>
                <?php if (strpos($file, 'mp3')): ?>
                    <li class="mp3item">
                        <a href="songs/<?= $file ?>"><?= $file ?></a>
                        <?php $filesize = filesize("songs/$file"); ?>
                        <?php if ($filesize >= 0 AND $filesize < 1024): ?>
                            (<?= $filesize ?> b)
                        <?php elseif ($filesize >= 1024 AND $filesize < 1048576): ?>
                            (<?= round($filesize / 1024, 2) ?> Kb)
                        <?php elseif ($filesize >= 1048576): ?>
                            (<?= round($filesize / 1024 / 1024, 2) ?> Mb)
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php foreach ($files as $file): ?>
                <?php if (strpos($file, 'txt')): ?>
                    <li class="playlistitem">
                        <a href="songs/<?= $file ?>"><?= $file ?></a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
    </ul>
</div>
</body>
</html>
