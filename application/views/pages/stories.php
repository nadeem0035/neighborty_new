<?php defined('BASEPATH') OR exit ('No direct script access allowed'); ?>
<body>
    <?php $this->load->view('templates/'.$topmenu); ?>
    <?php $this->load->view('templates/quick_searchform'); ?>
    <section id="section-body">
        <div class="container">

            <div class="page-title breadcrumb-top">
                <div class="row">
                    <div class="col-sm-12">
                        <ol class="breadcrumb">
                            <li><a href="/"><i class="fa fa-home"></i></a></li>
                            <li class="active">stories</li>
                        </ol>
                        <div class="page-title-left">
                            <h2>Neighborty Stories</h2>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-offset-0 col-sm-offset-3 container-sidebar">
                    <div class="my-property-menu">
                        <?php if( $this->uri->segment(2) == 'faqs' || $this->uri->segment(2) == 'legal' || $this->uri->segment(2) == 'stories')  {?>
                        <ul id="sidebar_nav">
                            <li class="<?= ($this->uri->segment(2) == "faqs") ? 'active' : '' ?>" ><a  id="faqs" href="javascript:;">FAQS</a></li>
                            <li class="<?= ($this->uri->segment(2) == "add-listing") ? 'active' : '' ?>"><a  id="add-listing"  href="javascript:;">Add a Listing</a></li>
                            <li class="<?= ($this->uri->segment(2) == "legal") ? 'active' : '' ?>"><a id="legal" href="javascript:;">Legal</a></li>
                            <li class="<?= ($this->uri->segment(2) == "stories") ? 'active' : '' ?>"><a  id="stories" href="javascript:;">Stories </a></li>
                        </ul>
                        <?php } else { ?>
                        <ul id="sidebar_nav">
                            <li class="<?= ($this->uri->segment(2) == "about") ? 'active' : '' ?>" ><a  id="about" href="javascript:;">About Us</a></li>
                            <li class="<?= ($this->uri->segment(2) == "mission") ? 'active' : '' ?>"><a  id="mission"  href="javascript:;">Our Mission</a></li>
                            <li class="<?= ($this->uri->segment(2) == "press") ? 'active' : '' ?>"><a id="press" href="javascript:;">Press</a></li>
                            <li class="<?= ($this->uri->segment(2) == "career") ? 'active' : '' ?>"><a  id="career" href="javascript:;">Careers</a></li>
                            <li class="<?= ($this->uri->segment(2) == "contact") ? 'active' : '' ?>"><a  id="contact" href="javascript:;">Contact</a></li>
                        </ul>
                        <?php } ?>
                    </div>
                </div> <!-- Left Column -->

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                    <div class="article-detail">
                        <div class="row">
                            <div class="my-profile">
                                <h1>Stories</h1>
                                <?php foreach($stories as $story):?>
                                <div class="col-md-6">
                                    <h4 class="my-profile__title"><?=$story->title;?></h4>
                                    <p><?=$story->description;?></p>
                                </div>
                                <div class="col-md-6 storyBanner"><img src="<?=$img_path.$story->image;?>"></div>
                                <hr/>
                                <?php endforeach;?>
                            </div>
                        </div>
                    </div>
                </div> <!-- Right Column -->

            </div> <!-- row -->
        </div> <!-- container -->
    </section> <!-- section -->