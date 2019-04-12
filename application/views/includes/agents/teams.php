<?php defined('BASEPATH') OR exit('No direct script access allowed');
$session_data = $this->session->userdata('logged_in');
$UserType = $session_data['user_type'];
?>
<!-- For bar chart only -->
<script type="text/javascript" src="<?= base_url(); ?>assets/js/jquery.min.js"></script>
<!-- For bar chart only -->
<body>
<?php $this->load->view('dashboard/dashboard-header'); ?>

<!--start section page body-->
<section id="section-body">
    <div class="container">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title-left">
                        <h1 class="title-head"><?=$this->lang->line('welcome');?>, <?php $session_data = $this->session->userdata('logged_in'); $uid = $session_data['id'];
                            echo ucwords($session_data['full_name']);
                            ?> </h1>
                    </div>
                    <div class="page-title-right">
                        <ol class="breadcrumb"><li><a href=""><i class="fa fa-home"></i></a></li><li class="active"><?=$this->lang->line('dashboard');?></li></ol>
                    </div>
                    <?php $this->load->view('templates/activation_notice'); ?>
                </div>
            </div>
        </div>

        <div class="user-dashboard-full">
            <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
            <div class="profile-area-content">
                <div class="profile-top">
                    <div class="profile-top-left">
                        <h2 class="title"><?=$this->lang->line('my_crew');?></h2>
                    </div>
                    <div class="profile-top-right">
                        <div class="my-property-search text-right">
                            <a href="javascript:void(0)" onclick="toggleThis()" class="btn btn-secondary"><?=$this->lang->line('add_a_member');?></a>
                        </div>
                    </div>
                </div>

                <div id="response"></div>

                <div class="profile-area account-block white-block addMember-block">
                    <h4><?=$this->lang->line('add_a_member');?></h4>
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                        <label class="radio-inline">
                            <input type="radio" name="radioGroup" onclick="existing_member()"><?=$this->lang->line('existing_member');?>
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="radioGroup" onclick="new_member()""><?=$this->lang->line('new_member');?>
                        </label>
                        </div>
                    </div>
                    <form class="row" method="POST" id="agent_exist" style="display: none;">

                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group">
                                <label class="control-label" for=""></label>
                                <?php if ($for_team_members){?>
                        <select name="member_id" title="<?=$this->lang->line('select_a_member');?>" class="selectpicker" data-live-search="true" data-size="5">
                            <?php foreach ($for_team_members as $member){ ?>
                                <option value="<?=$member->id; ?>"><?=$member->first_name; ?></option>
                           <?php } ?>

                        </select>
                                <?php }?>
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group">
                                <label> </label>
                                <button type="button"  onclick="AddExistingMember()" class="btn btn-block btn-primary"><?=$this->lang->line('add_a_member');?></button>
                            </div>
                        </div>
                    </form>

                    <form class="row" method="POST" action="" id="agent_registration" style="display: none;">

                       <div class="col-sm-3 col-xs-6">
                            <div class="form-group">
                                <label class="control-label" for=""><?=$this->lang->line('first_name');?></label>
                                <input type="text" class="form-control" required name="first_name" value="" placeholder="<?=$this->lang->line('first_name');?></label>">
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <div class="form-group">
                                <label class="control-label" for=""><?=$this->lang->line('last_name');?></label></label>
                                <input type="text" class="form-control" required name="last_name" value="" placeholder="<?=$this->lang->line('last_name');?>">
                            </div>
                        </div>
                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for=""><?=$this->lang->line('email');?></label>
                                <input type="email" class="form-control" required name="email" value="" placeholder="<?=$this->lang->line('email');?>">
                            </div>
                        </div>

                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for=""><?=$this->lang->line('phone');?></label>
                                <input type="number" class="form-control" name="phone" value="" required placeholder="<?=$this->lang->line('phone');?>">
                            </div>
                        </div>

                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for=""><?=$this->lang->line('location');?></label>
                                <input type="text" class="form-control" required name="location" id="agent_location" value="" placeholder="<?=$this->lang->line('location');?>">
                            </div>

                            <input type="hidden"  id="agent_street" name="street" value="" />
                            <input type="hidden"  id="agent_city" name="city" value="" />
                            <input type="hidden"  id="agent_state" name="state" value="" />
                            <input type="hidden"  id="agent_state_code" name="state_code" value="" />
                            <input type="hidden"  id="agent_country" name="country" value="" />
                            <input type="hidden"  id="agent_zipcode" name="zipcode" value="" />
                            <div id="map_canvas" style="width:100%; display:none; height:250px;"></div>


                        </div>


                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for=""><?=$this->lang->line('designation');?></label>
                                <input type="text" class="form-control" required name="designation" value="" placeholder="<?=$this->lang->line('designation');?>">
                            </div>
                        </div>

                        <div class="col-sm-3 col-xs-12">
                            <div class="form-group">
                                <label class="control-label" for=""><?=$this->lang->line('pass');?></label>
                                <input type="password" class="form-control" required name="password" value="">
                            </div>
                        </div>

                        <div class="col-sm-2 col-xs-12">
                            <div class="form-group">
                                <label> </label>
                                    <button type="submit" class="btn btn-block btn-primary"><?=$this->lang->line('add_a_member');?></button>
                            </div>
                        </div>
                    </form>
                </div>





                <div class="my-property-listing">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-xs-12">
                            <div class="widget widget-contact">
                                <div class="widget-body">

                                    <div class="agents-block">
                                        <figure class="auther-thumb">

                                            <?php
                                            $session_data = $this->session->userdata('logged_in');

                                            if(file_exists(FCPATH.$session_data['picture']))
                                            {
                                                ?>
                                                <img class="img-circle" src="<?=base_url($session_data['picture']); ?>" alt="<?=ucwords($session_data['full_name']); ?>">
                                                <?php
                                            }

                                            else
                                            {
                                                ?>
                                                <img src="<?= base_url() .'assets/img/placeholder.png'?>" alt="<?=ucwords($session_data['full_name']); ?>" width="150" height="150" class="img-circle">
                                                <?php
                                            }
                                            ?>




                                        </figure>
                                        <div class="block-body">
                                            <p class="auther-info">
                                                <span class="text-primary"><?php $session_data = $this->session->userdata('logged_in'); $uid = $session_data['id'];echo ucwords($session_data['full_name']); ?> </span>
                                                <span><?= ucwords($session_data['agent_type']);?></span>
                                            </p>
                                            <p class="description">
                                                <?= ucwords($session_data['about']);?>
                                            </p>
                                            <a href="<?=site_url('agent/profile/'.$uid);?>" class="btn btn-primary btn-block"><?=$this->lang->line('view_profile');?></a>



                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>


                        <div class="col-md-9 col-sm-12 col-xs-12">
                            <div class="row grid-row team_members">

                                <div class="ajax-loader_icon" id="loading" style="display:none"><img src="<?=base_url('assets/img/loading-spinner-default.gif');?>" /></div>

                                <?php if(count($members)) { ?>

                                    <?php foreach ($members as $member):?>

                                         <div class="item-wrap" id="member_<?=$member->id;?>">
                                             <div class="media my-property">
                                        <div class="media-left">
                                            <div class="figure-block">
                                                <figure class="item-thumb">
                                                    <a href="#">

                                                        <?php

                                                        if (file_exists('assets/media/users_avatar/' . $member->picture) == FALSE || $member->picture == null) {
                                                            $folder = "";
                                                            $pic = 'placeholder.png';
                                                        } else {

                                                            $folder = "medium/";
                                                            $pic = $member->picture;
                                                        }

                                                        ?>

                                                        <img src="<?= base_url() . 'assets/media/users_avatar/' . $folder . $pic; ?>" alt="<?=ucfirst($member->first_name .' '.$member->last_name);?>" width="350" height="350">
                                                    </a>
                                                </figure>
                                            </div>
                                        </div>
                                        <div class="media-body">
                                            <div class="my-description">
                                                <h4 class="my-heading"><a href="<?=site_url('agent/profile/'.$member->id);?>"><?=ucfirst($member->first_name .' '.$member->last_name);?></a>, <span class="small"><?=ucfirst($member->agent_type );?></span></h4>
                                                <p class="address"><?=ucfirst($member->location);?></p>
                                                <p class="status"><strong>Email:</strong> <?=$member->email;?> <strong>Téléphone:</strong> <?=$member->phone;?></p>
                                                <p class="status">
                                                    <strong>À Vendre:</strong> <span class="blue"><?= sale_count($member->id); ?></span>
                                                    <strong>Vendu:</strong> <span class="blue"><?= sold_count($member->id); ?></span>
                                                    <strong>Membre depuis:</strong> <?= date("M d, Y", strtotime($member->registered_date)) ?>
                                                    <?php if($member->experience != ''):?>
                                                    <strong>Experience:</strong> <?=$member->experience;?>
                                                    <?php endif;?>
                                                </p>
                                                <div class="rating">
                                                        <span data-title="Average Rate: 4.67 / 5" class="bottom-ratings tip"><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span class="fa fa-star-o"></span><span style="width: 93.4%" class="top-ratings"><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span><span class="fa fa-star"></span></span>
                                                        </span>
                                                    <span class="star-text-right small">15  Notes et commentaires</span>
                                                </div>
                                            </div>
                                            <div class="my-actions">
                                                <div class="btn-group">

                                                    <a style="background-color: <?=($member->active == 1 ? '#71c514' : '#f0ad4e');?>" href="javascript:void(0)" status="<?=$member->active;?>" class="action-btn btn-success agent_status" id="<?=$member->id;?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Update Status">
                                                        <span class="status_icon_<?=$member->id;?>">

                                                        <?php if($member->active == 1){ ?>

                                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i>

                                                        <?php } else{ ?>

                                                            <i class="fa fa-times-circle-o" aria-hidden="true"></i>

                                                        <?php }?>
                                                            </span>

                                                    </a>

                                                    <a href="javascript:void(0)" class="action-btn delete_agent" id="<?=$member->id;?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Remove"><i class="fa fa-close"></i></a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                         </div>

                                   <?php endforeach;?>

                                <?php }  else { ?>

                                    <section class="section-detail-content page-navigation-cn no_results">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="page-main">
                                                    <div class="article-detail text-center">
                                                        <h1><?=$this->lang->line('no_agent_added');?></h1>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                <?php }?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>