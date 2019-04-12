<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<body>
<?php $this->load->view('templates/'.$topmenu); ?>

<div class="header-media">
    <div class="banner-parallax" style="overflow:inherit;">
        <div class="banner-bg-wrap">
            <div class="banner-inner" style="background-image:url(<?=base_url()?>assets/img/splash_image.jpg);">
                <div class="banner-caption agents-landing">
                    <h1>Trouver votre agent immobilier présde chez vous</h1>
                    <p>To get started, enter your location or search for a specific agent by name</p>
                    <?php $this->load->view('templates/agent_searchform'); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="" style="margin-bottom:40px;">
    <div class="container">

        <div class="page-title breadcrumb-top">
            <div class="row"></div>
        </div>

        <div class="row">
            <div id="content-area">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="page-main">
                    <div class="article-detail">
                        <div class="row">
                        <div class="col-md-6" id="find_professional_agents">
                            <h3><a class="" href="#header-section" style="color: #000;">FIND PROFESSIONAL AGENTS</a></h3>
                            <p>Our agents are the best in the real estate community. They're here to help you find or sell your home. Because of our community rating system, you can find the most knowledgable, reliable and experienced agents in your area.</p>
                            <br/>
                            <a class="" href="#header-section">
                                 <img src="<?=base_url()?>assets/img/letting-agents.jpg" alt="">
                            </a>
                        </div>

                        <div class="col-md-6">
                            <h3><a href="<?=site_url('packages');?>" style="color: #000;"> WANT TO LIST WITH US?</a></h3>
                            <p>Our network provides the best tools for agents to list properties, advertise listings and market themselves and their real estate services. We have pricing plans based on inclined leads. Users can contact you and set appointments, all directly through Neighborty's platform!</p>
                            <br/>
                            <a href="<?=site_url('packages');?>">
                            <img src="<?=base_url()?>assets/img/list-your-property.jpg" alt="">
                            </a>
                        </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </div>
</section>