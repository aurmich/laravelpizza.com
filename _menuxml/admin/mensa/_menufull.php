<?php

declare(strict_types=1);

if (! isset($route_params)) {
    $route_params = [];
}

return [
    0 => [
        (object) [
            'id' => '1',
            'nome' => 'Mensa',
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
    /*
    1=>[
        (object)[
            'id'=>'11',
            'nome'=>'Schede',
            'visibility'=>'1',
            'active'=>0,
            'routename'=>'',
            'url'=>route('admin.containers.index',array_merge($route_params,['container0'=>'schede','lang'=>'it'])),
        ],
    ],
    */
];
