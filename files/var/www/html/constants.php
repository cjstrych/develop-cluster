<?php

/*
 * Copyright (c) 2004-2018 Bright Computing Holding BV. All Rights Reserved.
 *
 * This software is the confidential and proprietary information of
 * Bright Computing Holding BV ("Confidential Information").  You shall not
 * disclose such Confidential Information and shall use it only in
 * accordance with the terms of the license agreement you entered into
 * with Bright Computing Holding BV or its subsidiaries.
 */

$contents = shell_exec('head -n1 /etc/cm-release');
$version = str_replace('Cluster Manager v', '', $contents);
$settings = array();

$settings['base-view'] = [
  'image'       => './img/base-view-logo-white.svg',
  'title'       => 'Base View',
  'description' => 'The web application for cluster management in Base Command Manager.',
  'color'       => ' grey',
  'btn-color'   => ' grey lighten-1',
  'btn-icon'    => 'add',
  'img-class'   => ' disabled',
  //'url'         => 'https://' . $_SERVER['SERVER_NAME'] . ':8081/base-view',
  'url'         => 'https://' . $_SERVER['SERVER_NAME'] . ':20443/base-view',
];

if (is_dir('base-view')) {
  $settings['base-view'] = array_merge($settings['base-view'], [
    'color' => ' blue darken-1',
    'btn-color' => ' blue',
    'btn-icon' => 'link',
    'img-class' => '',
  ]);
}

if (is_dir('base-view-ng')) {
  $settings['base-view-ng'] = [
      'image' => './img/base-view-logo-white.svg',
      'title' => 'Base View NG',
      'description' => 'The new generation of web application for cluster management in Base Command Manager.',
      //'url' => 'https://' . $_SERVER['SERVER_NAME'] . ':8081/base-view-ng',
      'url' => 'https://' . $_SERVER['SERVER_NAME'] . ':20443/base-view-ng',
      'color' => ' blue darken-1',
      'btn-color' => ' blue',
      'btn-icon' => 'link',
      'img-class' => '',
  ];
}

$settings['cm-api-docs'] = [
  'image'       => './img/nvidia-logo-white.svg',
  'title'       => 'CM API Docs',
  'description' => 'Cluster Manager API documentation.',
  'color'     => ' grey',
  'btn-color' => ' grey lighten-1',
  'btn-icon'  => 'add',
  'img-class' => ' disabled',
];

if (is_dir('cm-api-docs')) {
  $settings['cm-api-docs'] = array_merge($settings['cm-api-docs'], [
    'color'     => ' green darken-1',
    'btn-color' => ' green',
    'btn-icon'  => 'link',
    'img-class' => '',
    //'url'       => 'https://' . $_SERVER['SERVER_NAME'] . ':8081/api',
    'url'       => 'https://' . $_SERVER['SERVER_NAME'] . ':20443/api/',
  ]);
}

$settings['userportal'] = [
  'image'       => './img/nvidia-logo-white.svg',
  'title'       => 'User Portal',
  'description' => 'View the state of the cluster. This interface presents data about the system.',
  'color'     => ' grey',
  'btn-color' => ' grey lighten-1',
  'btn-icon'  => 'add',
  'img-class' => ' disabled',
];

if (is_dir('userportal')) {
  $settings['userportal'] = array_merge($settings['userportal'], [
    'color'     => ' green darken-1',
    'btn-color' => ' green',
    'btn-icon'  => 'link',
    'img-class' => '',
    //'url'       => 'https://' . $_SERVER['SERVER_NAME'] . ':8081/userportal',
    'url'       => 'https://' . $_SERVER['SERVER_NAME'] . ':20443/userportal',
  ]);
}

foreach ([
  'kubernetes/dashboard',
  'kubernetes/runai',
  'kubernetes/grafana',
  'mission-control/autonomous-hardware-recovery',
] as $path) {
  if (!is_dir($path)) { continue; }
  $files = [];
  foreach (new DirectoryIterator($path) as $fileinfo) {
    if ($fileinfo->isDot()) { continue; }
    $files[] = $path . '/' . $fileinfo->getFilename();
  }
  foreach ($files as $file) {
    $contents = str_replace('$HTTP_HOST', $_SERVER['HTTP_HOST'], file_get_contents($file));
    $data = json_decode($contents, true);
    $index = $data['type'] . '-' . $file;
    $settings[$index] = [
        'image'       => $data['image'],
        'title'       => $data['title'] . (count($files) > 1 ? ' ' . $data['subtitle'] : ''),
        'description' => $data['description'],
        'color'       => ' ' . $data['color'],
        'btn-color'   => ' ' . $data['btn-clr'],
        'btn-icon'    => $data['btn-icon'],
        'img-class'   => $data['img-class'],
        'url'         => $data['url'],
        'type'        => isset($data['type']) ? $data['type'] : '',
    ];
    if ($data['img-class'] === 'disabled') {
        $settings[$index] = array_merge($settings[$index], [
            'color'     => ' grey',
            'btn-color' => ' grey lighten-1',
            'btn-icon'  => 'add',
            'img-class' => ' disabled',
        ]);
    }
  }
}
