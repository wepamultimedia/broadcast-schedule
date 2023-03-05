<?php

// config for Wepa/BroadcastSchedule
return [
    'backend_menu' => [
        [
            'label' => 'en:Broadcast Schedule|es:Calendario de emisiones',
            'icon' => 'calendar',
            'route' => '#',
            'active' => 'admin.broadcast-schedule*',
            'can' => 'admin.auth',
            'children' => [
                [
                    'label' => 'en:Programs|es:Programas',
                    'route' => 'admin.broadcast-schedule.programs.index',
                    'active' => 'admin.broadcast-schedule.programs*',
                    'can' => 'admin.auth',
                ],
                [
                    'label' => 'en:Calendar|es:Calendario',
                    'route' => 'admin.broadcast-schedule.calendars.index',
                    'active' => 'admin.broadcast-schedule.calendars*',
                    'can' => 'admin.auth',
                ],
            ],
        ],
    ],
];
