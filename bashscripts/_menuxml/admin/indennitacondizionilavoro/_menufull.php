<?php

declare(strict_types=1);

if (! isset($route_params)) {
    $route_params = [];
}

return [
    0 => [
        (object) [
            'id' => '2',
            'nome' => 'Cond Lavoro + Serv Esterno',
            'visibility' => '1',
            'active' => 0,
            'url' => '#',
        ],
        /*(object) [
            'id' => '1',
            'nome' => 'Responsabilita',
            'visibility' => '1',
            'active' => 0,
            'url' => '#',
        ],
        */
    ],

    /*1 => [
        (object) [
            'id' => '11',
            'nome' => 'Lett F',
            'visibility' => '1',
            'active' => 0,
            'routename' => '',
            'url' => route('admin.containers.index', array_merge($route_params, ['container0' => 'lett_f', 'lang' => 'it'])),
        ],
        (object) [
            'id' => '12',
            'nome' => 'Lett I',
            'visibility' => '1',
            'active' => 0,
            'routename' => '',
            'url' => route('admin.containers.index', array_merge($route_params, ['container0' => 'lett_i', 'lang' => 'it'])),
        ],
    ],
    */
    2 => [
        (object) [
            'id' => '21',
            'nome' => 'Condizioni Lavoro',
            'visibility' => '1',
            'active' => 0,
            'routename' => '',
            'url' => route('admin.containers.index', array_merge($route_params, ['container0' => 'condizioni_lavoro_rep', 'lang' => 'it'])),
        ],
        (object) [
            'id' => '22',
            'nome' => 'Servizio Esterno',
            'visibility' => '1',
            'active' => 0,
            'routename' => '',
            'url' => route('admin.containers.index', array_merge($route_params, ['container0' => 'servizio_esterno_rep', 'lang' => 'it'])),
        ],
    ],
];
