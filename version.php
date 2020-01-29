<?php

$a_production = [
    'version_release'       => '0',
    'version_major'         => '73', # changes whenever any css,js,api,guest,user value below has changed; reset each realease
    'version_patch'         => '0',
    'version_stage'         => 'a', # a=alfa,b=beta,rc=candidate,r=release
    'version_day'           => '029',
    'version_seq'           => '4',
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
    'guest'                 => '0.07.0',
    'user'                  => '0.66.0',
    'unit'                  => '0.00.0',
    'api'                   => '0.00.0',
    'css'                   => '0.13.0',
    'js'                    => '0.21.0',
];
