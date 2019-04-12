<?php
   defined('BASEPATH') OR exit('No direct script access allowed');
   ?>
<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
 
   <?php $this->load->view('templates/preloader'); ?>
   <div id="wrap">
      <?= $this->load->view('templates/'.$topmenu); ?>
      <section class="sub-banner nomargins-def">
         <!-- <div class="bg-parallax bg-7" style="height:420px !important;"></div>-->
      </section>
      <div class="main">
         <?= $this->load->view('templates/search_searchform');  ?>
         <section class="about-area detail-cn black-bgs" id="about-area">
            <div class="row data-sticky_column data-sticky_parent" id="search_results">
            <?= $this->load->view('front_end/search_results');  ?>
            </div>
         </section>
      </div>
   </div>
   