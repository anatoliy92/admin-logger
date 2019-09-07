<?php

return [

    /**
     * Middleware
     */
    'middleware' => ['web', 'admin'],

		'host' => env('APP_CT_DOMAIN', $_SERVER['HTTP_HOST'] ?? null),

    'url' => ['admin/*'],

    /* Кол-во записей на страницу */
    'countPage' => 30,

    /**
     * List of models and observers
     * Sample instructions:
     *
     * App\Model::class => \App\Observers\ModelObserver::class
     */
    'observers' => [
      App\Models\Sections::class  => \Avl\AdminLogger\Observers\SectionsObserver::class,
      App\Models\Roles::class     => \Avl\AdminLogger\Observers\RolesObserver::class,
      App\Models\User::class      => \Avl\AdminLogger\Observers\UserObserver::class,
      App\Models\Langs::class     => \Avl\AdminLogger\Observers\LangsObserver::class,
      App\Models\Templates::class => \Avl\AdminLogger\Observers\TemplatesObserver::class,
      App\Models\Settings::class  => \Avl\AdminLogger\Observers\SettingsObserver::class,
      App\Models\Rubrics::class   => \Avl\AdminLogger\Observers\RubricsObserver::class,
    ],

    /**
     * Badge
     */
    'events' => [
      'creating' => '<span class="badge badge-success">creating</span>',
      'updating' => '<span class="badge badge-warning">updating</span>',
      'deleting' => '<span class="badge badge-danger">deleting</span>',
    ],

    'modelsNames' => [
      'App\Models\Sections' => 'Структура',

      'App\Models\Roles' => 'Роли',
      'App\Models\User' => 'Пользователи',
      'App\Models\Langs' => 'Настройка языков',
      'App\Models\Templates' => 'Настройка шаблонов',

      'App\Models\Settings' => 'Настройки сайта',
      'App\Models\Rubrics' => 'Настройка рубрик',
    ]

];
