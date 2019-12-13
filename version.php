<?php

$a_production = [
    'version_release'       => '0',
    'version_major'         => '27', # changes whenever any css,js,api,guest,user value below has changed; reset each realease
    'version_patch'         => '0',
    'version_stage'         => 'a', # a=alfa,b=beta,rc=candidate,r=release
    'version_day'           => '347',
    'version_seq'           => '1',
];

return (object) [

    'app'                   => $a_production['version_release'] . '.'
    . $a_production['version_major'] . '.'
    . $a_production['version_patch']
    . ($a_production['version_stage'] ? '+' : '')
    . $a_production['version_stage']
    . $a_production['version_day'] . ':'
    . $a_production['version_seq'],
    'release'               => $a_production['version_release'],
    'guest'                 => '0.00.0',
    'user'                  => '0.27.0',
    'unit'                  => '0.00.0',
    'api'                   => '0.00.0',
    'css'                   => '0.06.0',
    'js'                    => '0.04.1',
];
