<div class="portlet-body form" id="fileupload">
    <div class="account-block">
        <div class="add-title-tab">
            <h3><?=$this->lang->line('al_image_property');?></h3>
            <div class="add-expand"></div>
        </div>
        <div class="add-tab-content">
            <div class="add-tab-row" id="fileupload">

                <div class="row">

                    <div class="col-md-5">
                        <h4 class="block">
                            <?=$this->lang->line('al_upload_photo');?>
                            <br/>
                            <span style="font-size:12px;font-weight:400!important;color:#afafaf"><?=$this->lang->line('al_need_neat_pic');?></span>
                        </h4>
                        <div class="form-group">
                            <?php
                            if( isset($listing->preview_image_url) && $listing->preview_image_url != 'listing.jpg' )
                            {
                                $pimage = base_url() . "assets/media/properties/small/" . $listing->preview_image_url;
                                $required = '';
                            }
                            else
                            {
                                $pimage = base_url() . 'assets/img/listing.jpg';
                                $required = 'required';
                            }
                            ?>
                            <div class="" id="image_preview">
                                <img id="previewing" width="150px" height="100px" src="<?= $pimage;?>" />
                            </div>
                                    <?php
                                    $id= $this->uri->segment(3);
                                    $attributes = array('class' => 'form-horizontal', 'id' => 'save_preview');
                                    echo form_open_multipart('listings/edit/' . $id . '?step=3', $attributes);
                                    ?>
                                            <span class="btn btn-primary fileinput-button upload_btn"><i class="fa fa-plus"></i> <span><?=$this->lang->line('al_browse');?> </span>
                                                <input type="file"  id="preview_file" name="listingfile" <?= $required ?> >
                                            </span>

                                    </form>


                            <div class="clearfix"></div>
                        </div>
                        <div class="clic"></div>
                        <div class="clearfix"></div>
                        <div id="listing_response" class="text-center"></div>

                    </div>


                    <div class="col-md-7">
                        <?php
                        $id= $this->uri->segment(3);
                        $attributes = array('class' => 'form-horizontal', 'id' => 'submit_form');
                        echo form_open_multipart('listings/edit/' . $id . '?step=3', $attributes);
                        ?>
                        <div class="property-media">
                            <h4 class="block">
                                <?=$this->lang->line('al_more_images');?>
                                <br/>
                                <span style="font-size:12px;font-weight:400!important;color:#afafaf"">(<?=$this->lang->line('al_minimum_size');?>)</span>
                            </h4>
                            <div class="row fileupload-buttonbar" style="margin-bottom:15px;">
                                <div class="col-lg-4">

                                    <span class="btn btn-primary fileinput-button"><i class="fa fa-plus"></i> <span><?=$this->lang->line('al_add');?></span>
                                        <input type="file" name="userfile" id="userfile"  multiple="">
                                    </span>

                                    <span class="fileupload-process"></span>
                                </div>

                                <div class="col-lg-8 fileupload-progress fade">

                                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                        <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                    </div>
                                    <div class="progress-extended"></div>
                                </div>
                            </div>
                            <div class="media-gallery">
                                <div class="row files"></div>
                            </div>
                        </div>

                        <br/>
                        <br/>
                        <div class="account-block text-right">
                            <div class="fileupload-buttonbar">
                                <button id="uploadfile" type="button" onclick="" class="btn btn-success start"><i class="fa fa-upload"></i> <span><?=$this->lang->line('al_upload_save');?>  </span></button>
                                <span class="fileupload-process"></span>

                                <button id="continue" type="submit" name="listing_images" class="btn btn-primary"><?=$this->lang->line('al_continue');?></button>
                            </div>
                        </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>








    <script id="template-upload" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}
    <div class="col-sm-3 template-upload fade">
        <figure class="gallery-thumb preview">
            {% if (!i && !o.options.autoUpload) { %}
                <span class="icon icon-fav start"><i class="fa fa-upload"></i></span>
            {% } %}
            {% if (!i) { %}
                <span class="icon icon-delete cancel"><i class="fa fa-ban"></i></span>
            {% } %}
            <span class="icon icon-loader progress"><i class="fa fa-spinner fa-spin"></i></span>
        </figure>
        <!--<p class="name">{%=file.name%}</p>-->
        <!--<p class="size">Processing...</p>-->
        <!--<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                <div class="progress-bar progress-bar-success" style="width:0%;"></div>
            </div>-->
        <span class="error text-danger label label-danger"></span>
    </div>
    {% } %}
</script>
    <script id="template-download" type="text/x-tmpl">
    {% for (var i=0, file; file=o.files[i]; i++) { %}

    <div class="col-sm-3 template-download fade">
        <figure class="gallery-thumb preview">
            {% if (file.thumbnailUrl) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}" alt="thumb"></a>
            {% } %}
            {% if (file.deleteUrl) { %}
            <span class="icon icon-delete delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}><i class="fa fa-trash"></i></span>
            <span class="icon icon-fav"><input type="checkbox" name="delete" value="1" class="toggle"></span>
            {% } else { %}

            <button class="btn yellow cancel btn-sm"><i class="fa fa-ban"></i><span>Cancel</span></button>
            {% } %}
            <span class="icon icon-loader"><i class="fa fa-spinner fa-spin"></i></span>
        </figure>
        <!--<p class="name">
                {% if (file.url) { %}
                <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>
                {% } else { %}
                <span>{%=file.name%}</span>
                {% } %}
            </p>
            {% if (file.error) { %}
            <div><span class="label label-danger">Error</span> {%=file.error%}</div>
            {% } %}-->
            <!--<span class="size">{%=o.formatFileSize(file.size)%}</span>-->
    </div>
    {% } %}
</script>
    <?php
    $footer_data['custom_js'] = '
    <script type="text/javascript">
    $("#fileupload_1[type=file]").change(function()
    {
       console.log("alert");
        $(this).simpleUpload("'.site_url('do_upload').'", {
            start: function(file)
            {
                                            //upload started
                console.log("upload started");
            },
            progress: function(progress)
            {
                                            //received progress
                console.log("upload progress: " + Math.round(progress) + "%");
            },
            success: function(data)
            {
                                            //upload successful
                console.log("upload successful!");
                console.log(data);
                                            //$json
            },
            error: function(error)
            {
                                            //upload failed
                console.log("upload error: " + error.name + ": " + error.message);
            }
        });
    });
    </script>
    ';
    ?>


</div>