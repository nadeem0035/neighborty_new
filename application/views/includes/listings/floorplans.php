<!-- <?php /*if (count($floorplans) > 0) { */?>
                                    <div class="property-plans detail-block" style="display: none">

                                        <div class="detail-title"><h2 class="title-left">Floor plans(<?/*=count($floorplans);*/?>)</h2></div>
                                        <div class="accord-block">
                                            <?php /*foreach ($floorplans as $floor): */?>

                                                <div class="accord-tab">
                                                    <h3><?/*= $floor->title; */?></h3>
                                                    <ul>
                                                        <li>Size: <strong><?/*= $floor->size; */?> sqft</strong></li>
                                                        <li>Beds: <strong><?/*= $floor->beds; */?></strong></li>
                                                        <li>Baths: <strong><?/*= $floor->bath; */?></strong></li>
                                                        <li>Price: <strong>Rs<?/*= $floor->price; */?></strong></li>
                                                    </ul>
                                                    <div class="expand-icon <?/*= ($inc == 1 ? 'active' : ''); */?>"></div>
                                                </div>

                                                <div class="accord-content"
                                                     style="<?/*= ($inc == 1 ? 'display: block' : ''); */?>;padding: 0">
                                                    <img src="<?/*= base_url() */?>assets/media/listings/floor/<?/*= $floor->picture */?>"
                                                         alt="img" width="100%" height="436">
                                                </div>
                                            <?php /*endforeach; */?>
                                        </div>


                                    </div>
                                <?php /*} */?>