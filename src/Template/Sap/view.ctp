
<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?= $this->Flash->render(); ?>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="card-header" style="padding:10px;">
                    <?=$this->Html->link('[Return] Manage SAP', ['controller' => 'Sap', 'action' => 'index']) ?> > View
                </div>
                <div class="col-md-12 card-content">
                    <br/>
                    <div class="col-md-1 col-xs-12"></div>
                    <div class="col-md-10 col-xs-12 no-padding" id="report001" style="border: 1px solid grey;width:98%;margin:1%;">
                        <img src="/SAP/srcs/header.jpg" alt="Barangay Balibago RBI" style="width:100%">
                        <hr style="background-color: grey; margin:0px;border: 1px solid grey;"/>
                        <div id="head-family" class="col-md-12 no-padding">
                            <div class="col-md-2 no-padding" style="text-align:center;">
                                <div class="col-md-12 no-padding">
                                    <img src="/<?=h($data->picture);?>" alt="User Photo" 
                                        style="width:150px;margin:10px 10px 5px 10px;border: 1px solid black;">
                                </div>
                                <div class="col-md-12 no-padding" style="text-align:center;font-size:10px;">
                                    <span><b>NO. OF FAMILY MEMBERS: &nbsp; <?=h(count($fam_members));?></b></span>
                                </div>
                            </div>
                            <div class="col-md-10" style="color:black;">
                                <div class="col-md-7 no-padding" style="font-size:12px;">
                                    <div style="padding-top:5px;"><b><u>PERSONAL INFORMATION</u></b></div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-3 col-xs-12 no-padding">FULL NAME</div>
                                        <div class="col-md-9 col-xs-12 no-padding"><?=h($data->fullname);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-3 col-xs-12 no-padding">BIRTHDATE</div>
                                        <div class="col-md-9 col-xs-12 no-padding"><?=h($data->birthdate->format('Y-M-d'));?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-3 col-xs-12 no-padding">AGE</div>
                                        <div class="col-md-9 col-xs-12 no-padding"><?=h($data->age);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-3 col-xs-12 no-padding">GENDER</div>
                                        <div class="col-md-9 col-xs-12 no-padding"><?=h($data->gender);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-3 col-xs-12 no-padding">CIVIL STATUS</div>
                                        <div class="col-md-9 col-xs-12 no-padding"><?=h($data->civil_status);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-3 col-xs-12 no-padding">CELLPHONE NO.</div>
                                        <div class="col-md-9 col-xs-12 no-padding"><?=h($data->mobile_number);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-3 col-xs-12 no-padding">WORK</div>
                                        <div class="col-md-9 col-xs-12 no-padding"><?=h($data->work);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-3 col-xs-12 no-padding">PLACE OF WORK</div>
                                        <div class="col-md-9 col-xs-12 no-padding"><?=h($data->place_of_work);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-3 col-xs-12 no-padding">MONTHLY SALARY</div>
                                        <div class="col-md-9 col-xs-12 no-padding"><?=h($data->monthly_salary);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-3 col-xs-12 no-padding">SECTOR</div>
                                        <div class="col-md-9 col-xs-12 no-padding"><?=h($data->sector);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-3 col-xs-12 no-padding">HEALTH CONDITION</div>
                                        <div class="col-md-9 col-xs-12 no-padding"><?=h($data->health_condition);?></div>
                                    </div>

                                    <div class="col-md-12 no-padding">
                                        <div class="col-md-3 col-xs-12 no-padding">GROUP (ETHNIC)</div>
                                        <div class="col-md-9 col-xs-12 no-padding"><?=h($data->ethnic_group);?></div>
                                    </div>
                                </div>

                                <div class="col-md-5 no-padding" style="font-size:12px;">
                                    <div class="col-md-12 no-padding">
                                        <div style="padding-top:5px;"><b><u>RESIDENTIAL ADDRESS</u></b></div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-4 col-xs-12 no-padding">HOUSE TYPE</div>
                                            <div class="col-md-8 col-xs-12 no-padding"><?=h($data->house_type);?></div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-4 col-xs-12 no-padding">PUROK</div>
                                            <div class="col-md-8 col-xs-12 no-padding"><?=h($data->purok);?></div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-4 col-xs-12 no-padding">HOUSE NUMBER</div>
                                            <div class="col-md-8 col-xs-12 no-padding"><?=h($data->house_number);?></div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-4 col-xs-12 no-padding">STREET</div>
                                            <div class="col-md-8 col-xs-12 no-padding"><?=h($data->street);?></div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-4 col-xs-12 no-padding">SITIO</div>
                                            <div class="col-md-8 col-xs-12 no-padding"><?=h($data->sitio);?></div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-4 col-xs-12 no-padding">BARANGAY</div>
                                            <div class="col-md-8 col-xs-12 no-padding"><?=h($data->barangay);?></div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-4 col-xs-12 no-padding">CITY</div>
                                            <div class="col-md-8 col-xs-12 no-padding"><?=h($data->city);?></div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-4 col-xs-12 no-padding">RPOVINCE</div>
                                            <div class="col-md-8 col-xs-12 no-padding"><?=h($data->province);?></div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-4 col-xs-12 no-padding">REGION</div>
                                            <div class="col-md-8 col-xs-12 no-padding"><?=h($data->region);?></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 no-padding">
                                        <div style="padding-top:5px;"><b><u>ID'S</u></b></div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-4 col-xs-12 no-padding">TYPE OF ID</div>
                                            <div class="col-md-8 col-xs-12 no-padding"><?=h($data->id_card);?></div>
                                        </div>

                                        <div class="col-md-12 no-padding">
                                            <div class="col-md-4 col-xs-12 no-padding">ID NUMBER</div>
                                            <div class="col-md-8 col-xs-12 no-padding"><?=h($data->id_number);?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <style>
                            table > thead > tr > th {
                                padding: 3px !important;
                                padding-top: 5px !important;
                                font-size: 12px;
                            }

                            table > tbody > tr > td {
                                padding: 3px !important;
                                font-size: 12px;
                            }
                        </style>
                        <hr style="background-color: grey; margin:0px;border: 1px solid grey;"/>
                        <div id="family-members" class="col-md-12 col-xs-12 no-padding">
                            <table class="table table-bordered no-padding">
                                <thead>
                                    <tr>
                                        <th style="width:25%;">FULL NAME</th>
                                        <th style="width:10%;">RELATION</th>
                                        <th style="width:10%;">BIRTHDATE</th>
                                        <th style="width:10%;">GENDER</th>
                                        <th>WORK</th>
                                        <th>HEALTH CONDITION</th>
                                        <th>SECTOR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($fam_members)) { ?>
                                        <?php foreach ($fam_members as $key => $value) { ?>
                                            <tr>
                                                <td><?=h($value->fullname);?></td>
                                                <td><?=h($value->relation);?></td>
                                                <td><?=h($value->birthdate->format('Y-M-d'));?></td>
                                                <td><?=h($value->gender);?></td>
                                                <td><?=h($value->work);?></td>
                                                <td><?=h($value->health_condition);?></td>
                                                <td><?=h($value->sector);?></td>
                                            </tr>
                                        <?php }} else { ?>
                                        <tr><td colspan="7">No Members Registered</td></tr>
                                    <?php }?>

                                </tbody>
                            </table>
                        </div>
                        <hr style="background-color: grey; margin:0px;border: 1px solid grey;"/>
                        <div id="family-healthcondition" class="col-md-12 col-xs-12 no-padding" style="font-size:9px;text-align:center;">
                            <b><u>HEALTH CONDITION</u> &nbsp; </b>
                                1 - SAKIT SA PUSO | 
                                2 - ALTAPRESYON | 
                                3 - SAKIT SA BAGA | 
                                4 - DIYABETIS | 
                                5 - KANSER | 
                        </div>
                        <div id="family-sectors" class="col-md-12 col-xs-12 no-padding" style="font-size:9px;text-align:center;">
                            <b><u>SECTOR</u> &nbsp;</b>
                                A - NAKATATANDA | 
                                B - BUNTIS | 
                                C - NAGPAPASUSUNG INA | 
                                D - PWD | 
                                E - SOLO PARENT | 
                                F - WALANG TIRAHAN | 
                                G - OVERSEAS FILIPINO WORKER IN DISTRESS | 
                                H - MARALITANG KATUTUBO | 
                                I - IMPORMAL NA MANGGAGAWA | 
                                J - MANGGAGAWA SA TAHANAN | 
                                K - KASAMBAHAY | 
                                L - DRAYBER NG TRYSIKEL, PUJ, UV, TAXI | 
                                M - MICRO - ENTREPRENEUR | 
                                N - MAY ARI NG SARI - SARI STORE O CARINDERIA, ETC. | 
                                O - MAY ARI NG NEGOSYO NG PAMILYA | 
                                P - SUB - MINIMUM WAGE EARNERS | 
                                Q - MAGSASAKA, MANGINGISDA AT MAGBUBUKID | 
                                R - EMPLEYADONG 'NO WORK, NO PAY' | 
                        </div>
                    </div>
                    <div class="col-md-1 col-xs-12"></div>
                </div>
                <br/>
                <div class="col-md-12 card-footer" style="text-align:right;">
                    <a href="/Sap/prints/<?=($data->family_serial);?>" class="btn btn-primary btn-xs">VIEW PRINT</a>
                </div>
            </div>
        </div>
    </div> 
</div>