<?php
return array(
    'admin/settings/post/all' => 'admin/allpost',
    'admin/adduser' => 'admin/adduser',
    'admin/settings' => 'admin/settings',
	'admin' => 'admin/index',

    'manage/profile/edit/([0-9]+)' => 'manage/edit/$1/',
    'manage/profile/([0-9]+)' => 'manage/profile/$1/',
    'manage/adduser' => 'manage/adduser',
    'manage' => 'manage/index',

    'user/profile/edit/([0-9]+)' => 'user/edit/$1/',
    'user/profile/([0-9]+)' => 'user/profile/$1/',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'user' => 'user/user',

    '' => 'manage/index'
);