<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
 <?php $this->load->view('templates/preloader'); ?>
 <div id="wrap">
  <?php  $this->load->view('templates/'.$topmenu); ?>
  <section class="sub-banner">
   <div class="bg-parallax bg-6" style="height:420px !important;"></div>
 </section>
 <div class="main">
  <div class="title-wrap">
    <section class="destinations" style="background: rgba(10, 7, 6, 0.7); border-top:1px solid #5a524c; border-bottom:1px solid #5a524c;">
      <?  $this->load->view('templates/sub_searchform'); ?>
    </section>
    <section class="blog-content">
      <div class="row">
          <div class="col-md-2 col-md-push-1">
                            <div class="widget widget_archive">

                            <?php if( $this->uri->segment(2) == 'faqs' || $this->uri->segment(2) == 'legal' || $this->uri->segment(2) == 'stories')  {?>
                              
                            <div id="comp_info">Learn More</div>
                            <ul class="nav-sidebar-blog" id="sidebar_nav">
                                    <li class="<?= ($this->uri->segment(2) == "faqs") ? 'selected' : '' ?>" >
                                        <a  id="faqs" href="javascript:;">FAQS</a>
                                    </li>
                                    <li class="<?= ($this->uri->segment(2) == "add-listing") ? 'selected' : '' ?>">
                                     <a  id="add-listing"  href="javascript:;">Add a Listing</a>
                                    </li>
                                    <li class="<?= ($this->uri->segment(2) == "legal") ? 'selected' : '' ?>">
                                       <a id="legal" href="javascript:;">Legal</a>
                                    </li>
                                    <li class="<?= ($this->uri->segment(2) == "stories") ? 'selected' : '' ?>">
                                        <a  id="stories" href="javascript:;">Stories </a>
                                    </li>
                            </ul>

                        <?php } else { ?>

                              <div id="comp_info">Company Info</div>
                                <ul class="nav-sidebar-blog" id="sidebar_nav">
                                    <li class="<?= ($this->uri->segment(2) == "about") ? 'selected' : '' ?>" >
                                        <a  id="about" href="javascript:;">About Us</a>
                                    </li>
                                    <li class="<?= ($this->uri->segment(2) == "mission") ? 'selected' : '' ?>">
                                     <a  id="mission"  href="javascript:;">Our Mission</a>
                                 </li>
                                 <li class="<?= ($this->uri->segment(2) == "press") ? 'selected' : '' ?>">
                                    <a id="press" href="javascript:;">Press</a>
                                </li>
                                <li class="<?= ($this->uri->segment(2) == "career") ? 'selected' : '' ?>">
                                 <a  id="career" href="javascript:;">Careers</a>
                             </li>
                             <li class="<?= ($this->uri->segment(2) == "contact") ? 'selected' : '' ?>"> 
                                <a  id="contact" href="javascript:;">Contact</a>
                            </li>
                        </ul>

                        <?php } ?>
                    </div>
                </div>
      <div class="col-md-8 col-md-push-1 pressBody">
        <div class="my-profile">
          <h1>LUXUS Stories</h1>
          <?php foreach($stories as $story):?>
            <div class="row">
              <div class="col-md-6">
                <h4 class="my-profile__title"><?=$story->title;?></h4>
                <p><?=$story->description;?></p>
              </div>
              <div class="col-md-6 storyBanner">
               <img src="<?=$img_path.$story->image;?>">
             </div>        
           </div>
         <?php endforeach;?>
       </div>
     </div>
   </div>
 </section>      
</div>
</div>
</div>