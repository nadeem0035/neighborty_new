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
                                    <ul class="nav-sidebar-blog">
                                    <li><a style="color:#7f8c8d;">Company</a></li>
                                        
                                        <li class="<?=($this->uri->segment(2)=="about")?'selected':''?>"><a href="<?=base_url()?>page/about">About Us</a>
                                        </li>
                                        
                                        <li class="<?=($this->uri->segment(2)=="founders")?'selected':''?>"><a href="<?=base_url()?>page/founders">Founders</a>
                                        </li>
                                        <li class="<?=($this->uri->segment(2)=="press")?'selected':''?>"><a href="<?=base_url()?>page/press">Press</a>
                                        </li>
                                        <li class="<?=($this->uri->segment(2)=="career")?'selected':''?>"><a href="<?=base_url()?>page/career">Careers</a>
                                        </li>
                                        <li class="<?=($this->uri->segment(2)=="blog")?'selected':''?>"><a href="<?=base_url()?>page/blog">Blog</a>
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>

<div class="col-md-8 col-md-push-1 pressBody">

<div class="my-profile">
									
                                    <h4 class="my-profile__title">TRAVEL WELL. LIVE INSPIRED.</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <p>Inspirato is more than just the name of our company. Meaning "Inspired" in Italian, it serves as a daily reminder that when you travel well, creating lasting memories and relationships with family and friends, you live a more inspired life. That is what we strive to help our members do, each and every day.</p>
                                            <p>"Inspirato" also serves as the hallmark of our company culture. You can feel it in our offices, at our meetings, and in our destinations with our onsite staff. We are inspired by what we do, by the stories our members share with us about their club travels, and by the opportunity to work together as a passionate, talented team. We live our mission in concert with every vacation we create for our members, and we wouldn't have it any other way.</p>
                                            
                                        </div>
                                        
                                        <div class="col-md-6 storyBanner">
<img src="https://cms.inspirato.com/ImageGen.ashx?image=/media/4534847/insp-mission-v3.png&amp;height=268&amp;compression=70">
</div>
                                        
                                    </div>
                                    
                                    <h4 class="my-profile__title">THE INSPIRATO STORY</h4>
                                    <p>Every great company begins with an inspired moment…</p>

<p>More than a decade ago, Brent and Brad Handler took a much-anticipated vacation with their families in Hawaii. While the Maui sunsets were as breathtaking as they'd hoped, when the brothers returned home they weren't completely satisfied with the experience.</p>

<p>Why? They spent the entire week wishing they had more space to spread out, more bedrooms to accommodate extended family and friends, a kitchen to prepare snacks and meals for the kids and more personalized local insights about the best things to see and do on the island.</p>

<p>Ultimately, the brothers joined with Brian Corbett and Martin Pucher to create a private club that combined the luxury, space and character of private vacation homes with warm, personalized service and a host of rich resort amenities.</p>

<p>At the time, it was all about creating a better way for big families like theirs to vacation together. Today, there's so much more. It's about helping people connect whenever the inspiration strikes. From intimate weekend escapes in drive-to destinations to full-fledged family reunions in the world's most beautiful resorts.</p>

<p>And now, with a growing portfolio of curated residences worth hundreds of millions of dollars, a global collection of hotel and resort partners and an impressive roster of custom experiences, Inspirato is changing the way families and friends experience the world.</p>
                                    
                                </div>

</div>
                            
                        </div>
                    </section>      

        
  </div>



            
        </div>
   </div>
  