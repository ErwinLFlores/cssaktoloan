
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

    .td_fullname { width:13%; }
    .td_relation { width:15%; }
    .td_birthdate { width:10%; }
    .td_gender { width:10%; }
    .td_action { width:10%; }
</style>
<p>This is a basic form wizard example that inherits the colors from the selected scheme.</p>
<div class="container-fluid" style="background-color:white;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top:15px;">
        <?= $this->Flash->render(); ?>
    </div>
    <div class="col-sm-12 col-xs-12" style="padding-right:0px;">
        <div class="col-md-6 col-xs-12 no-padding" style="color:black;">
            <?php if (!empty($searched_data)) { ?>
                <h2>
                    SAP SERIAL: <b><u><?=h($searched_data);?></u></b>
                    <sup><span style="color:grey;"><i>(PRE-LOADED)</i></span></sup>
                </h2>
            <?php } else { ?>
                <button type="button"
                    class="btn btn-info btn-sm waves-effect m-r-20" 
                    data-toggle="modal" data-target="#preloadModal">
                        LOAD DATA
                </button>
            <?php } ?>
        </div>

        <div class="col-md-6 col-xs-12 no-padding" style="text-align:right;color:black;">
            <h6><b>REGISTRY SERIAL: <?=h($registry_serial);?></b></h6>
        </div>
    </div>
    <div class="col-sm-12 col-xs-12" style="padding-right:0px;">

        <?= $this->Form->create('Register SAP', ['type' => 'post', 'url' => '/registry/add', 'enctype' => "multipart/form-data"]); ?>
            <div class="row ">
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
                    </ul>
                    <div id="step-11">
                        <h2 class="StepTitle">
                            <div class="col-md-12 col-xs-12">
                                <span style="font-size:30px"><b>REGISTRY TYPE</b></span>
                                <?php if(isset($sap_data)) { ?>
                                    <input type="hidden" name="loaded_sap_serial" 
                                        value="<?=h($sap_data->family_serial);?>"/>
                                <?php } ?>
                            </div>    
                        </h2>
                        <div class="form-group row" style="margin-bottom:5px;height:400px;">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" 
                                style="margin-top:10%;"
                                for="registry_status">
                                <span style="font-size: 20px;">TYPE</span> <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 input-group" style="margin-top:10%">
                                <select id="registry_status" name="registry_status" class="form-control" required>
                                    <option value="" selected disabled>SELECT...</option>
                                    <?php foreach ($registry_status->categories_items as $key => $status) { ?>
                                        <option value="<?=h($status->merge_value);?>"><?=h($status->name);?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="step-22">
                        <h2 class="StepTitle">
                            <div class="col-md-12 col-xs-12">
                                <b>Personal Information</b>
                            </div>    
                        </h2>
                        <?php if (!empty($sap_data)): ?>
                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="fullname">
                                    FULL NAME
                                </label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" readonly disabled class="form-control" 
                                        value="<?=h($sap_data->fullname);?> (manual migration of FULLNAME to chunks)">
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="firstname">
                                FIRST NAME <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input name="firstname" type="text" required
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
                                <input name="lastname" type="text" required 
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
                                <input name="birthdate" class="form-control" 
                                    value="<?=h((isset($sap_data)) ? $sap_data->birthdate->format('Y-m-d') : '');?>"
                                    required type="date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 label-align" for="mobile_number">
                                CELLPHONE NUMBER <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6">
                                <input type="text" id="mobile_number" name="mobile_number" required 
                                    value="<?=h((isset($sap_data)) ? $sap_data->mobile_number : '');?>"
                                    minlength="11" maxlength="11" value="09"
                                    class="form-control">
                            </div>
                        </div>
                    </div>
                    <div id="step-33">
                        <h2 class="StepTitle">
                            <div class="col-md-9">
                                <b>Add Family Members</b>
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
                                        <th class="member_row" style="width:13%">FIRST NAME</th>
                                        <th class="member_row" style="width:13%">MIDDLE NAME</th>
                                        <th class="member_row" style="width:13%">LAST NAME</th>
                                        <th class="member_row" style="width:15%">RELATION</th>
                                        <th class="member_row" style="width:10%">BIRTHDATE</th>
                                        <th class="member_row" style="width:10%">GENDER</th>
                                        <th class="member_row" style="width:10%">ACTIONS</th>
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
                        <label for="modal_firstname" style="padding-left:10px;"><b>First Name</b></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                        <div class="form-group">
                            <div class="form-line">
                                <input id="modal_firstname" type="text" 
                                    oninput="this.value = this.value.toUpperCase()"
                                    class="form-control" value="" maxlength="50" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                        <label for="modal_middlename" style="padding-left:10px;"><b>Middle Name</b></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                        <div class="form-group">
                            <div class="form-line">
                                <input id="modal_middlename" type="text" 
                                    oninput="this.value = this.value.toUpperCase()"
                                    class="form-control" value="" maxlength="50">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row clearfix">
                    <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                        <label for="modal_lastname" style="padding-left:10px;"><b>Last Name</b></label>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                        <div class="form-group">
                            <div class="form-line">
                                <input id="modal_lastname" type="text" 
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

<div class="modal fade" id="preloadModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="preloadModalLabel">
                    DATA LOADER
                </h4>
            </div>
            <?= $this->Form->create('Load Sap Data', ['type' => 'get']); ?>
                <div class="modal-body">
                    <div class="row clearfix">
                        <div style="padding:10px;" class="col-lg-3 col-md-3 col-sm-5 col-xs-6 form-control-label">
                            <label for="title" style="padding-left:10px;"><b>SAP SERIAL</b></label>
                        </div>
                        <div class="col-lg-9 col-md-9 col-sm-7 col-xs-5">
                            <div class="form-group">
                                <div class="form-line">
                                    <input type="text" name="sap_serial" class="form-control" 
                                        oninput="this.value = this.value.toUpperCase()"
                                        value="X2RW62-2HCT-YWPD7" required maxlength="30" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" id="submitbutton" class="btn btn-info" value="LOAD DATA">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">CLOSE</button>
                </div>
            <?= $this->Form->end(); ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('#gender').select2();
        $('#civil_status').select2();
        $('#modal_gender').select2();

        <?php if(isset($sap_data)) { ?>
            $('#gender').val('<?=h($sap_data->gender);?>').trigger('change');
            $('#civil_status').val('<?=h($sap_data->civil_status);?>').trigger('change');
            <?php if($sap_data->barangay === "BALIBAGO") { ?>
                $('#registry_status').val('RESIDENT');
            <?php } ?>
        <?php } ?>

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
        var _firstname = (($('#modal_firstname').val()) ? $('#modal_firstname').val() : 'NOT SPECIFIED');
        var _middlename = (($('#modal_middlename').val()) ? $('#modal_middlename').val() : '');
        var _lastname = (($('#modal_lastname').val()) ? $('#modal_lastname').val() : 'NOT SPECIFIED');
        var _relation = (($('#modal_relation').val()) ? $('#modal_relation').val() : 'NOT SPECIFIED');
        var _birthdate = (($('#modal_birthdate').val()) ? $('#modal_birthdate').val() : '1990-12-25');
        var _gender = (($('#modal_gender').val()) ? $('#modal_gender').val() : 'NOT SPECIFIED');

        var newrow = '<tr class="canDeletable">' +
            '<td class="td_fullname">' +
                '<input type="text" value="' + _firstname +
                    '" readonly name="family_member[' + i + '][firstname]"' + 
                    ' style="border-color: transparent;height: 26px;background: transparent;' +
                    'box-shadow: none;border-color: transparent;font-size: 9px; padding: 0px;margin: 0px;">' +
            '</td>' +
            '<td class="td_fullname">' +
                '<input type="text" value="' + _middlename +
                    '" readonly name="family_member[' + i + '][middlename]"' + 
                    ' style="border-color: transparent;height: 26px;background: transparent;' +
                    'box-shadow: none;border-color: transparent;font-size: 9px; padding: 0px;margin: 0px;">' +
            '</td>' +
            '<td class="td_fullname">' +
                '<input type="text" value="' + _lastname +
                    '" readonly name="family_member[' + i + '][lastname]"' + 
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
        $('#modal_firstname').val('');
        $('#modal_lastname').val('');
        $('#modal_middlename').val('');
        $('#modal_birthdate').val('');
        $('#modal_gender').val('').trigger('change');
    }

    $("#row_container").on("click", '.this_delete', function() { 
        $(this).closest('tr.canDeletable').remove();
    });
</script>
