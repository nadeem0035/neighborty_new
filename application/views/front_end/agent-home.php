<?php defined( 'BASEPATH') OR exit( 'No direct script access allowed'); ?>
<body>
    <?php $this->load->view('templates/'.$topmenu); ?>
    <?php $this->load->view('templates/quick_searchform'); ?>

    <section id="section-body">
        <div class="container">
            <div class="page-title breadcrumb-top"></div>
            <div class="row">

                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <aside id="sidebar" class="sidebar-white">
                        <div class="widget widget-agent">
                            <div class="widget-agent-bg"></div>
                            <div class="widget-top text-center">
                                <a href="<?= site_url() ?>agent/profile/<?= $agent->id ?>">
                                    <img src="<?=base_url('assets/img/03-350x350.jpg');?>" class="img-circle" alt="Agent Thumb" width="90" height="90">
                                </a>
                                <h3 class="widget-title">Welcome, Imran!</h3>
                                <a href="#">Update your profile</a>
                            </div>
                            <div class="widget-body">
                                <span>34</span>
                                <p>Connections <strong>Grow your network</strong></p>
                                <hr>
                                <span>134</span>
                                <p>My Total listing <strong>Porperty Rent & Sell</strong></p>
                            </div>
                            <div class="widget-footer">
                                Neighborty is a site that allows you to search
                            </div>
                        </div>
                    </aside>
                    <div class="clearfix"></div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="detail-bar">
                        <div class="detail-block postArea">
                            <div class="post-box">
                                <p><a class="text" href="#">Share an article, photo, video or idea</a></p>
                                <hr>
                                <a href="javascript:void()" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Write an article</a>
                                <a href="javascript:void()" class="btn btn-file btn-sm btn-primary"><input type="file"><i class="fa fa-image"></i> Image</a>
                                <a href="javascript:void()" class="btn btn-sm btn-file btn-primary"><input type="file"><i class="fa fa-video-camera"></i> Video</a>
                                <a href="javascript:void()" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Add a listing</a>
                                <div class="btn btn-sm btn-secondary expander pull-right">Post</div>
                            </div>
                            <div id="postFrom">
                                <div class="table">
                                    <div class="table-cell">
                                        <a href="<?= site_url() ?>agent/profile/<?= $agent->id ?>">
                                            <img src="<?=base_url('assets/img/03-350x350.jpg');?>" class="img-circle" alt="Agent Thumb" width="45" height="45">
                                        </a>
                                    </div>
                                    <div class="table-cell">
                                        <strong>Johnny Lloyd</strong>
                                        <p>Alliance Careers- Assisting Transitioning</p>
                                    </div>
                                </div>
                                <form method="post">
                                    <textarea class="form-control" rows="3" placeholder="Write here or use @ to mention someone." autofocus></textarea>
                                    <hr>
                                    <a href="javascript:void()" class="btn btn-file btn-sm btn-primary"><input type="file"><i class="fa fa-image"></i> Image</a>
                                    <a href="javascript:void()" class="btn btn-sm btn-file btn-primary"><input type="file"><i class="fa fa-video-camera"></i> Video</a>
                                    <button type="submit" class="btn btn-sm btn-secondary pull-right">Post</button>
                                </form>
                            </div>
                        </div>
                        <hr>
                        
                        <div class="detail-block posted">
                            <div class="table">
                                <div class="table-cell">
                                    <a href="<?= site_url() ?>agent/profile/<?= $agent->id ?>">
                                        <img src="<?=base_url('assets/img/05-300x300.jpg');?>" class="img-circle" alt="Agent Thumb" width="45" height="45">
                                    </a>
                                </div>
                                <div class="table-cell">
                                    <strong>Chrisa Mott</strong>
                                    <p>
                                        Human Resources Executive
                                        <br/>
                                        3d
                                    </p>
                                </div>
                            </div>
                            <p>Basics of "Sales Management Skills" specifically designed for First Line Sales Managers & Second Line Sales Managers.</p>
                        </div>
                        <div class="detail-block posted">
                            <div class="table">
                                <div class="table-cell">
                                    <a href="<?= site_url() ?>agent/profile/<?= $agent->id ?>">
                                        <img src="<?=base_url('assets/img/05-300x300.jpg');?>" class="img-circle" alt="Agent Thumb" width="45" height="45">
                                    </a>
                                </div>
                                <div class="table-cell">
                                    <strong>Chrisa Mott</strong>
                                    <p>
                                        Human Resources Executive
                                        <br/>
                                        3d
                                    </p>
                                </div>
                            </div>
                            <p>L'AVIS DU PROFESSIONNEL Paris 8ème - TRIANGLE D'OR - 2 pièces meublé. Face à l'hôtel George V Four Seasons et au coeur du Triangle d'or, dans un immeuble de haut standing années 1960, au 6ème étage avec ascenseurs, appartement de 57m² loi Carrez entièrement rénové, meublé avec beaucoup de goût et avec de très belles prestations. Il est composé de 3 grandes baies vitrées sur balcon-terrasse de 6m² offrant une vue dégagée sur l'avenue Pierre Charon, un grand séjour plein sud avec cuisine ouverte, une chambre, une salle de bains avec toilettes et des toilettes invité. Une cave complète ce bien. Gardien 24 heures sur 24.</p>
                            <br/>
                            <img src="<?=base_url('assets/img/booking-bg.jpg');?>"  alt="" >
                        </div>

                        <div class="detail-block posted">
                            <div class="table">
                                <div class="table-cell">
                                    <a href="<?= site_url() ?>agent/profile/<?= $agent->id ?>">
                                        <img src="<?=base_url('assets/img/05-300x300.jpg');?>" class="img-circle" alt="Agent Thumb" width="45" height="45">
                                    </a>
                                </div>
                                <div class="table-cell">
                                    <strong>Chrisa Mott</strong>
                                    <p>
                                        Human Resources Executive
                                        <br/>
                                        3d
                                    </p>
                                </div>
                            </div>
                            <img src="<?=base_url('assets/img/french-palace.jpg');?>"  alt="" >
                        </div>

                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <aside id="sidebar" class="sidebar-white">
                        <div class="widget widget-follow">
                            <div class="widget-top">
                                <h3 class="widget-title">Add to your feed</h3>
                            </div>
                            <div class="widget-body">
                                <ul>
                                    <li class="table">
                                        <div class="table-cell">
                                            <a href="<?= site_url() ?>agent/profile/<?= $agent->id ?>">
                                                <img src="<?=base_url('assets/img/03-350x350.jpg');?>" class="img-circle" alt="Agent Thumb" width="65" height="65">
                                            </a>
                                        </div>
                                        <div class="table-cell">
                                            <strong>Johnny Lloyd</strong>
                                            <p>Alliance Careers- Assisting Transitioning</p>
                                        </div>
                                        <div class="table-cell"><a href="#" class="btn btn-sm btn-primary"> + follow</a></div>
                                    </li>
                                    <li class="table">
                                        <div class="table-cell">
                                            <a href="<?= site_url() ?>agent/profile/<?= $agent->id ?>">
                                                <img src="<?=base_url('assets/img/03-350x350.jpg');?>" class="img-circle" alt="Agent Thumb" width="65" height="65">
                                            </a>
                                        </div>
                                        <div class="table-cell">
                                            <strong>Johnny Lloyd</strong>
                                            <p>Alliance Careers- Assisting Transitioning</p>
                                        </div>
                                        <div class="table-cell"><a href="#" class="btn btn-sm btn-primary"> + follow</a></div>
                                    </li>
                                    <li class="table">
                                        <div class="table-cell">
                                            <a href="<?= site_url() ?>agent/profile/<?= $agent->id ?>">
                                                <img src="<?=base_url('assets/img/03-350x350.jpg');?>" class="img-circle" alt="Agent Thumb" width="65" height="65">
                                            </a>
                                        </div>
                                        <div class="table-cell">
                                            <strong>Johnny Lloyd</strong>
                                            <p>Alliance Careers- Assisting Transitioning</p>
                                        </div>
                                        <div class="table-cell"><a href="#" class="btn btn-sm btn-primary"> + follow</a></div>
                                    </li>
                                </ul>
                                <p><a href="#">view all</a></p>
                            </div>
                        </div>

                            <!--<?php //if(count($related)):?>-->
                            <div class="widget widget-recommend">
                                <div class="widget-top">
                                    <h3 class="widget-title">Les dernières propriétés</h3>
                                </div>
                                <div class="widget-body">
                                    <?php foreach ($related as $rel):?>
                                        <div class="media">
                                            <div class="media-left">
                                                <figure class="item-thumb">
                                                    <a class="hover-effect" href="#">
                                                        <img src="<?=display_listing_preview('search_thumbs',$rel->preview_image_url);?>" width="100" height="75" alt="<?=$rel->preview_image_url;?>">
                                                    </a>
                                                </figure>
                                            </div>
                                            <div class="media-body">
                                                <h3 class="media-heading"><a href="<?=site_url("property/".$rel->slug.'-'.$rel->id)?>"><?=$rel->listing_name;?></a></h3>

                                                <h4>
                                                    <?=pkrCurrencyFormat($rel->price);?>
                                                   <!-- <?php /*if($rel->property_type == 'rent') { */?>
                                                        <span style="font-weight: 200 !important;font-size: 13px;">Per Month</span>
                                                    --><?php /*} */?>
                                                </h4>

                                            </div>
                                        </div>
                                    <?php endforeach;?>
                                </div>
                            </div>
                        <?php /*endif;*/?>
                    </aside>
                </div>

            </div>
        </div>
    </section>