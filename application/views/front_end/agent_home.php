<body>
<?php $this->load->view('templates/'.$topmenu); ?>
<?php $this->load->view('templates/quick_searchform'); ?>
<button class="btn scrolltop-btn back-top"><i class="fa fa-angle-up"></i></button>
<section id="section-body">
    <div class="container">
        <div class="page-title breadcrumb-top"></div>
        <div class="row" style="position:relative;">

            <div id="loadArtical" style="display:none ">
                <a href="#" class="reload">Reload</a>
            </div>

            <?php $this->load->view('includes/agents/agent_info_widget');?>

            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="detail-bar">
                    <?php $this->load->view('includes/agents/write_feed');?>
                </div>
                <div class="detail-bar" id="post-data">

                   <?php $this->load->view('includes/agents/latest_feeds');?>

                </div>

                <?php if(!empty($feeds)){ ?>

                    <?php if(count($feeds) > 10 ){ ?>
                        <hr>
                        <div class="ajax-load text-center loadingFeeds" style="display:block">
                            <img src="<?=base_url();?>assets/img/loading-spinner-blue.gif">Loading More Feeds
                        </div>
                     <?php } ?>
                <?php } else{ ?>

                    <p class="text-center">No records found</p>


                <?php } ?>

            </div>

            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <aside id="sidebar" class="sidebar-white">

                    <?php $this->load->view('includes/agents/follow_widget');?>
                    <?php $this->load->view('includes/latest_listings_widget');?>

                </aside>
            </div>

        </div>
    </div>
</section>
