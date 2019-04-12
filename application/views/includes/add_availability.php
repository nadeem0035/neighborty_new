<div id="response"></div>
<div class="profile-area account-block white-block add-availab">
    <h4>Ajouté disponibilité</h4>
    <form class="availability_form" method="POST" action="#" id="add_appointment">
        <!--<div class="col-sm-3 col-xs-12">
            <div class="form-group">
                <label class="control-label" for="fullname">Titre</label>
                <input type="text" class="form-control" required name="title" value="" placeholder="title">
            </div>
        </div>-->
        <div class="col-sm-3 col-xs-12">
            <div class="form-group">
                <label class="control-label" for="fullname"> Date</label>
                <div class="input-group adddate">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input class="form-control" id="property-year-built" name="appointment_date" type="" placeholder="select date">
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-xs-12">
            <div class="form-group">
                <label class="control-label" for="fullname"> Heure de début</label>
                <div class="input-group addtime">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input class="form-control" id="property-year-built" name="time_from" placeholder="select time">
                </div>
            </div>
        </div>


        <div class="col-sm-3 col-xs-12">
            <div class="form-group">
                <label class="control-label" for="fullname"> Heure de fin</label>
                <div class="input-group addtime">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input class="form-control" id="property-year-built" name="time_to" placeholder="select time">
                </div>
            </div>
            <div id="timeres"></div>
        </div>

        <div class="col-sm-2 col-xs-12">
            <div class="form-group">
                <label class="control-label" for="fullname">&nbsp; &nbsp;</label>
                <button type="submit" class="btn btn-block btn-primary">Ajouté</button>
            </div>
        </div>
    </form>
</div>