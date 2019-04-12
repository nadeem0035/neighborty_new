<?php
$xcrud = Xcrud::get_instance();
$xcrud->table('users');
$xcrud->order_by('id','desc');
//$xcrud->columns('first_name','last_name');

//$xcrud->change_type('password', 'password', 'md5', 8);
$xcrud->change_type('picture', 'image', false, array(
    'not_rename' => true,
    'width' => 225,
    'path' => '../../assets/media/users_avatar/medium'));
$xcrud->change_type('password', 'password', 'md5', array('maxlength'=>10,'placeholder'=>'enter password'));

$xcrud->columns('id,picture,user_type,first_name,last_name,email,city,state,active');
//$xcrud->fields('password,hash', true);
$xcrud->fields('first_name,last_name,email,picture,phone,password,agency_name,agent_type,city,state,country,active');

$xcrud->create_action('publish', 'activateUser');
$xcrud->create_action('unpublish', 'inactivateUser');

$xcrud->button('#', 'Not Active, Click to active', 'icon-close glyphicon glyphicon-remove', 'xcrud-action',
    array(  // set action vars to the button
        'data-task' => 'action',
        'data-action' => 'publish',
        'data-primary' => '{id}'),
    array(  // set condition ( when button must be shown)
        'active',
        '=',
        0)

);

$xcrud->button('#', 'Activated on Neighborty', 'glyphicon glyphicon-ok', 'xcrud-action', array(
    'data-task' => 'action',
    'data-action' => 'unpublish',
    'data-primary' => '{id}'), array(
    'active',
    '=',
    1));

$xcrud->column_pattern('id', '<a  target="_blank" href="https://neighborty.fr/agent/profile/{id}">{id}</a>');
$xcrud->column_pattern('first_name', '<a target="_blank" href="https://neighborty.fr/agent/profile/{id}">{first_name}</a>');
$xcrud->column_pattern('last_name', '<a  target="_blank" href="https://neighborty.fr/agent/profile/{id}">{last_name}</a>');



echo $xcrud->render();
?>