<?php

declare(strict_types=1);

use Application\Form\MeetupForm;
use Zend\Router\Http\Literal;
use Application\Controller;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'router' => [
        'routes' => [
            'home' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'add' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => 'new',
                            'defaults' => [
                                'action'     => 'add',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\IndexControllerFactory::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            MeetupForm::class => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'application/index/add' => __DIR__ . '/../view/application/index/add.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
      'driver' => [
          // defines an annotation driver with two paths, and names it `my_annotation_driver`
          'application_driver' => [
              'class' => \Doctrine\ORM\Mapping\Driver\AnnotationDriver::class,
              'cache' => 'array',
              'paths' => [
                  __DIR__.'/../src/Entity/',
              ],
          ],

          // default metadata driver, aggregates all other drivers into a single one.
          // Override `orm_default` only if you know what you're doing
          'orm_default' => [
              'drivers' => [
                  // register `application_driver` for any entity under namespace `Application\Entity`
                  'Application\Entity' => 'application_driver',
              ],
          ],
      ],
  ],
];
