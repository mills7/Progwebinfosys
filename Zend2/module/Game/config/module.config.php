<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

return array(
    'controllers' => array(
        'invokables' => array(
            'Game\Controller\Game' => 'Game\Controller\GameController',
        ),
    ),
	// The following section is new and should be added to your file
	'router' => array(
			'routes' => array(
					'home' => array(
							'type' => 'Zend\Mvc\Router\Http\Literal',
							'options' => array(
									'route'    => '/',
									'defaults' => array(
											'controller' => 'Game\Controller\Game',
											'action'     => 'index',
									),
							),
					),
					'game' => array(
							'type'    => 'segment',
							'options' => array(
									'route'    => '/game[/][:action][/:hash]',
									'constraints' => array(
											'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
											'hash'     => '[a-zA-Z0-9_-]*',
									),
									'defaults' => array(
											'controller' => 'Game\Controller\Game',
											'action'     => 'index',
									),
							),
					),
			),
	),
		
    'view_manager' => array(
        'template_path_stack' => array(
            'game' => __DIR__ . '/../view',
        ),
    ),
    'session' => array(
    		'remember_me_seconds' => 2419200,
    		'use_cookies' => true,
    		'cookie_httponly' => true,
    ),
);