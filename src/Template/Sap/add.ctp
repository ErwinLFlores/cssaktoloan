
<link href="/select2/select2.min.css" rel="stylesheet" />
<script src="/select2/select2.min.js"></script>
<style>
    table {
        display: flex;
        flex-flow: column;
        width: 100%;
    }

    thead {
        flex: 0 0 auto;
    }

    tbody {
        flex: 1 1 auto;
        display: block;
        overflow-y: auto;
        overflow-x: hidden;
        max-height: 400px;
    }

    tr {
        width: 100%;
        display: table;
        table-layout: fixed;
    }

    tbody > tr > td {
        font-size: 10px;
        padding: 5px;
    }

    .table td, .table th {
        padding: 5px;
    }

    .member_row {
        font-size: 10px;
        padding: 0px;
        margin: 0px;
        min-height: 23px;
    }

    .td_fullname { width:20%; }
    .td_relation { width:10%; }
    .td_birthdate { width:10%; }
    .td_gender { width:8%; }
    .td_work { width:12%; }
    .td_sector { width:25%; }
    .td_health_condition { width:13%; }
    .td_action { width:2%; }
</style>
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
                            <input type="text" id="mobile_number" name="mobile_number" required="required" 
                                minlength="11" maxlength="11" value="09"
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
                            <input id="monthly_salary" name="monthly_salary" type="text" required="required" 
                                class="form-control" value="NONE" oninput="this.value = this.value.toUpperCase()">
                        </div>
                    </div>
                </div>
                <div id="step-44">
                    <h2 class="StepTitle">Step 4 of 5 - <b>Other Information</b></h2>
                    <div class="form-group row">
                        <div class="col-form-label col-md-6 col-sm-12">
                            <label for="picture" class="label-align"><b><u>User Photo</u></b> </label>
                            <input class="form-control" id="picture" name="picture" style="padding:3px;"
                                onchange="onChangePicture(this);"
                                type="file" required="required" accept="image/gif, image/jpeg, image/png"/>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <img id="img_picture" src="/SAP/srcs/user.jpg" 
                                    style="width:150px;height:150px;" alt="User Picture" />
                        </div>
                    </div>
                    <hr/>
                    <div class="form-group row">
                        <div class="col-form-label col-md-6 col-sm-12">
                            <label for="id_picture" class="label-align"><b><u>ID Card Photo</u></b> </label>
                            <input class="form-control" id="id_picture" name="id_picture" style="padding:3px;"
                                onchange="onChangeId(this);"
                                type="file" required="required" accept="image/gif, image/jpeg, image/png"/>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <img id="img_id_picture" src="/SAP/srcs/id_picture_sample.jpg" 
                                style="width:220px;height:150px;" alt="ID Picture" />
                        </div>
                    </div>
                </div>
                <div id="step-55">
                    <h2 class="StepTitle">
                        <div class="col-md-9">
                            Step 5 of 5 - <b>Add Family Members</b>
                        </div>
                        <div class="col-md-3 no-padding" style="text-align:right;margin-bottom:10px;">
                            <button type="button"
                                class="btn btn-info btn-sm waves-effect m-r-20" 
                                style="padding:5px;font-size:10px;font-weigh:bold;"
                                data-toggle="modal" data-target="#defaultModal">
                                ADD ROW
                            </button>
                        </div>
                        <hr/>
                    </h2> 
                    <div class="col-md-12 no-padding">
                        <table id="member_table_add" class="table table-responsive table-striped">
                            <thead >
                                <tr>
                                    <th class="member_row" style="width:20%">FULL NAME</th>
                                    <th class="member_row" style="width:10%">RELATION</th>
                                    <th class="member_row" style="width:10%">BIRTHDATE</th>
                                    <th class="member_row" style="width:8%">GENDER</th>
                                    <th class="member_row" style="width:12%">WORK</th>
                                    <th class="member_row" style="width:25%">SECTOR</th>
                                    <th class="member_row" style="width:13%">HEALTH CONDITION</th>
                                    <th class="member_row" style="width:2%"></th>
                                </tr>
                            </thead>
                            <tbody id="row_container">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    <?= $this->Form->end(); ?>
</div>

<div class="modal fade" id="defaultModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">
                    Add Member
                </h4>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                        <label for="modal_fullname" style="padding-left:10px;"><b>Full Name</b></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                        <div class="form-group">
                            <div class="form-line">
                                <input id="modal_fullname" type="text" 
                                    oninput="this.value = this.value.toUpperCase()"
                                    class="form-control" value="" maxlength="50" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                        <label for="modal_relation" style="padding-left:10px;"><b>Relation</b></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                        <div class="form-group">
                            <div class="form-line">
                                <input id="modal_relation" type="text" 
                                    oninput="this.value = this.value.toUpperCase()"
                                    class="form-control" value="" maxlength="50" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                        <label for="modal_birthdate" style="padding-left:10px;"><b>Birthdate</b></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                        <div class="form-group">
                            <div class="form-line">
                                <input id="modal_birthdate" type="date" 
                                    class="form-control" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                        <label for="modal_gender" style="padding-left:10px;"><b>Gender</b></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                        <div class="form-group">
                            <div class="form-line">
                                <select id="modal_gender" class="form-control" style="width:100%" equired>
                                    <option value="" selected disabled>SELECT...</option>
                                    <?php foreach ($gender->categories_items as $key => $status) { ?>
                                        <option value="<?=h($status->merge_value);?>"><?=h($status->name);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                        <label for="modal_work" style="padding-left:10px;"><b>Work</b></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                        <div class="form-group">
                            <div class="form-line">
                                <input id="modal_work" type="text" 
                                    oninput="this.value = this.value.toUpperCase()"
                                    class="form-control" value="" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                        <label for="modal_sector" style="padding-left:10px;"><b>Sector</b></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                        <div class="form-group">
                            <div class="form-line">
                                <select id="modal_sector" class="form-control" style="width:100%" required>
                                    <option value="" selected disabled>SELECT...</option>
                                    <?php foreach ($sector->categories_items as $key => $status) { ?>
                                        <option value="<?=h($status->merge_value);?>"><?=h($status->name);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                        <label for="modal_health_condition" style="padding-left:10px;"><b>Health Condition</b></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                        <div class="form-group">
                            <div class="form-line">
                                <select id="modal_health_condition" class="form-control" style="width:100%" required>
                                    <option value="" selected disabled>SELECT...</option>
                                    <?php foreach ($health_condition->categories_items as $key => $status) { ?>
                                        <option value="<?=h($status->merge_value);?>"><?=h($status->name);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn_add_row"
                    class="btn btn-info" 
                    data-toggle="modal" data-target="#defaultModal">
                    SUBMIT
                </button>
                <button type="button" class="btn btn-warning" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#gender').select2();
        $('#civil_status').select2();
        $('#house_type').select2();
        $('#beneficiary').select2();
        $('#sector').select2();
        $('#health_condition').select2();

        $('#modal_gender').select2();
        $('#modal_sector').select2();
        $('#modal_health_condition').select2();

        $(document).on('focus', '.select2.select2-container', function (e) {
            // only open on original attempt - close focus event should not fire open
            if (e.originalEvent && $(this).find(".select2-selection--single").length > 0) {
                $(this).siblings('select').select2('open');
            } 
        });

        var invalidChars = [
            "-",
            "+",
            "e",
            ".",
        ];
        
        $("#mobile_number").on('input', function() {
            if (invalidChars.includes(this.key)) {
                e.preventDefault();
            }

            var nonNumReg = /[^0-9]/g
            $(this).val($(this).val().replace(nonNumReg, ''));
        });
    });

    function onChangePicture(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img_picture').attr('src', e.target.result).width(150).height(150);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function onChangeId(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#img_id_picture').attr('src', e.target.result).width(220).height(150);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    var i = 1;
    $("#btn_add_row").click(function(){
        $("#row_container").append(addNewRow(i));
        i++;
    });

    function addNewRow(i)
    {
        var _fullname = (($('#modal_fullname').val()) ? $('#modal_fullname').val() : 'NOT SPECIFIED');
        var _relation = (($('#modal_relation').val()) ? $('#modal_relation').val() : 'NOT SPECIFIED');
        var _birthdate = (($('#modal_birthdate').val()) ? $('#modal_birthdate').val() : '1990-12-25');
        var _gender = (($('#modal_gender').val()) ? $('#modal_gender').val() : 'NOT SPECIFIED');
        var _work = (($('#modal_work').val()) ? $('#modal_work').val() : 'NONE');
        var _sector = (($('#modal_sector').val()) ? $('#modal_sector').val() : '0 - NONE');
        var _health_condition = (($('#modal_health_condition').val()) ? $('#modal_health_condition').val() : '0 - NONE');

        var newrow = '<tr class="canDeletable">' +
            '<td class="td_fullname">' +
                '<input type="text" value="' + _fullname +
                    '" readonly name="family_member[' + i + '][fullname]"' + 
                    ' style="border-color: transparent;height: 26px;background: transparent;' +
                    'box-shadow: none;border-color: transparent;font-size: 9px; padding: 0px;margin: 0px;">' +
            '</td>' +
            '<td class="td_relation">' +
                '<input type="text" value="' + _relation +
                    '" readonly name="family_member[' + i + '][relation]"' + 
                    ' style="border-color: transparent;height: 26px;background: transparent;' +
                    'box-shadow: none;border-color: transparent;font-size: 9px; padding: 0px;margin: 0px;">' +
            '</td>' +
            '<td class="td_birthdate">' +
                '<input type="text" value="' + _birthdate +
                    '" readonly name="family_member[' + i + '][birthdate]"' + 
                    ' style="border-color: transparent;height: 26px;background: transparent;' +
                    'box-shadow: none;border-color: transparent;font-size: 9px; padding: 0px;margin: 0px;">' +
            '</td>' +
            '<td class="td_gender">' +
                '<input type="text" value="'+ _gender +
                    '" readonly name="family_member[' + i + '][gender]"' + 
                    ' style="border-color: transparent;height: 26px;background: transparent;' +
                    'box-shadow: none;border-color: transparent;font-size: 9px; padding: 0px;margin: 0px;">' +
            '</td>' +
            '<td class="td_work">' +
                '<input type="text" value="' + _work +
                    '" readonly name="family_member[' + i + '][work]"' + 
                    ' style="border-color: transparent;height: 26px;background: transparent;' +
                    'box-shadow: none;border-color: transparent;font-size: 9px; padding: 0px;margin: 0px;">' +
            '</td>' +
            '<td class="td_sector">' +
                '<input type="text" value="' + _sector + 
                    '" readonly name="family_member[' + i + '][sector]"' + 
                    ' style="border-color: transparent;height: 26px;background: transparent;' +
                    'box-shadow: none;border-color: transparent;font-size: 9px; padding: 0px;margin: 0px;">' +
            '</td>' +
            '<td class="td_health_condition">' +
                '<input type="text" value="'+ _health_condition + 
                    '" readonly name="family_member[' + i + '][health_condition]"' + 
                    ' style="border-color: transparent;height: 26px;background: transparent;' +
                    'box-shadow: none;border-color: transparent;font-size: 9px; padding: 0px;margin: 0px;">' +
            '</td>' +
            '<td class="td_action">' +
                '<button type="button" class="this_delete no-padding" class="this_delete no-padding" style="background-color:transparent">' +
                    '<i class="fa fa-trash" style="color:red"></i></button>' +
            '</td>' +
        '</tr>';
       
        clearmodalrow();
        return newrow;
    }

    function clearmodalrow()
    {
        $('#modal_fullname').val('');
        $('#modal_relation').val('');
        $('#modal_birthdate').val('');
        $('#modal_gender').val('').trigger('change');
        $('#modal_work').val('');
        $('#modal_sector').val('').trigger('change');
        $('#modal_health_condition').val('').trigger('change');
    }

    $("#row_container").on("click", '.this_delete', function() { 
        $(this).closest('tr.canDeletable').remove();
    });
</script>
