<div class="detail-block postArea">
    <div class="post-box">
        <p><a class="text" href="#">Exprimez vous, article, photo, video</a></p>


    </div>
    <?php $session_data = $this->session->userdata('logged_in');?>

    <div id="postFrom" style="display: block">
        <div class="table" style="display: none">
            <div class="table-cell">
                <a href="<?= site_url() ?>agent/profile/<?= $agent->id ?>">

                    <?php
                    if(file_exists(FCPATH.$session_data['picture']))
                    {
                        ?>
                        <img src="<?=base_url($session_data['picture']); ?>" class="img-circle" alt="<?=ucwords($session_data['first_name']);?>" width="45" height="45">
                        <?php
                    }

                    else
                    {
                        ?>
                        <img src="<?=base_url();?>assets/media/users_avatar/placeholder.png" class="img-circle" alt="<?=ucwords($session_data['first_name']);?>" width="45" height="45">
                        <?php
                    }

                    ?>
                    
                </a>
            </div>
            <div class="table-cell">
                <strong><?=ucwords($session_data['first_name']);?></strong>
                <p><?=$session_data['agent_type'];?></p>
            </div>
        </div>

         <form method="post" action="" id="write_post" enctype="multipart/form-data">
                <textarea id="desc" name="description" class="form-control" rows="3" placeholder="What's on your mind" autofocus style="resize: none;display: none"></textarea>
                <div id="test"></div>
                <hr>

                <a href="javascript:void()" class="btn btn-sm btn-primary add-article"><i class="fa fa-edit"></i> Ecrire un article</a>
                <a href="javascript:void()" class="btn btn-file btn-sm btn-primary add-image">
                    <input id="files" name="userfile" type="file">
                    <i class="fa fa-image"></i> Image
                </a>

                <a href="javascript:void()" class="btn btn-sm btn-primary add-list"><i class="fa fa-plus-circle"></i> Ajouter une annonce</a>
                <button type="submit" class="btn btn-sm btn-secondary expander pull-right post_feed_btn" disabled>Post</button>


        </form>

    </div>

</div>
<hr>