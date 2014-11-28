<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */




return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Client\Controller',
                        'controller'    => 'Client',
                        'action'        => 'home',
                    ),
                ),
            ),
            'client' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/client[/:action]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Client\Controller',
                        'controller'    => 'Client',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'register' => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/register',
                            'defaults' => array(
                                'action'        => 'register',
                            ),
                        ),
                    ),
                    'login' => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/login',
                            'defaults' => array(
                                'action'        => 'login',
                            ),
                        ),
                    ),
                    'logout' => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/logout',
                            'defaults' => array(
                                'action'        => 'logout',
                            ),
                        ),
                    ),
                    'groups' => array(
                        'type'    => 'literal',
                        'options' => array(
                            'route'    => '/groups',
                            'defaults' => array(
                                'action'        => 'groups',
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
//         'aliases' => array(
//             'translator' => 'MvcTranslator',
//         ),
        'factories' => array(
            'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory', 
        ),
    ),
    'translator' => array(
        'locale' => 'de_DE',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Client\Controller\Client' => 'Client\Controller\ClientController',
            'Client\Controller\Group' => 'Client\Controller\GroupController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'client/index/index'      => __DIR__ . '/../view/client/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
    
//     //Navigation
//     'navigation' => array(
//         'default' => array(
//             array(
//                 'label' => 'Home',
//                 'route' => 'home',
//             ),
//             array(
//                 'label' => 'Client',
//                 'route' => 'client',
//                 'pages' => array(
//                     array(
//                         'label' => 'index',
//                         'route' => 'client',
//                         'action' => 'index',
//                     ),
//                     array(
//                         'label' => 'Edit',
//                         'route' => 'client',
//                         'action' => 'test2',
//                     ),
//                     array(
//                         'label' => 'Delete',
//                         'route' => 'client',
//                         'action' => 'test3',
//                     ),
//                 ),
//             ),
//             array(
//                 'label' => 'Server',
//                 'route' => 'services',
//                 'pages' => array(
//                     array(
//                         'label' => 'Server',
//                         'route' => 'services',
//                         'action' => 'index',
//                     ),
//                     array(
//                         'label' => 'serverGetwsdl',
//                         'route' => 'services',
//                         'action' => 'index?wsdl',
//                     ),
//                     array(
//                         'label' => 'wsdl',
//                         'route' => 'services',
//                         'action' => 'wsdl',
//                     ),
//                 ),
//             ),

            
//         ),
//     ),
//     //---Navigation
);
