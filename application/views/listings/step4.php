<?php
$id= $this->uri->segment(3);
$attributes = array('class' => 'form-horizontal', 'id' => 'pdocuments','name'=>'pdocuments');
echo form_open_multipart('listings/edit/' . $id . '?step=5', $attributes);
?>
<input type="hidden" name="listing_id" value="<?= @$listing->id; ?>">
<input type="hidden" name="pdocuments" value="pdocuments" />
<div class="account-block">
    <div class="add-title-tab">
        <h3>Property Documents</h3>
        <div class="add-expand"></div>
    </div>
    <div class="add-tab-content">
        <div class="add-tab-row push-padding-bottom">
            <table class="add-sort-table">
                <thead>
                <tr>
                    <td class="row-sort" width="15"></td>
                    <td class="sort-middle"></td>
                    <td class="row-remove" width="15"></td>
                </tr>
                </thead>
                <tbody>
                <?php if(count($documents) > 0) { ?>
                    <input type="hidden" name="listing_id" value="<?= @$listing->id; ?>">
                    <?php foreach($documents as $docs):?>
                        <tr class="row_<?=$docs->id;?>">
                        <td class="row-sort"></td>
                        <td class="sort-middle">
                            <div class="sort-inner-block">
                                <div class="row">
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="form-group"><label for="planTitle">Title</label><input value="<?=$docs->title;?>" name="doc_title[]" type="text" id="" class="form-control"></div>
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label for="planImage">Document

                                                <?php if($docs->picture != ''){ ?>
                                                    <span>( <a href="<?= base_url() ?>assets/media/listings/floor/<?= $docs->picture ?>" target="_blank">View Document</a> )</span>
                                                <?php } ?>

                                            </label>

                                            <div class="file-upload-block">
                                                <input name="docFile[]" type="file" id="planImage" class="form-control" placeholder="Upload Document">
                                                <!--<button class="btn btn-primary">Select</button>-->
                                            </div>
                                            <!--<input type="file" name="docFile[]" class="file">
                                            <div class="file-upload-block"><input name="" type="text" id="planImage" class="form-control" disabled placeholder="Upload Document"><button class="browse btn btn-primary" type="button">Select</button></div>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="row-remove"><span id="<?=$docs->id;?>" onclick="deleteAppointment(this.id)" class="remove"><i class="fa fa-remove"></i></span></td>
                        </tr>
                    <?php endforeach;?>

                <?php } else{ ?>
                <tr>
                    <td class="row-sort"></td>
                    <td class="sort-middle">
                        <div class="sort-inner-block">
                            <div class="row">
                                <div class="col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="planTitle">Title</label>
                                        <input name="doc_title[]" type="text" id="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-xs-6">
                                    <div class="form-group">
                                        <label for="planImage">Document</label>
                                        <div class="file-upload-block">
                                            <input name="docFile[]" type="file" id="planImage" class="form-control" placeholder="Upload Document">
                                            <!--<button class="btn btn-primary">Select</button>-->
                                        </div>

                                        <!--<input type="file" name="docFile[]" class="file">
                                        <div class="file-upload-block">
                                            <input  type="text" id="planImage" class="form-control" disabled placeholder="Upload Image">
                                            <button class="browse btn btn-primary" type="button">Select</button>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="row-remove"></td>
                </tr>
                <?php } ?>
                </tbody>
                <tbody id="add-attachment"></tbody>
                <tfoot>
                <td class="row-sort"></td>
                <td class="sort-middle"><a href="javascript:void(0)" class="btn btn-primary" title="Add Document" data-title="Add Document" onclick="addDocument()" id="addmore_media"><i class="fa fa-plus"></i> Ajouter plus</a></td>
                <td class="row-remove"></td>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div class="account-block text-right">
    <button type="submit" name="pdocuments" value="floor_plans" class="btn btn-primary">Continue</button>
</div>
</form>


