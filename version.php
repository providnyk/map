<?php

$a_production = [
    'version_release'       => '1',
    'version_major'         => '64', # value changes whenever any css,js,api,admin,user value below has changed; reset each realease
    'version_patch'         => '0',
    'version_type'          => 'release', # preRelease, e.g. 'beta.4'
    'version_build'         => '91205', # YMMDD
];

return (object) [

    'app'               => $a_production['version_release'] . '.'
                            .$a_production['version_major'] . '.'
                            .$a_production['version_patch'] . '-'
                            .$a_production['version_type'] . '+'
                            .$a_production['version_build'],
    'admin'             => '1.21.0',
    'user'              => '1.43.0',
    'unit'              => '0.0.0',
    'api'               => '1.0.0',
    'css'               => '1.25.0',
    'js'                => '1.2.0',
];

/*

#dd($items->toSql(), $items->getBindings());

*/
