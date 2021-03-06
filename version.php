<?php

$a_production = [
    'version_release'       => '0',
    'version_leader'        => '99', # changes whenever any css,js,api,guest,user value below has changed; reset each realease
    'version_patch'         => '2',
    'version_maturity'      => 'a', # a=alfa,b=beta,rc=candidate,r=release,sr=service release
    'version_day'           => '357',
    'version_seq'           => '1',
];

return (object) [

    'app'                   => $a_production['version_release'] . '.'
    . $a_production['version_leader'] . '.'
    . $a_production['version_patch']
    . ($a_production['version_maturity'] ? '+' : '')
    . $a_production['version_maturity']
    . $a_production['version_day'] . ':'
    . $a_production['version_seq'],
    'release'               => $a_production['version_release'],
    'guest'                 => '0.20.2',
    'user'                  => '0.79.3',
    'test'                  => '0.00.0',
    'api'                   => '0.00.0',
    'css'                   => '0.40.0',
    'js'                    => '0.72.1',
];
