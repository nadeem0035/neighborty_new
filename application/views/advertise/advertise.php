<section id="splash-section" class="section index-splash" style="height:265px;">
    <div class="vegas-overlay"></div>
    <div class="splash-inner-media" style="background-image: url(<?=base_url()?>assets/img/background-img1.jpg)"></div>
    <div class="splash-inner-content">
        <?php $this->load->view('includes/menu/home') ;?>
        <div class="container text-center" style="margin-top:35px;">
            <h2 class="main_title">Advertise with us</h2>
        </div>
    </div>
</section>



<div id="">
    <div id="wrap">
        <div class="container">
            <div class="page-title breadcrumb-top">
                <div class="row">
                    <div class="col-sm-12">
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 container-contentbar">
                    <div class="page-main">
                        <div class="article-detail">

                            <div class="press_news">
                                <h3><a href="#"><?=ucwords(stripslashes(str_replace('-', ' ', $name)));?></a></h3>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor expedita facere incidunt, molestiae necessitatibus qui quidem vel? Amet cum dolore eius enim error, esse eveniet expedita in nobis sequi! Officia! </p>

                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet autem distinctio eius eum facere iste, laborum necessitatibus neque nesciunt nisi obcaecati pariatur quasi quisquam recusandae reiciendis repellendus sapiente velit voluptate?</p>

                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus error omnis quae voluptas. Amet cupiditate illum, ipsam iste labore magni recusandae repellat sit soluta temporibus. Ab est modi nemo praesentium.</p>


                                <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam aliquid doloremque earum explicabo minus. Eos fugiat iure labore nulla odio quisquam repudiandae similique ullam vel veniam! Autem molestias saepe vero.
                                </p>
                            </div>

                            <div class="col-md-12 text-center">
                                <a href="javascript:void(0)"  data-toggle="modal" data-target="#myModal" class="btn btn-secondary">Contact Us to Advertise</a>
                            </div>

                            <div class="clearfix"></div>

                            <div class="modal fade" id="myModal" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Contact Us To Advertise</h4>
                                        </div>
                                        <div class="modal-body" style="overflow: unset;width: 100%;float: left;">

                                            <form class="<?=site_url('save-advertisement-request');?>" action="" id="advertise_form" method="post">
                                                <div class="form-group">
                                                    <label for="name" class="control-group">Name:</label>
                                                    <input type="text" class="form-control" id="name" name="name" required="required">
                                                </div>

                                                <input type="hidden" name="ad_type" value="<?=$name;?>" />

                                                <div class="form-group">
                                                    <label for="email" class="control-group">Email:</label>
                                                    <input type="email" class="form-control" id="email" name="email" required="required">
                                                </div>

                                                <div class="form-group">
                                                    <label for="email">Phone:</label>
                                                    <input type="text" class="form-control" id="phone" name="phone" required="required">
                                                </div>

                                                <div class="form-group">
                                                    <label for="subject">Subject:</label>
                                                    <input type="text" class="form-control" id="subject" name="subject" required="required">
                                                </div>


                                                <div class="form-group">
                                                    <label for="email">Message:</label>
                                                    <textarea class="form-control" required="required" name="message"></textarea>
                                                </div>


                                                <button type="submit" class="btn btn-primary advertise_btn" onclick="advertise()">Submit</button>


                                            </form>
                                        </div>

                                    </div>

                                </div>
                            </div>



                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 col-md-offset-0 col-sm-offset-3 container-sidebar">
                    <aside id="sidebar">
                        <div class="widget widget-categories">
                            <div class="widget-top">
                                <h3 class="widget-title">Banner Categories</h3>
                            </div>
                            <div class="widget-body">
                                <ul>
                                    <li><a href="<?=site_url('advertise/banner/leaderboard');?>">Leaderboard</a></li>
                                    <li><a href="<?=site_url('advertise/banner/site-wide-right-banner');?>">Site Wide Right Banner</a> </li>
                                    <li><a href="<?=site_url('advertise/banner/splash-banner');?>">Splash Banner</a></li>
                                    <li><a href="<?=site_url('advertise/banner/middle-banner-home');?>">Middle Banner Home</a> </li>
                                    <li><a href="<?=site_url('advertise/banner/middle-banner-category');?>">Middle Banner Category</a> </li>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>

        </div>
    </div>

</div>



