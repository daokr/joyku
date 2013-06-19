<?php 
return array (
  'URL_MODEL' => 1,
  'URL_CASE_INSENSITIVE' => false,
  'URL_ROUTER_ON' => true,
  'URL_ROUTE_RULES' => 
  array (
    '/^space\/(\w+)$/' => 'space/index/index?id=:1',
    '/^people\/(\w+)$/' => 'space/index/index?id=:1',
    '/^group\/explore_topic$/' => 'group/index/explore_topic',
    '/^group\/explore$/' => 'group/index/explore',
    '/^group\/topic\/id\/(\d+)$/' => 'group/index/topic?id=:1',
    '/^group\/topic\/(\d+)$/' => 'group/index/topic?id=:1',
    '/^group\/topic\/(\d+)\/sc\/(\w+)$/' => 'group/index/topic?id=:1&sc=:2',
    '/^group\/topic\/(\d+)\/sc\/(\w+)\/p\/(\d+)$/' => 'group/index/topic?id=:1&sc=:2&p=:3',
    '/^group\/topic\/(\d+)\/p\/(\d+)$/' => 'group/index/topic?id=:1&p=:2',
    '/^group\/topic\/(\d+)\/sc\/(\w+)\/isauthor\/(\d)$/' => 'group/index/topic?id=:1&sc=:2&isauthor=:3',
    '/^group\/topic\/(\d+)\/sc\/(\w+)\/isauthor\/(\d)\/p\/(\d+)$/' => 'group/index/topic?id=:1&sc=:2&isauthor=:3&p=:4',
    '/^group\/(\d+)$/' => 'group/index/show?id=:1',
    '/^article\/(\d+)$/' => 'article/index/show?id=:1',
    '/^article\/category\/cateid\/(\d+)$/' => 'article/index/category?cateid=:1',
    '/^article\/(\d+)\/sc\/(\w+)$/' => 'article/index/show?id=:1&sc=:2',
    '/^article\/(\d+)\/sc\/(\w+)\/p\/(\d+)$/' => 'article/index/show?id=:1&sc=:2&p=:3',
    '/^article\/(\d+)\/p\/(\d+)$/' => 'article/index/show?id=:1&p=:2',
    '/^article\/(\d+)\/sc\/(\w+)\/isauthor\/(\d)$/' => 'article/index/show?id=:1&sc=:2&isauthor=:3',
    '/^article\/(\d+)\/sc\/(\w+)\/isauthor\/(\d)\/p\/(\d+)$/' => 'article/index/show?id=:1&sc=:2&isauthor=:3&p=:4',
    '/^event\/(\w+)-(\w+)$/' => 'event/index/lists?time=:1&type=:2',
    '/^event\/(\d+)$/' => 'event/index/show?id=:1',
    '/^develop\/(\d+)$/' => 'develop/index/show?id=:1',

  	'/^mall\/item\/(\d+)$/' => 'mall/item/index?id=:1',
  ),
  'URL_IKPHP_RULES' => 
  array (
    'index/id/' => '',
    'index/show/id/' => '',
    'index/topic/id/' => 'topic/',
    'article/index/category/' => 'article/category/',
    'space/index/' => 'space/',
    'develop/index/index' => 'develop/',
  ),
);