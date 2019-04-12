<div id="post-card-grid-module" class="houzez-module post-card-module module-gray-bg">
    <div class="container">
        <div class="module-title-nav clearfix">
            <div><h2>Recent Blog</h2></div>
        </div>
        <div class="row grid-row">

            <?php foreach($blogs as $blog):?>

            <?php //echo '<pre>';print_r($blog['post']);?>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="item-wrap">
                    <div class="post-card-item">
                        <div class="figure-block">
                            <figure class="item-thumb">
                                <a href="<?=site_url('/blog/'.$blog['post']->post_name);?>" class="hover-effect" style="background-image: url(<?=$blog['image']->guid;?>)"></a>

                            </figure>
                        </div>
                        <div class="post-card-body">
                            <div class="post-card-description">
                                <ul class="list-inline">
                                    <li><i class="fa fa-calendar"></i> <?php echo date('d M Y');?></li>
                                </ul>
                                <h3><?=$blog['post']->post_title;?></h3>
                                <p><?=character_limiter($blog['post']->post_excerpt,90);?> </p>
                                <a href="<?=site_url('/blog/'.$blog['post']->post_name);?>" class="read">Continue reading <i class="fa fa-caret-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach;?>

            <?php if($blogs):?>

                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <a href="<?=site_url('/blog');?>" class="btn btn-secondary">View More</a>
                </div>

            <?php endif;?>
        </div>
    </div>
</div>