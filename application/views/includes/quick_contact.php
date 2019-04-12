<div class="modal fade" id="quick_contact_<?=$id;?>" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content host-modal">
            <div class="modal-header host-modal-header">
                <h4 class="modal-title">Prendre contact avec "<?=$name;?>"</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body host-modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3" style="padding:0px;">

                            <figure style="margin-bottom:0px;">
                                <a href="<?=site_url()?>agent/profile/<?=$id?>">
                                    <img src="<?=$image;?>" alt="Agent Thumb" width="350" height="350">
                                </a>
                            </figure>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group"><div id="contact_response_<?= $id ?>"></div></div>
                            <form id="contacthostform_<?= $id ?>" method="post">
                                <input type="hidden" value="<?=$id;?>" name="receiver_id">
                                <div class="form-group">
                                    <input type="text" placeholder="Votre nom" class="form-control" name="fullname" required>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <input type="email" placeholder="Email" class="form-control" name="email" required>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <input type="number" placeholder="Téléphone" class="form-control" name="phone" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <textarea required name="message" rows="3" class="form-control">Bonjour <?= $name;?>, J’ai vu votre profil sur neighborty.fr j’aimerais savoir si vous pouvez m’aider s’il vous plait ?</textarea>
                                </div>
                                <a id="<?=$id ?>" href="javascript:void(0)" onclick="validateQuickContactForm(this.id)" class="btn btn-secondary btn-block">Envoyé Un Message </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>