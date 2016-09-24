<?php
ini_set('xdebug.var_display_max_depth', 5);
ini_set('xdebug.var_display_max_children', 256);
ini_set('xdebug.var_display_max_data', 1024);
            
return [
    'version' => '1.0.0',
    'nombre' => 'prax-sys',
    'charset' => 'utf-8',
    'modoProduccion' => false,
    'apacheRewrite' => true,
    'tema' => 's-admin',
    'importar' => [
        '!aplicacion.modelos',
        '!aplicacion.componentes',
    ],
    'modulos' => [
        'codegen' => [
            'ruta' => '!web.modulos.codegen',
            'clase' => 'codeGen',
            'controladorPorDefecto' => 'generador',
            'usuario' => 'praxis',
            'clave' => 'praxis-dev',
        ],
    ],
    'componentes' => [
        'bd' => [
            'driver' => 'mysql',
            'servidor' => '127.0.0.1',
            'usuario' => 'pdeveloper',
            'clave' => 'pr@x1sdev',
            'bd' => 'prax_sys_dev',
            'prefijo' => 'tbl_',
            'charset' => 'utf8',
            'procedimientos' => false,
        ],
        'usuario' => [
            'ruta' => '!aplicacion.componentes',
            'clase' => 'ComUsuario',
        ],
        'JMail' => [
            'ruta' => '!aplicacion.componentes',
            'clase' => 'JMail',
            'emailAdmin' => 'info@jakolab.com',
        ]
    ],
    
    'disparadores' => [
        'iniControlador' => [
            [
                'ruta' => '!aplicacion.componentes',
                'clase' => 'Permisos',
            ],
        ],
    ],   
    
    'extensiones' => [
        'mpdf' => [
            'ruta' => '!ext.MPDF',
            'clase' => 'MpdfExt',
        ],
    ],
];
