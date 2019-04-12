<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
    <body>
<?php $this->load->view('dashboard/dashboard-header'); ?>

    <section id="section-body">
        <div class="container">
            <div class="page-title" style="display:none;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-left">
                            <h1 class="title-head"><?=$this->lang->line('welcome');?>, <?=$_SESSION['logged_in']['full_name']?></h1>
                        </div>
                        <div class="page-title-right">
                            <ol class="breadcrumb"><li><a href="#"><i class="fa fa-home"></i></a></li><li class="active"><?=$this->lang->line('edit_profile');?></li></ol>
                        </div>
                    </div>
                    <?php $this->load->view('templates/activation_notice');?>
                </div>
            </div>

            <div class="user-dashboard-full">

                <?php $this->load->view('dashboard/dashboard-sidebar'); ?>
                <div class="profile-area-content">
                    <div class="profile-area account-block white-block">
                        <?php
                        $attributes = array('class' => 'form','id' => 'edit_profile');
                        echo form_open('users/edit-profile', $attributes);
                        ?>
                        <div class="row">
                            <?php if (validation_errors()) : ?>
                                <div class="alert alert-danger">
                                    <button class="close" data-close="alert"></button>
                                    <span><?= validation_errors() ?> </span>
                                </div>

                            <?php endif; ?>

                            <?php if (isset($error)) : ?>
                                <div class="alert alert-danger">
                                    <button class="close" data-close="alert"></button>
                                    <span><?= $error ?> </span>
                                </div>

                            <?php endif; ?>

                            <?php if (isset($success)) : ?>
                                <div class="alert alert-success">
                                    <button class="close" data-close="alert"></button>
                                    <span><?= $success; ?> </span>
                                </div>

                            <?php endif;?>



                           <div class="col-md-4">
                                <div class="my-avatar">
                                    <?php
                                    $session_data = $this->session->userdata('logged_in');
                                    $uid = $session_data['id'];

                                    // pre($session_data);
                                    if(file_exists(FCPATH.$session_data['picture']))
                                    {
                                        ?>
                                        <img id="crop_preview" class="user-image first_preview" src="<?=base_url($session_data['picture']); ?>" alt="<?=$user->first_name ?>">
                                        <?php
                                    }

                                    else
                                    {
                                        ?>
                                        <img id="crop_preview" class="user-image" src="<?=base_url();?>assets/media/users_avatar/placeholder.png" alt="<?=$user->first_name ?>">
                                        <?php
                                    }
                                    ?>


                                    <input class="btn btn-primary btn-block" type="file" id="upload_userfile" name="upload_userfile" accept="image/*" placeholder="Upload a profile image">
                                    <input type="hidden" id="croped_image" name="croped_image">
                                    <input type="hidden" name="old_image" value="<?=$user->picture?>">
                                    <div class="clearfix"></div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <h4><?=$this->lang->line('edit_profile');?></h4>
                                <div class="row">


                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label"><?=$this->lang->line('first_name');?><span class="required" aria-required="true">* </span></label>
                                            <input type="text" class="form-control" name="user[first_name]" required value="<?= $user->first_name ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label"><?=$this->lang->line('last_name');?><span class="required" aria-required="true">* </span></label>
                                            <input type="text" class="form-control" name="user[last_name]" required value="<?= $user->last_name ?>">
                                        </div>
                                    </div>
                                    <!-- <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">I am <span class="required" aria-required="true">* </span></label>
                                            <select class="form-control" name="user[gender]">
                                                <option <?=$user->gender == 'Male' ? "selected" : ''?> value="Male">Male</option>
                                                <option <?=$user->gender == 'Female' ? "selected" : ''?> value="Female">Female</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label"><?=$this->lang->line('email');?><span class="required" aria-required="true">* </span></label>
                                            <input type="text" class="form-control" readonly value="<?= $user->email ?>">
                                        </div>
                                    </div>

                                    <?php if($_SESSION['logged_in']['user_type'] =='Renter') { ?>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label"><?=$this->lang->line('phone');?> </label>
                                                <input type="text" class="form-control" name="user[phone]" value="<?= @$user->phone ?>">
                                            </div>
                                        </div>

                                    <?php } else{ ?>


                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label"><?=$this->lang->line('phone');?> <span class="required" aria-required="true">* </span></label>
                                                <input type="phone" class="form-control" name="user[phone]"  required value="<?= @$user->phone ?>">
                                            </div>
                                        </div>


                                    <?php } ?>



                                    <?php if($_SESSION['logged_in']['user_type'] =='Renter') { ?>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">City<span class="required" aria-required="true">* </span></label>
                                                <select id="user_city" name="user_city" class="form-control" data-show-subtext="true" data-live-search="true">
                                                    <?php foreach($cities as $city):?>
                                                        <option <?=($city->id == $user->city) ? 'selected' : '';?> value="<?=$city->id;?>"><?=$city->name;?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Area</label>
                                                <div class="user_area">
                                                    <select id="user_area" name="user_area" class="form-control" data-show-subtext="true" data-live-search="true">
                                                        <?php foreach($user_areas as $area):?>
                                                            <option <?=($area->id == $user->area) ? 'selected' : '';?> value="<?=$area->id;?>"><?=$area->area_name;?></option>
                                                        <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>

                                       <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">City<span class="required" aria-required="true">* </span></label>
                                                <select id="user_city" name="user_city" class="form-control" data-show-subtext="true" data-live-search="true">
                                                    <?php foreach($cities as $city):?>
                                                        <option <?=($city->id == $user->city) ? 'selected' : '';?> value="<?=$city->id;?>"><?=$city->name;?></option>
                                                    <?php endforeach;?>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label class="control-label">Area</label>
                                                <div class="user_area">
                                                    <select id="user_area" name="user_area" class="form-control" data-show-subtext="true" data-live-search="true">
                                                    <?php foreach($user_areas as $area):?>
                                                        <option <?=($area->id == $user->area) ? 'selected' : '';?> value="<?=$area->id;?>"><?=$area->area_name;?></option>
                                                    <?php endforeach;?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                    <?php } ?>


                                    <div class="col-sm-4" style="display:none;">
                                        <div class="form-group">
                                            <label class="control-label"><?=$this->lang->line('language');?></label>

                                          <?php
                                           $languages_list = array(
                                                ('Afrikaans')=>'Afrikaans',('Albanian')=>'Albanian', ('Amharic')=>'Amharic', ('Arabic (Egyptian Spoken)')=>'Arabic (Egyptian Spoken)', ('Arabic (Levantine)')=>'Arabic (Levantine)', ('Arabic (Modern Standard)')=>'Arabic (Modern Standard)', ('Arabic (Moroccan Spoken)')=>'Arabic (Moroccan Spoken)', ('Arabic (Overview)')=>'Arabic (Overview)', ('Aramaic')=>'Aramaic', ('Armenian')=>'Armenian', ('Assamese')=>'Assamese', ('Aymara')=>'Aymara', ('Azerbaijani')=>'Azerbaijani', ('Balochi')=>'Balochi', ('Bamanankan')=>'Bamanankan', ('Bashkort (Bashkir)')=>'Bashkort (Bashkir)', ('Basque')=>'Basque', ('Belarusan')=>'Belarusan', ('Bengali')=>'Bengali', ('Bhojpuri')=>'Bhojpuri', ('Bislama')=>'Bislama', ('Bosnian')=>'Bosnian', ('Brahui')=>'Brahui', ('Bulgarian')=>'Bulgarian', ('Burmese')=>'Burmese', ('Cantonese')=>'Cantonese', ('Catalan')=>'Catalan', ('Cebuano')=>'Cebuano', ('Chechen')=>'Chechen', ('Cherokee')=>'Cherokee', ('Croatian')=>'Croatian', ('Czech')=>'Czech', ('Dakota')=>'Dakota', ('Danish')=>'Danish', ('Dari')=>'Dari', ('Dholuo')=>'Dholuo', ('Dutch')=>'Dutch', ('English')=>'English', ('Esperanto')=>'Esperanto', ('Estonian')=>'Estonian', ('Éwé')=>'Éwé', ('Finnish')=>'Finnish', ('French')=>'French', ('Georgian')=>'Georgian', ('German')=>'German', ('Gikuyu')=>'Gikuyu', ('Greek')=>'Greek', ('Guarani')=>'Guarani', ('Gujarati')=>'Gujarati', ('Haitian Creole')=>'Haitian Creole', ('Hausa')=>'Hausa', ('Hawaiian')=>'Hawaiian', ('Hawaiian Creole')=>'Hawaiian Creole', ('Hebrew')=>'Hebrew', ('Hiligaynon')=>'Hiligaynon', ('Hindi')=>'Hindi', ('Hungarian')=>'Hungarian', ('Icelandic')=>'Icelandic', ('Igbo')=>'Igbo', ('Ilocano')=>'Ilocano', ('Indonesian (Bahasa Indonesia)')=>'Indonesian (Bahasa Indonesia)', ('Inuit/Inupiaq')=>'Inuit/Inupiaq', ('Irish Gaelic')=>'Irish Gaelic', ('Italian')=>'Italian', ('Japanese')=>'Japanese', ('Jarai')=>'Jarai', ('Javanese')=>'Javanese', ('K\'iche\'')=>'K\'iche\'', ('Kabyle')=>'Kabyle', ('Kannada')=>'Kannada', ('Kashmiri')=>'Kashmiri', ('Kazakh')=>'Kazakh', ('Khmer')=>'Khmer', ('Khoekhoe')=>'Khoekhoe', ('Korean')=>'Korean', ('Kurdish')=>'Kurdish', ('Kyrgyz')=>'Kyrgyz', ('Lao')=>'Lao', ('Latin')=>'Latin', ('Latvian')=>'Latvian', ('Lingala')=>'Lingala', ('Lithuanian')=>'Lithuanian', ('Macedonian')=>'Macedonian', ('Maithili')=>'Maithili', ('Malagasy')=>'Malagasy', ('Malay (Bahasa Melayu)')=>'Malay (Bahasa Melayu)', ('Malayalam')=>'Malayalam', ('Mandarin (Chinese)')=>'Mandarin (Chinese)', ('Marathi')=>'Marathi', ('Mende')=>'Mende', ('Mongolian')=>'Mongolian', ('Nahuatl')=>'Nahuatl', ('Navajo')=>'Navajo', ('Nepali')=>'Nepali', ('Norwegian')=>'Norwegian', ('Ojibwa')=>'Ojibwa', ('Oriya')=>'Oriya', ('Oromo')=>'Oromo', ('Pashto')=>'Pashto', ('Persian')=>'Persian', ('Polish')=>'Polish', ('Portuguese')=>'Portuguese', ('Punjabi')=>'Punjabi', ('Quechua')=>'Quechua', ('Romani')=>'Romani', ('Romanian')=>'Romanian', ('Russian')=>'Russian', ('Rwanda')=>'Rwanda', ('Samoan')=>'Samoan', ('Sanskrit')=>'Sanskrit', ('Serbian')=>'Serbian', ('Shona')=>'Shona', ('Sindhi')=>'Sindhi', ('Sinhala')=>'Sinhala', ('Slovak')=>'Slovak', ('Slovene')=>'Slovene', ('Somali')=>'Somali', ('Spanish')=>'Spanish', ('Swahili')=>'Swahili', ('Swedish')=>'Swedish', ('Tachelhit')=>'Tachelhit', ('Tagalog')=>'Tagalog', ('Tajiki')=>'Tajiki', ('Tamil')=>'Tamil', ('Tatar')=>'Tatar', ('Telugu')=>'Telugu', ('Thai')=>'Thai', ('Tibetic languages')=>'Tibetic languages', ('Tigrigna')=>'Tigrigna', ('Tok Pisin')=>'Tok Pisin', ('Turkish')=>'Turkish', ('Turkmen')=>'Turkmen', ('Ukrainian')=>'Ukrainian', ('Urdu')=>'Urdu', ('Uyghur')=>'Uyghur', ('Uzbek')=>'Uzbek', ('Vietnamese')=>'Vietnamese', ('Warlpiri')=>'Warlpiri', ('Welsh')=>'Welsh', ('Wolof')=>'Wolof', ('Xhosa')=>'Xhosa', ('Yakut')=>'Yakut', ('Yiddish')=>'Yiddish', ('Yoruba')=>'Yoruba', ('Yucatec')=>'Yucatec', ('Zapotec')=>'Zapotec', ('Zulu')=>'Zulu',
                                            );
                                            ?>

                                            <select name="user[languages][]" class="form-control selectpicker" data-live-search="true" multiple>
                                                <?php

                                                $array = explode(',', $user->languages);
                                                foreach ($languages_list as $key => $value)
                                                {
                                                    ?>
                                                    <?php if (in_array($key, $array)) { ?>
                                                    <option selected  value="<?=$key?>"><?=$value?></option>
                                                    <?php } else { ?>
                                                    <option value="<?=$key?>"><?=$value?></option>
                                                    <?php } ?>
                                                    <?php
                                              }
                                                ?>
                                            </select>

                                        </div>

                                        </div>


                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label"><?=$this->lang->line('want_to_find');?></label>
                                            <textarea class="form-control" rows="7" name="user[about]" placeholder="ie: I'm moving from Seattle to Houston and am looking for a great 1-bedroom under $1000 for myself and my dog :)"><?= @strip_tags($user->about) ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-xs-12 text-right form-actions">
                                <input type="submit" class="btn btn-primary" value="<?=$this->lang->line('save_profile');?>" />
                            </div>
                        </div>

                        <!--<div class="row"><div class="col-md-12" style="margin-top:30px;"><hr></div></div>-->

                        </form>

                    </div>


                    <?php if (isset($success_password)) : ?>
                        <div class="alert alert-success" style="margin-top: 20px;">
                            <button class="close" data-close="alert"></button>
                            <span><?=$success_password; ?> </span>
                        </div>

                    <?php endif;?>



                    <div class="account-block">
                        <div class="add-title-tab">
                            <h3><?=$this->lang->line('change_password');?></h3>
                            <div class="add-expand"></div>
                        </div>
                        <div class="add-tab-content">
                            <div class="add-tab-row">
                                <p style="font-size:13px;"><strong>Tip:</strong><?=$this->lang->line('tip_text');?></p>

                                <?php $attributes = array('class' => 'form'); echo form_open('users/password-update', $attributes); ?>

                                <div class="row">
                                    <div class="col-md-12">
                                        <!-- <?php if (validation_errors()) : ?>
                                <div class="alert alert-danger">
                                    <button class="close" data-close="alert"></button>
                                    <span><?= validation_errors() ?> </span>
                                </div>

                                <?php endif; ?>
                                <?php if (isset($error)) : ?>
                                    <div class="alert alert-danger">
                                        <button class="close" data-close="alert"></button>
                                        <span><?= $error ?> </span>
                                    </div>

                                <?php endif; ?>

                                <?php if (isset($success)) : ?>
                                    <div class="alert alert-success">
                                        <button class="close" data-close="alert"></button>
                                        <span><?= $success; ?> </span>
                                    </div>

                                <?php endif; ?> -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label"><?=$this->lang->line('oldpassword');?></label>
                                            <input type="password" name="oldpassword" required class="form-control" placeholder="<?=$this->lang->line('oldpassword');?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label"><?=$this->lang->line('password');?></label>
                                            <input type="password" name="password" required class="form-control" placeholder="<?=$this->lang->line('password');?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label"><?=$this->lang->line('rpassword');?></label>
                                            <input type="password" name="rpassword" required class="form-control" placeholder="<?=$this->lang->line('rpassword');?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <button type="submit" class="btn btn-primary"><?=$this->lang->line('change_pass');?></button>
                                    <button type="button" class="btn default"><?=$this->lang->line('cancel');?></button>
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>
    <!--end section page body-->

<?php
$footer_data['custom_js'] = '



<script>
$(document).ready(function () {
     //LoadUserLocationMap();
    $("#upload_userfile").change(function(e)
    {
        var img = e.target.files[0];

        if(!iEdit.open(img, true, function(res)
        {
            $("#crop_preview").attr("src", res);
            $("#croped_image").val(res);
        }))
        {
            alert("Whoops! That is not an image!");
        }

    });


    $("#are_you_agent").change(function()
    {
        if(this.checked)
        {
            $("#yes_agent").show();
            $("#agent_license").attr("required", true);
        }
        else
        {
            $("#yes_agent").hide();
            $("#agent_license").val("");
            $("#agent_license").removeAttr("required");
        }
    });

});
</script>
';

$this->load->view('templates/footer', $footer_data);
?>