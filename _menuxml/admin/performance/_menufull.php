<?php

declare(strict_types=1);

if (! isset($route_params)) {
    $route_params = [];
}

return [
    0 => [
        (object) [
            'id' => '1',
            'nome' => 'Performance',
            'visibility' => '1',
            'active' => 0,
            'url' => '#',
        ],
        /*
    (object)[
    'id'=>'2',
    'nome'=>'Autorizzatore',
    'visibility'=>'2',
    'active'=>0,
    'url'=>'#',
    ],
     */
    ],
    1 => [
        (object) [
            'id' => '11',
            'nome' => 'Individuale Dipendenti',
            'visibility' => '1',
            'active' => 0,
            'routename' => '',
            'url' => route('admin.containers.index', array_merge($route_params, ['container0' => 'individuale_dip', 'lang' => 'it'])),
        ],
        (object) [
            'id' => '12',
            'nome' => 'Individuale Regionali',
            'visibility' => '1',
            'active' => 0,
            'routename' => '',
            'url' => route('admin.containers.index', array_merge($route_params, ['container0' => 'individuale_regionale', 'lang' => 'it'])),
        ],
        (object) [
            'id' => '13',
            'nome' => 'Individuale Po',
            'visibility' => '1',
            'active' => 0,
            'routename' => '',
            'url' => route('admin.containers.index', array_merge($route_params, ['container0' => 'individuale_po', 'lang' => 'it'])),
        ],
    ],
];
