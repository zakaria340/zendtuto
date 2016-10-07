<?php

return array(
  'service_manager' => array(
    'factories' => array(
      'Blog\Mapper\PostMapperInterface'   => 'Blog\Factory\ZendDbSqlMapperFactory',
      'Blog\Service\PostServiceInterface' => 'Blog\Factory\PostServiceFactory',
      'Zend\Db\Adapter\Adapter'           => 'Zend\Db\Adapter\AdapterServiceFactory',
    ),
  ),
  'view_manager'    => array(
    'template_path_stack' => array(
      __DIR__ . '/../view',
    ),
  ),
  'controllers'     => array(
    'factories' => array(
      'Blog\Controller\List'  => 'Blog\Factory\ListControllerFactory',
      'Blog\Controller\Write' => 'Blog\Factory\WriteControllerFactory',
      'Blog\Controller\Delete' => 'Blog\Factory\DeleteControllerFactory'
    ),
  ),
  // This lines opens the configuration for the RouteManager
  'router'          => array(
    'routes' => array(
      'blog' => array(
        'type'          => 'literal',
        'options'       => array(
          'route'    => '/blog',
          'defaults' => array(
            'controller' => 'Blog\Controller\List',
            'action'     => 'index',
          ),
        ),
        'may_terminate' => TRUE,
        'child_routes'  => array(
          'detail' => array(
            'type'    => 'segment',
            'options' => array(
              'route'       => '/:id',
              'defaults'    => array(
                'action' => 'detail',
              ),
              'constraints' => array(
                'id' => '[1-9]\d*',
              ),
            ),
          ),
          'add'    => array(
            'type'    => 'literal',
            'options' => array(
              'route'    => '/add',
              'defaults' => array(
                'controller' => 'Blog\Controller\Write',
                'action'     => 'add',
              ),
            ),
          ),
          'edit' => array(
            'type' => 'segment',
            'options' => array(
              'route'    => '/edit/:id',
              'defaults' => array(
                'controller' => 'Blog\Controller\Write',
                'action'     => 'edit'
              ),
              'constraints' => array(
                'id' => '\d+'
              )
            )
          ),
          'delete' => array(
            'type' => 'segment',
            'options' => array(
              'route'    => '/delete/:id',
              'defaults' => array(
                'controller' => 'Blog\Controller\Delete',
                'action'     => 'delete'
              ),
              'constraints' => array(
                'id' => '\d+'
              )
            )
          ),
        ),
      ),
    ),
  ),
);