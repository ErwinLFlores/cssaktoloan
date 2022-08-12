<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<p>This is a basic form wizard example that inherits the colors from the selected scheme.</p>
<div class="container-fluid" style="background-color:white;">
    <?= $this->Form->create('Register SAP', ['type' => 'post', 'url' => '/sap/add', 'enctype' => "multipart/form-data"]); ?>
        <div class="row ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?= $this->Flash->render(); ?>
            </div>
            <div id="wizard_verticle" class="cform_wizard wizard_verticle col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <ul class="list-unstyled wizard_steps">
                    <li>
                        <a href="#step-11">
                            <span class="step_no">1</span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-22">
                            <span class="step_no">2</span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-33">
                            <span class="step_no">3</span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-44">
                            <span class="step_no">4</span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-55">
                            <span class="step_no">5</span>
                        </a>
                    </li>
                </ul>
                <div id="step-11">
                    <h2 class="StepTitle">Step 1 of 5 - <b>Personal Information</b></h2>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="firstname">
                            FIRST NAME <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input name="firstname" type="text" required="required" 
                                class="form-control" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="middlename" class="col-form-label col-md-3 col-sm-3 label-align">
                            MIDDLE NAME</label>
                        <div class="col-md-6 col-sm-6">
                            <input name="middlename" class="form-control " type="text" 
                                oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="lastname">
                            LAST NAME <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input name="lastname" type="text" required="required" 
                                class="form-control" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-group row" style="margin-bottom:5px;">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="gender">
                            GENDER <span class="required">*</span></label> 
                        <div class="col-md-6 col-sm-6 input-group">
                            <select id="gender" name="gender" class="form-control select2" required>
                                <option value="" selected disabled>SELECT...</option>
                                <?php foreach ($gender->categories_items as $key => $status) { ?>
                                    <option value="<?=h($status->merge_value);?>"><?=h($status->name);?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" style="margin-bottom:5px;">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="civil_status">
                            CIVIL STATUS <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 input-group">
                            <select id="civil_status" name="civil_status" class="form-control" required>
                                <option value="" selected disabled>SELECT...</option>
                                <?php foreach ($civil_status->categories_items as $key => $status) { ?>
                                    <option value="<?=h($status->merge_value);?>"><?=h($status->name);?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="birthdate">
                            BIRTH DATE <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input name="birthdate" class="form-control" required="required" type="date">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="mobile_number">
                            CELLPHONE NUMBER <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input type="tel" id="mobile_number" name="mobile_number" required="required" 
                                pattern="09[0-9]{2}-[0-9]{4}-[0-9]{3}"
                                maxlength="13" data-toggle="tooltip"
                                title="Format: 09##-####-###"
                                class="form-control">
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="id_type">
                            ID TYPE <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input name="id_type" type="text" required="required" 
                                class="form-control" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="id_number">
                            ID NUMBER<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input name="id_number" type="text" required="required" 
                                class="form-control" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                </div>
                <div id="step-22">
                    <h2 class="StepTitle">Step 2 of 5 - <b>Address and House Type</b></h2>
                    <div class="form-group row" style="margin-bottom:5px;">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="house_type">
                            HOUSE TYPE <span class="required">*</span></label> 
                        <div class="col-md-6 col-sm-6 input-group">
                            <select id="house_type" name="house_type" class="form-control select2" required>
                                <option value="" selected disabled>SELECT...</option>
                                <?php foreach ($house_type->categories_items as $key => $status) { ?>
                                    <option value="<?=h($status->merge_value);?>"><?=h($status->name);?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="purok">
                            PUROK <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input name="purok" type="text" required="required" 
                                class="form-control" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="house_number">
                            HOUSE NUMBER <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input name="house_number" type="text" required="required" 
                                class="form-control" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="street">
                            STREET <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input name="street" type="text" required="required" 
                                class="form-control" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="sitio">
                            SITIO / SUBDIVISION <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input name="sitio" type="text" required="required" 
                                class="form-control" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="barangay">
                            BARANGAY <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input name="barangay" type="text" required="required" 
                                class="form-control" value="BALIBAGO" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="city">
                            CITY <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input name="city" type="text" required="required" 
                                class="form-control" value="ANGELES" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="province">
                            PROVINCE <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input name="province" type="text" required="required" 
                                class="form-control" value="PAMPANGA" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="region">
                            REGION <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input name="region" type="text" required="required" 
                                class="form-control" value="CENTRAL LUZON" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                </div>
                <div id="step-33">
                    <h2 class="StepTitle">Step 3 of 5 - <b>Health and Work Information</b></h2>
                    <div class="form-group row" style="margin-bottom:5px;">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="health_condition">
                            HEALTH CONDITION <span class="required">*</span></label> 
                        <div class="col-md-6 col-sm-6 input-group">
                            <select id="health_condition" name="health_condition" class="form-control select2" required>
                                <option value="" selected disabled>SELECT...</option>
                                <?php foreach ($health_condition->categories_items as $key => $status) { ?>
                                    <option value="<?=h($status->merge_value);?>"><?=h($status->name);?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="ethnic_group">
                            ETHNIC GROUP <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input id="ethnic_group" name="ethnic_group" type="text" required="required" 
                                class="form-control" value="NONE" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-group row" style="margin-bottom:5px;">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="beneficiary">
                            BENEFICIARY <span class="required">*</span></label> 
                        <div class="col-md-6 col-sm-6 input-group">
                            <select id="beneficiary" name="beneficiary" class="form-control select2" required>
                                <option value="" selected disabled>SELECT...</option>
                                <?php foreach ($beneficiary->categories_items as $key => $status) { ?>
                                    <option value="<?=h($status->merge_value);?>"><?=h($status->name);?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group row" style="margin-bottom:5px;">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="sector">
                            SECTOR <span class="required">*</span></label> 
                        <div class="col-md-6 col-sm-6 input-group">
                            <select id="sector" name="sector" class="form-control select2" required>
                                <option value="" selected disabled>SELECT...</option>
                                <?php foreach ($sector->categories_items as $key => $status) { ?>
                                    <option value="<?=h($status->merge_value);?>"><?=h($status->name);?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="work">
                            WORK <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input id="work" name="work" type="text" required="required" 
                                class="form-control" value="" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="place_of_work">
                            PLACE OF WORK <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input id="place_of_work" name="place_of_work" type="text" required="required" 
                                class="form-control" value="" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="monthly_salary">
                            MONTHLY SALARY <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input id="monthly_salary" name="monthly_salary" type="number" required="required" 
                                class="form-control" value="0" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                </div>
                <div id="step-44">
                    <h2 class="StepTitle">Step 4 of 5 - <b>Other Information</b></h2>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="picture">
                            User Photo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" id="picture" name="picture" 
                                type="file" required="required"/>
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="id_picture">
                            ID Photo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" id="id_picture" name="id_picture" 
                                type="file" required="required"/>
                        </div>
                    </div>
                </div>
                <div id="step-55">
                    <h2 class="StepTitle">
                        <div class="col-md-9">
                            Step 5 of 5 - <b>Add Family Members</b>
                        </div>
                        <div class="col-md-3 no-padding" style="text-align:right;margin-bottom:10px;">
                            <button type="button" class="btn btn-warning btn-xs" 
                                id="btn_add_row" style="padding:5px;font-size:10px;font-weigh:bold;">ADD ROW</button>
                        </div>
                        <hr/>
                    </h2> 
                    <style>
                        .member_row {
                            font-size: 9px;
                            padding: 0px;
                            margin: 0px;
                            min-height: 23px;
                        }
                    </style>
                    <div id="row_container" class="form-group row" style="max-height:515px;overflow-y:auto;">
                        <div class="col-md-12 no-padding">
                            <div class="col-md-3 col-xs-12 no-padding">
                                <div class="form-group label-floating">
                                    <label class="member_row control-label" style="height:22px;">FULL NAME</label>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-12 no-padding">
                                <div class="form-group label-floating">
                                    <label class="member_row control-label">RELATION </label>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-12 no-padding">
                                <div class="form-group label-floating">
                                    <label class="member_row control-label">BIRTHDATE </label>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-12 no-padding">
                                <div class="form-group label-floating">
                                    <label class="member_row control-label">GENDER </label>
                                </div>
                            </div>
                            <div class="col-md-2 col-xs-12 no-padding">
                                <div class="form-group label-floating">
                                    <label class="member_row control-label">WORK</label>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 no-padding">
                                <div class="form-group label-floating">
                                    <label class="member_row control-label">SECTOR </label>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-12 no-padding">
                                <div class="form-group label-floating">
                                    <label class="member_row control-label">HEALTH CONDITION </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?= $this->Form->end(); ?>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#gender').select2();
        $('#civil_status').select2();
        $('#house_type').select2();
        $('#beneficiary').select2();
        $('#sector').select2();
        $('#health_condition').select2();
    });

    var i = 1;
    $("#btn_add_row").click(function(){
        $("#row_container").append(addNewRow(i));
        i++;
    });

    function addNewRow(i){
        var newrow = '<div class="col-md-12 no-padding">' +
            '<div class="col-md-3 col-xs-12 no-padding">' +
                '<div class="form-group label-floating">' +
                    '<input type="text" class="member_row form-control" ' +
                        'style="font-size:9px;height:28px;" oninput="this.value = this.value.toUpperCase()"' +
                        'name="family_member[' + i + '][fullname]">' +
                '</div>' +
            '</div>' +
            '<div class="col-md-1 col-xs-12 no-padding">' +
                '<div class="form-group label-floating">' +
                    '<input name="family_member[' + i + '][relation] oninput="this.value = this.value.toUpperCase()"" ' +
                        'style="font-size:9px;height:28px;"' +
                        'type="text" class="member_row form-control">' +
                '</div>' +
            '</div>' +
            '<div class="col-md-1 col-xs-12 no-padding">' +
                '<div class="form-group label-floating">' +
                    '<input name="family_member[' + i + '][birthdate]" oninput="this.value = this.value.toUpperCase()"' +
                        'style="font-size:9px;height:28px;padding:0px;"' +
                        'type="date" class="member_row form-control">' +
                '</div>' +
            '</div>' +
            '<div class="col-md-1 col-xs-12 no-padding">' +
                '<div class="form-group label-floating">' +
                    '<select name="family_member[' + i + '][gender]" class="member_row form-control select2">' +
                        '<option value="" selected disabled>SELECT...</option>' +
                        <?php foreach ($gender->categories_items as $key => $status) { ?>
                            '<option value="<?=h($status->merge_value);?>"><?=h($status->name);?></option>' +
                        <?php } ?>
                    '</select>' +
                '</div>' +
            '</div>' +
            '<div class="col-md-2 col-xs-12 no-padding">' +
                '<div class="form-group label-floating">' +
                    '<input type="text" class="member_row form-control" oninput="this.value = this.value.toUpperCase()"' +
                        'style="font-size:9px;height:28px;"' +
                        'name="family_member[' + i + '][work]">' +
                '</div>' +
            '</div>' +
            '<div class="col-md-3 col-xs-12 no-padding">' +
                '<div class="form-group label-floating">' +
                    '<select name="family_member[' + i + '][sector]" class="member_row form-control select2">' +
                        '<option value="" selected disabled>SELECT...</option>' +
                        <?php foreach ($sector->categories_items as $key => $status) { ?>
                            '<option value="<?=h($status->merge_value);?>"><?=h($status->name);?></option>' +
                        <?php } ?>
                    '</select>' +
                '</div>' +
            '</div>' +
            '<div class="col-md-1 col-xs-12 no-padding">' +
                '<div class="form-group label-floating">' +
                    '<select name="family_member[' + i + '][health_condition]" class="member_row form-control select2">' +
                        '<option value="" selected disabled>SELECT...</option>' +
                        <?php foreach ($health_condition->categories_items as $key => $status) { ?>
                            '<option value="<?=h($status->merge_value);?>"><?=h($status->name);?></option>' +
                        <?php } ?>
                    '</select>' +
                '</div>' +
            '</div>' +
        '</div>';

        return newrow;
    }
</script>
