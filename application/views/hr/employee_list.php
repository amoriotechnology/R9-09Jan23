<div class="content-wrapper">

    <section class="content-header">

        <div class="header-icon">

            <i class="pe-7s-note2"></i>

        </div>

        <div class="header-title">

            <h1><?php echo display('hrm') ?></h1>

            <small><?php echo display('manage_employee') ?></small>

            <ol class="breadcrumb">

                <li><a href=""><i class="pe-7s-home"></i> <?php echo display('home') ?></a></li>

                <li><a href="#"><?php echo display('hrm') ?></a></li>

                <li class="active"><?php echo display('manage_employee') ?></li>

            </ol>

        </div>

    </section>



    <section class="content">



        <!-- Alert Message -->

        <?php

        $message = $this->session->userdata('message');

        if (isset($message)) {

            ?>

            <div class="alert alert-info alert-dismissable">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <?php echo $message ?>                    

            </div>

            <?php

            $this->session->unset_userdata('message');

        }

        $error_message = $this->session->userdata('error_message');

        if (isset($error_message)) {

            ?>

            <div class="alert alert-danger alert-dismissable">

                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>

                <?php echo $error_message ?>                    

            </div>

            <?php

            $this->session->unset_userdata('error_message');

        }

        ?>



        <!-- Manage Category -->

        <div class="row">

            <div class="col-sm-12">

                <div class="panel panel-bd lobidrag">

                    <div class="panel-heading">

                        <div class="panel-title">

                          <h4><?php echo display('manage_employee')?></h4>

                        </div>

                    </div>

                    <div class="panel-body">

                        <div class="table-responsive">

                            <table id="" class="table table-bordered table-striped table-hover datatable">

                                <thead>

                        <tr>

                        <th class="text-center"><?php echo display('sl') ?></th>

                        <th class="text-center"><?php echo display('name') ?></th>

                        <th class="text-center"><?php echo display('designation') ?></th>

                        <th class="text-center"><?php echo display('phone') ?></th>

                        <th class="text-center"><?php echo display('email') ?></th>

                        <th class="text-center"><?php echo display('picture') ?></th>

                        <th class="text-center"><?php echo display('action') ?></th>

                        </tr>

                                </thead>

                                <tbody>

                                    <?php

                                    if ($employee_list) {

                                        ?>

                                       

                                        <?php

                                        $sl = 1;

                                         foreach($employee_list as $employees){?>

                                        <tr>

                                <td class="text-center"><?php echo $sl;?></td>

                                <td class="text-center"> <a href="<?php echo base_url('Chrm/add_timesheet') ?>"> <?php echo html_escape($employees['first_name']).' '.html_escape($employees['last_name']);?></a></td>

                                <td class="text-center"><?php echo html_escape($employees['designation']);?></td>

                                <td class="text-center"><?php echo html_escape($employees['phone']);?></td>

                                <td class="text-center"><?php echo html_escape($employees['email']);?></td>

                                 <td class="text-center"><img src="<?php echo html_escape($employees['image']);?>" height="60px" width="80px"></td>

                                            <td>

                                    <center>

                                        <?php echo form_open() ?>

        <?php if($this->permission1->method('manage_employee','update')->access()){ ?>                          

                                        <a href="<?php echo base_url() . 'Chrm/employee_update_form/'.$employees['id']; ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="left" title="<?php echo display('update') ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                                    <?php }?>

    <?php if($this->permission1->method('manage_employee','delete')->access()){ ?>                                

                                        <a href="<?php echo base_url('Chrm/employee_delete/'.$employees['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('<?php echo display('are_you_sure') ?>')" data-toggle="tooltip" data-placement="right" title="" data-original-title="<?php echo display('delete') ?> "><i class="fa fa-trash-o" aria-hidden="true"></i></a>

                                         <?php }?>

                                   <a href="<?php echo base_url('Chrm/employee_details/'.$employees['id']);?>" class="btn btn-default"><i class="fa fa-user"></i></a>

                                            <?php echo form_close() ?>

                                    </center>

                                    </td>

                                    </tr>

                                   

                                    <?php

                                    $sl++;

                                }}

                                ?>

                                </tbody>

                                <tfoot></tfoot>

                            </table>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>










