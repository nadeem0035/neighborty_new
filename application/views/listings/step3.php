<div class="membership-content-area">
    <div class="membership-done-block white-block">
        <div class="done-block-inner">
            <div class="done-icon"><i class="fa fa-check"></i></div>
            <h2><?=$this->lang->line('al_thankyou');?></h2>
            <p><?=$this->lang->line('al_verify_by_admin');?></p>
            <a href="<?= site_url("listings") ?>" class="btn btn-primary btn-long"><?=$this->lang->line('al_see_listing');?></a>
            <a target="_blank" href="<?=site_url("property/".$listing->slug.'-'.$listing->id)?>" class="btn btn-primary btn-long"><?=$this->lang->line('al_preview');?></a>
        </div>
    </div>
</div>