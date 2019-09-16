<?php

# blacklist datei holen
$blacklist = json_decode( file_get_contents('blacklist.json'), true );

# id ergänzen
$blacklist[] = $_GET['id'];

# blacklist abspeichern
file_put_contents('blacklist.json', json_encode($blacklist) );