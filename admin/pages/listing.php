<?php

$xcrud = Xcrud::get_instance();
$xcrud->table('listing');
$xcrud->order_by('id','desc');
$xcrud->relation('user_id', 'users', 'id',array('first_name','last_name'));

$xcrud->label('user_id', 'Listed by');
$xcrud->label('home_type', 'Type');
$xcrud->label('date_created', 'created date');
$xcrud->change_type('price', 'price', '0', array('prefix'=>'Rs'));
$xcrud->change_type('date_created', 'datetime');

$xcrud->label('location_id', 'Address');
$xcrud->change_type('price', 'price', '5', array('prefix'=>'Rs'));
$xcrud->change_type('summary', 'textarea');
$xcrud->readonly('availability_calendar,additional_note');
$xcrud->no_editor('availability_calendar,additional_note');
//$xcrud->columns('slug,summary,availability_calendar,typed_address', true);
$xcrud->fields('user_id,house_number,property_street,purpose,property_type,property_sub_type,city,area,sectors,property_location,title,summary,land_area,unit_id,bedrooms,bathrooms,price,expires,video,contact_primary,contact_secondary,area_sqrft,area_sqyard,area_sqmeter,area_marla,area_kanal,area_actre,start_date,end_date,status,is_featured');
$xcrud->columns('id,user_id,title,price,is_featured,property_type, status, date_created');


$listing_pictures = $xcrud->nested_table('listing_pictures','id','listing_pictures','listing_id');
$listing_pictures->columns('picture');
$listing_pictures->fields('picture');

$listing_pictures->change_type('picture','image','',array(

    'path' => '../../assets/media/properties/',
    'thumbs'=>array(
        array(
            'width' => 400,
            'height' => 200,
            'crop' => true,
            'watermark' => '../../assets/img/watermark.png',
            'folder' => 'small',
        ),

        array(
            'width' => 780,
            'height' => 440,
            'crop' => true,
            'watermark' => '../../assets/img/watermark.png',
            'folder' => 'thumbs',
        ),

    )
));

$listing_amenities = $xcrud->nested_table('listing_amenities','id','listing_amenities','listing_id'); // 2nd level 2
$listing_amenities->columns('amenities_id');
$listing_amenities->fields('amenities_id');
//$listing_amenities->relation('amenities_id', 'amenities', 'id',null,null,null,'  |  ');
$listing_amenities->label('amenities_id', 'Amenities Name   |   Type');
$listing_amenities->relation('amenities_id', 'amenities', 'id',array('name'));

$xcrud->label('property_type','Type');
$xcrud->label('is_featured','Featured');
$xcrud->highlight_row('is_featured', '=', 1, '#bef3b3');
$xcrud->highlight_row('price', '=', 0, 'red');
$xcrud->highlight_row('status', '=', 'publish', '#bef3b3');
$xcrud->highlight_row('status', '=', 'pending', '#fbe6c9');
$xcrud->highlight_row('status', '=', 'premium', '#28578C');

$xcrud->create_action('publish', 'publishListing');
$xcrud->create_action('unpublish', 'unpublishListing');
$xcrud->create_action('unpremium', 'unpremiumListing');

//unpremium a listing and push it to publish list
$xcrud->button('#', 'Click to Un premium', 'icon-close glyphicon glyphicon-star', 'xcrud-action',
    array(  // set action vars to the button
        'data-task' => 'action',
        'data-action' => 'publish',
        'data-primary' => '{id}'),
    array(  // set condition ( when button must be shown)
        'status',
        '=',
        'premium')
);


$xcrud->button('#', 'Click to Publish', 'icon-close glyphicon glyphicon-remove', 'xcrud-action',
    array(  // set action vars to the button
        'data-task' => 'action',
        'data-action' => 'publish',
        'data-primary' => '{id}'),
    array(  // set condition ( when button must be shown)
        'status',
        '=',
        'pending')
);
$xcrud->button('#', 'Click to Pending', 'glyphicon glyphicon-ok', 'xcrud-action', array(
    'data-task' => 'action',
    'data-action' => 'unpublish',
    'data-primary' => '{id}'), array(
    'status',
    '=',
    'publish'));

$xcrud->create_action('featured', 'featuredListing');
$xcrud->create_action('unfeatured', 'unfeaturedListing');




$xcrud->button('#', 'Click to Featured', 'icon-close glyphicon glyphicon-remove', 'xcrud-action',
    array(  // set action vars to the button
        'data-task' => 'action',
        'data-action' => 'featured',
        'data-primary' => '{id}'),
    array(  // set condition ( when button must be shown)
        'is_featured',
        '=',
        0)
);
$xcrud->button('#', 'Click to Unfeatured', 'glyphicon glyphicon-ok', 'xcrud-action', array(
    'data-task' => 'action',
    'data-action' => 'unfeatured',
    'data-primary' => '{id}'), array(
    'is_featured',
    '=',
    '1'));

$xcrud->column_pattern('user_id', '<a href="https://zoney.pk/agent/profile/{user_id}"  data-primary="{user_id}">{value}</a>');
$xcrud->column_pattern('title', '<a target="_blank" href="https://zoney.pk/property/{slug}-{id}">{title}</a>');



//$customers->columns('customerName,city,country');
//$xcrud->unset_add();
echo $xcrud->render();
?>

<!-- <script type="text/javascript">
jQuery(document).on("xcrudafterrequest",function(event,container){
   console.log('TESTEST');
   $(".ui-widget-content").css("cssText", "height: 650px !important;");
   $(".ui-widget-content").attr("style","border:5px solid green!important");

});
</script> -->