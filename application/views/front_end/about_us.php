<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<body>

<section id="splash-section" class="section index-splash" style="height:265px;">
    <div class="vegas-overlay"></div>
    <div class="splash-inner-media" style="background-image: url(<?=base_url()?>assets/img/background-img1.jpg)"></div>
    <div class="splash-inner-content">
        <?php $this->load->view('includes/menu/home') ;?>
        <div class="container text-center" style="margin-top:35px;">
            <h2 class="main_title"><?=$this->lang->line('c_how_are_you');?> <?=$this->lang->line('c_walking');?></h2>
            <p class="txt-white"><?=$this->lang->line('c_follow_steps');?></p>
        </div>
    </div>
</section>
    <?php /*$this->load->view('templates/quick_searchform'); */?>


<section id="section-body">
    <div class="container">
        <div class="page-title breadcrumb-top">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-title page-titles text-center">
                        <br/>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 col-sm-1"></div>
            <div class="col-md-8 col-sm-9">
                <div class="steps">
                    <div class="steps-contact step_1">
                        <div class="cricle step_icon"><img src="<?=base_url()?>assets/img/setp_icon_1.png" alt="Step 1"></div>
                        <h2><span>01.</span>  <?=$this->lang->line('c_search_find');?></h2>
                        <p><?=$this->lang->line('c_disp_step_1');?></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="steps-contact step_2">
                        <div class="cricle step_icon"><img src="<?=base_url()?>assets/img/setp_icon_2.png" alt="Step 2"></div>
                        <h2><span>02.</span>  <?=$this->lang->line('c_do_you_like');?></h2>
                        <p><?=$this->lang->line('c_disp_step_2');?></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="steps-contact step_3">
                        <div class="cricle step_icon"><img src="<?=base_url()?>assets/img/setp_icon_3.png" alt="Step 3"></div>
                        <h2><span>03.</span>  <?=$this->lang->line('c_reverses_process');?></h2>
                        <p><?=$this->lang->line('c_disp_step_3');?></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="steps-contact step_4">
                        <div class="cricle step_icon"><img src="<?=base_url()?>assets/img/setp_icon_4.png" alt="Step 4"></div>
                        <h2><span>04.</span>  <?=$this->lang->line('c_rental_file_other');?> </h2>
                        <p><?=$this->lang->line('c_disp_step_4');?></p>
                    </div>
                    <div class="clearfix"></div>
                    <div class="steps-contact step_5">
                        <div class="cricle step_icon"><img src="<?=base_url()?>assets/img/setp_icon_5.png" alt="Step 5"></div>
                        <h2><span>05.</span>  <?=$this->lang->line('c_creat_profile');?></h2>
                        <p><?=$this->lang->line('c_disp_step_5');?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-1"></div>

            <div class="clearfix"></div>

            <div class="about-box">
                <div class="col-md-7 pull-right">
                    <img src="<?=base_url()?>assets/img/img-about-01.jpg" alt="Image">
                </div>
                <div class="col-md-5 pull-left">
                    <div class="about-col-left">
                        <h3 class="t_heading"><?=$this->lang->line('c_find_home_make_your');?></h3>
                        <p><?=$this->lang->line('c_desc_step1');?></p>
                    </div>
                </div>
                <div class="clearfix"></div>
                <p> </p>
                <br/>
                <p> </p>
                <div class="col-md-7 pull-left">
                    <img src="<?=base_url()?>assets/img/img-about-02.jpg" alt="Image">
                </div>
                <div class="col-md-5 pull-right">
                    <div class="about-col-right">
                        <h3 class="t_heading"><?=$this->lang->line('c_our');?> <span class="orange"><?=$this->lang->line('c_mission');?></span> <!--<b>O</b>--></h3>
                        <p><?=$this->lang->line('c_desc_step2');?></p>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="article-detail about-box" style="background:none;">
                <div class="about-col-left col-md-12">
                    <figure class="img-caption alignright">
                        <img src="<?=base_url()?>assets/img/img-about-03.jpg" alt="Image">
                    </figure>
                    <h3 class="t_heading"><?=$this->lang->line('c_our');?> <span class="orange"><?=$this->lang->line('c_story');?></span> </h3>
                    <p><?=$this->lang->line('c_desc_step3');?></p>
                </div>
            </div>

        </div>

    </div>


    <div class="houzez-module team-module" style="display: none">
        <div class="container">

            <div class="page-title page-titles text-center">
                <h2>Our Team</h2>
            </div>

            <div class="row row-fluid text-center">
                <div class="col-md-1 col-sm-6 col-xs-12"></div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="team-block">
                        <img src="<?=base_url();?>assets/img/team/1team.jpg" alt="Yvan Alix" width="800" height="1188" align="team">
                        <div class="team-caption team-caption-before">
                            <div class="team-caption-inner">
                                <h4 class="team-name"><a href="#">Yvan Alix</a></h4>
                                <p class="team-designation"><a href="#">CEO Neighborty France</a></p>
                                <ul class="team-social">
                                    <li><a target="" href="#" class="btn-twitter"><i class="fa fa-twitter-square"></i></a></li>
                                    <li><a target="" href="#" class="btn-linkedin"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-caption team-caption-after">
                            <div class="team-caption-inner">
                                <h4 class="team-name"><a href="#">Yvan Alix</a></h4>
                                <p class="team-designation"><a href="#">CEO Neighborty France</a></p>
                                <p class="team-description">
                                    Intelligent, ambitious, energetic and proactive perfectionist. Working with Kathryn Wallace is a signature of success.                        </p>
                                <ul class="team-social">
                                    <li><a target="" href="#" class="btn-twitter"><i class="fa fa-twitter-square"></i></a></li>
                                    <li><a target="" href="#" class="btn-linkedin"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="team-block">
                        <img src="<?=base_url();?>assets/img/team/2team.jpg" alt="Kathryn Wallace" width="800" height="1188" align="team">
                        <div class="team-caption team-caption-before">
                            <div class="team-caption-inner">
                                <h4 class="team-name"><a href="#">Irtiza Mahmood</a></h4>
                                <p class="team-designation"><a href="#">CTO Neighborty Inc.</a></p>
                                <ul class="team-social">
                                    <li><a target="" href="#" class="btn-twitter"><i class="fa fa-twitter-square"></i></a></li>
                                    <li><a target="" href="#" class="btn-linkedin"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-caption team-caption-after">
                            <div class="team-caption-inner">
                                <h4 class="team-name"><a href="#">Irtiza Mahmood</a></h4>
                                <p class="team-designation"><a href="#">CTO Neighborty Inc.</a></p>
                                <p class="team-description">
                                    Intelligent, ambitious, energetic and proactive perfectionist. Working with Kathryn Wallace is a signature of success.                        </p>
                                <ul class="team-social">
                                    <li><a target="" href="#" class="btn-twitter"><i class="fa fa-twitter-square"></i></a></li>
                                    <li><a target="" href="#" class="btn-linkedin"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="team-block">
                        <img src="<?=base_url();?>assets/img/team/3team.jpg" alt="Kathryn Wallace" width="800" height="1188" align="team">
                        <div class="team-caption team-caption-before">
                            <div class="team-caption-inner">
                                <h4 class="team-name"><a href="#">Micaela Johnston</a></h4>
                                <p class="team-designation"><a href="#">COO Neighborty Inc.</a></p>
                                <ul class="team-social">
                                    <li><a target="" href="#" class="btn-twitter"><i class="fa fa-twitter-square"></i></a></li>
                                    <li><a target="" href="#" class="btn-linkedin"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-caption team-caption-after">
                            <div class="team-caption-inner">
                                <h4 class="team-name"><a href="#">Micaela Johnston</a></h4>
                                <p class="team-designation"><a href="#">COO Neighborty Inc.</a></p>
                                <p class="team-description">
                                    Intelligent, ambitious, energetic and proactive perfectionist. Working with Kathryn Wallace is a signature of success.                        </p>
                                <ul class="team-social">
                                    <li><a target="" href="#" class="btn-twitter"><i class="fa fa-twitter-square"></i></a></li>
                                    <li><a target="" href="#" class="btn-linkedin"><i class="fa fa-linkedin-square"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-1 col-sm-6 col-xs-12"></div>
            </div>
        </div>
    </div>
</section>