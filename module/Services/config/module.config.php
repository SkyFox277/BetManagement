<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Services\Controller\Services' => 'Services\Controller\ServicesController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'services' => array(
                'type'    => 'literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/services',
//                     [/][:action]',
//                     'constraints' => array(
//                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
//                     ),
                    
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'Services\Controller',
                        'controller'    => 'Services',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Services' => __DIR__ . '/../view',
        ),
    ),
);
