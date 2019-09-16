<?php
$command = 'git pull git@github.com:jenswittmann/zeigwasdumachst.git';
exec($command.' 2>&1', $tmp, $return_code);
?>
$ <?php echo $command; ?>: <?php echo implode("\n", $tmp); ?>

