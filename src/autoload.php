<?php

spl_autoload_register(function (string $className) {
    // Si la classe ne commence pas par 'App\' -> on sait pas où est le fichier
    if (0 !== strpos($className, 'App\\')) {
        return;
    }

    // ('App\GameSlot' -> '../src/GameSlot').php

    require_once str_replace('App\\', '../src/', $className).'.php';
});
