<?php
defined('COT_CODE') or die('Wrong URL');

// Breadcrumbs
$R['breadcrumbs_container'] = '<ol class="breadcrumb">{$crumbs}</ol>';
$R['breadcrumbs_first'] = '<li class="breadcrumb-item">{$crumb}</li>';
$R['breadcrumbs_crumb'] = '<li class="breadcrumb-item">{$crumb}</li>';
$R['breadcrumbs_link'] = '<a href="{$url}" title="{$title}">{$title}</a>';
$R['breadcrumbs_plain'] = '{$title}';
$R['breadcrumbs_last'] = '<li class="breadcrumb-item active">{$crumb}</li>';
$R['breadcrumbs_separator'] = '';
