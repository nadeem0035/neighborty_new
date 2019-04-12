<?php if(count($teams)) { ?>
    <div id="team" class="detail-block target-block houzez-module" style="margin-top:25px; padding:20px 0px;  background-color:transparent">
        <div id="agents-carousel-module" class="agents-carousel-module">
            <div class="row">
                <div class="col-sm-12">
                    <div class="module-title-nav clearfix">
                        <div><h2>Agents Team</h2></div>
                        <div class="module-nav">
                            <a href="<?=site_url('agents/all_agents');?>" class="btn btn-sm">View All</a>
                            <button class="btn btn-sm btn-crl-agents-prev">Prev</button>
                            <button class="btn btn-sm btn-crl-agents-next">Next</button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                <div id="agents-carousel" class="agents-carousel">
                    <?php foreach ($teams as $team):?>
                        <div class="item">
                        <div class="agents-block">
                            <figure class="auther-thumb">
                                <?php

                                if(file_exists('assets/media/users_avatar/' . $team->picture) == FALSE || $team->picture == null){
                                    $folder = "";
                                    $pic = 'placeholder.png';
                                }else{

                                    $folder="medium/";
                                    $pic = $team->picture;
                                }

                                ?>

                                <img src="<?= base_url() .'assets/media/users_avatar/'.$folder. $pic; ?>" alt="<?=ucfirst($team->first_name) .' '. ucfirst($team->last_name)?>" width="150" height="150" class="img-circle">
                            </figure>
                            <div class="block-body">
                                <p class="auther-info">
                                    <a href="<?=site_url('agent/profile/'.$team->id);?>" class="text-primary"><?=ucfirst($team->first_name) .' '. ucfirst($team->last_name)?></a>
                                    <span><?=$team->agent_type;?></span>
                                </p>
                            </div>
                        </div>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
            </div>
        </div>
    </div>
<?php } ?>