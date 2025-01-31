<?php
$arUrlRewrite=array (
  0 =>
  array (
    'CONDITION' => '#^/([0-9a-z_-]+)/([0-9a-z_-]+)/([0-9]+)/.*#',
    'RULE' => 'SECTION_CODE=$2&PAGEN_1=$3',
    'ID' => '',
    'PATH' => '/$1/list.php',
    'SORT' => 100,
  ),
  1 =>
  array (
    'CONDITION' => '#^/([0-9a-z_-]+)/([0-9a-z_-]+)/([0-9a-z_-]+)/.*#',
    'RULE' => 'SECTION_CODE=$2&ELEMENT_CODE=$3',
    'ID' => '',
    'PATH' => '/$1/detail.php',
    'SORT' => 200,
  ),
  2 =>
  array (
    'CONDITION' => '#^/([0-9a-z_-]+)/([0-9a-z_-]+)/.*#',
    'RULE' => 'SECTION_CODE=$2',
    'ID' => '',
    'PATH' => '/$1/list.php',
    'SORT' => 300,
  ),
);
