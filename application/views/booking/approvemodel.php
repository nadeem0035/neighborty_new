<!-- Modal for Upcoming Trips -->
<div id="approvemodel<?= $booking->id; ?>" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content host-modal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title bold">Approve Booking Request</h4>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="flip-content">
                            <tr>
                                <th>Guest Name</th>
                                <th>Listing Name</th>
                                <th>Check In</th>
                                <th>Check Out</th>
                                <th>Guests</th>
                                <th>Charges</th>
                                <th>Book Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $booking->first_name . " " . $booking->last_name; ?></td>
                                <td><?= $booking->listing_name; ?></td>
                                <td><?= $booking->check_in; ?></td>
                                <td><?= $booking->check_out; ?></td>
                                <td><?= $booking->total_guest; ?></td>
                                <td>$<?= $booking->listing_charges; ?></td>
                                <td><?= $booking->book_date; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <?php
                echo form_open('booking/approve/'.$booking->id);
                ?>         			
                <div class="form-group">
                    <label class="bold">&nbsp;Key Exchange Details:</label>
                    <textarea rows="4" class="form-control keyExhangeInfoBar" name="keyExhangeInfo" placeholder="Enter Key Exchange Details"></textarea>
                </div>
                <button type="submit" class="btn btn-default">approve</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn default">Close</button>
            </div>
        </div>
    </div>
</div>