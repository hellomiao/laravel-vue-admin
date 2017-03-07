<?php
// Home
Breadcrumbs::register('admin.home', function($breadcrumbs)
{
    $breadcrumbs->push('首页', route('admin.home'));
});

// Home > Blog
Breadcrumbs::register('admin.permission.index', function($breadcrumbs)
{
    $breadcrumbs->parent('admin.home');
    $breadcrumbs->push('权限管理', route('admin.permission.index'));
});