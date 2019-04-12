<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
    <aside id="sidebar" class="sidebar-white">
        <div class="widget widget-agent">
            <div class="widget-agent-bg"></div>
            <div class="widget-top text-center">
                <?php $session_data = $this->session->userdata('logged_in');?>
                <a href="<?= site_url() ?>agent/profile/<?= $agent->id ?>">

                    <?php
                    if(file_exists(FCPATH.$session_data['picture']))
                    {
                        ?>
                        <img src="<?=base_url($session_data['picture']); ?>" class="img-circle" alt="<?=ucwords($session_data['first_name']);?>" width="90" height="90">
                        <?php
                    }

                    else
                    {
                        ?>
                        <img src="<?=base_url();?>assets/media/users_avatar/placeholder.png" class="img-circle" alt="<?=ucwords($session_data['first_name']);?>" width="90" height="90">
                        <?php
                    }

                    ?>

                </a>
                <h3 class="widget-title">Bienvenue, <?=ucwords($session_data['first_name']);?>!</h3>
                <a href="<?=site_url('users/edit-profile');?>">Modifier votre profil</a>
            </div>


            <?php //pr($listing_stats);?>
            <div class="widget-body">
                <span class="follower_count"><?=$user->followers_count?></span>
                <p>
                    <?php if($user->followers_count == ''){ echo 'Aucune ' ;};?>
                    <?php if($user->followers_count == 1) { ?>
                        Connection
                    <?php } else { ?>
                        Connections
                    <?php } ?>
                     <strong>ajouter des amis</strong>
                </p>
                <hr>
                <span><?=$listing_stats->rental;?></span>
                <p><strong>Annonces à louer</strong></p>

                <hr>
                <span><?=$listing_stats->sales;?></span>
                <p><strong>Annonces à vendre</strong></p>


            </div>
            <div class="widget-footer">
                Neighborty vous permet de rechercher votre futur « chezvous »
            </div>
        </div>
    </aside>
    <div class="clearfix"></div>
</div>