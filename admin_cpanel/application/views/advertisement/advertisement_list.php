<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">	
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Provab Admin Panel" />
        <meta name="author" content="" />	
        <title><?php echo PAGE_TITLE; ?> | advertisement</title>	
        <!-- Load Default CSS and JS Scripts -->
        <?php $this->load->view('general/load_css'); ?>	
    </head>
    <body id="top" oncontextmenu="return false" class="page-body <?php if(isset($transition)){ echo $transition; } ?>" data-url="<?php echo PROVAB_URL; ?>">
        <div class="page-container <?php if (isset($header) && $header == 'header_top') { echo "horizontal-menu"; } ?> <?php if (isset($header) && $header == 'header_right') { echo "right-sidebar"; } ?> <?php if(isset($sidebar)){ echo $sidebar; } ?>">
             <?php if (isset($header) && $header == 'header_top') { $this->load->view('general/header_top'); } else { $this->load->view('general/left_menu'); } ?>
            <div class="main-content">
                <?php
                if (!isset($header) || $header != 'header_top') {
                    $this->load->view('general/header_left');
                }
                ?>
                <?php $this->load->view('general/top_menu'); ?>
                <hr />
                <ol class="breadcrumb bc-3">							
                    <li><a href="<?php echo site_url() . "dashboard/dashboard"; ?>"><i class="entypo-home"></i>Home</a></li>
                    <li><a href="<?php echo site_url() . "advertisement/advertisement_list"; ?>">advertisement</a></li>
                    <li class="active"><strong>advertisement List</strong></li>
                    <li class="active" style="float:right;"><a href="<?php echo site_url() . "advertisement/add_advertisement"; ?>">Add New advertisement</a></li>
                </ol>
                <div class="row" style="overflow-x: scroll;">
                    <table class="table table-bordered datatable" id="advertisement_list">
                        <thead>
                            <tr>
                                <th>Sl No</th>
                                <th>advertisement Title</th>
                                <th>advertisement Type</th>
                                <th>advertisement Alt Text</th>
                                <th>advertisement Left Image</th>
                                <th>advertisement Right Image</th>
                                <th>advertisement Description</th>
                                <th>advertisement URL</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                            <tr class="replace-inputs">
                                <th>Sl No</th>
                                <th>advertisement Title</th>
                                <th>advertisement Type</th>
                                <th>advertisement Alt Text</th>
                                <th>advertisement Left Image</th>
                                <th>advertisement Right Image</th>
                                <th>advertisement Description</th>
                                <th>advertisement URL</th>
                                <th>Position</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($advertisement_list != '') {
                                for ($a = 0; $a < count($advertisement_list); $a++) {
                                    ?>
                                    <tr>
                                        <td><?php echo ($a + 1); ?></td>
                                        <td><?php echo $advertisement_list[$a]->title; ?></td>
                                        <td><?php echo $advertisement_list[$a]->advertisement_type; ?></td>
                                        <td><?php echo $advertisement_list[$a]->img_alt_text; ?></td>                                      
                                        <td class="center"><img src="<?php echo base_url(); ?>uploads/advertisement/<?php echo $advertisement_list[$a]->advertisement_left_image_name; ?>" alt="advertisement Logo" width="100" height="50"></td>
                                        <td class="center"><img src="<?php echo base_url(); ?>uploads/advertisement/<?php echo $advertisement_list[$a]->advertisement_right_image_name; ?>" alt="advertisement Logo" width="100" height="50"></td>
                                        <td><?php echo $advertisement_list[$a]->adv_details; ?></td>
                                        <td><?php echo $advertisement_list[$a]->link; ?></td>
                                        <td><?php echo $advertisement_list[$a]->position; ?></td>
                                        <td>
                                            <?php if ($advertisement_list[$a]->status == "ACTIVE") { ?>
                                                <button type="button" class="btn btn-green btn-icon icon-left">Active<i class="entypo-check"></i></button>
                                            <?php } else { ?>
                                                <button type="button" class="btn btn-orange btn-icon icon-left">InActive<i class="entypo-cancel"></i></button>
        <?php } ?>
                                        </td>
                                        <td class="center">
                                            <?php if ($advertisement_list[$a]->status == "ACTIVE") { ?>
                                                <a href="<?php echo site_url()."advertisement/inactive_advertisement/".base64_encode(json_encode($advertisement_list[$a]->advertisement_details_id)); ?>" class="btn btn-orange btn-sm btn-icon icon-left"><i class="entypo-eye"></i>InActive</a>
                                            <?php } else { ?>
                                                <a href="<?php echo site_url()."advertisement/active_advertisement/".base64_encode(json_encode($advertisement_list[$a]->advertisement_details_id)); ?>" class="btn btn-green btn-sm btn-icon icon-left"><i class="entypo-check"></i>Active</a>
        <?php } ?>
                                            <a href="<?php echo site_url()."advertisement/edit_advertisement/".base64_encode(json_encode($advertisement_list[$a]->advertisement_details_id)); ?>" class="btn btn-default btn-sm btn-icon icon-left"><i class="entypo-pencil"></i>Edit</a>				
                                            <a href="<?php echo site_url()."advertisement/delete_advertisement/".base64_encode(json_encode($advertisement_list[$a]->advertisement_details_id)); ?>" class="btn btn-danger btn-sm btn-icon icon-left"><i class="entypo-cancel"></i>Delete</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            }
                            ?>												
                        </tbody>
                    </table>
                </div>
                <!-- Footer -->
            <?php $this->load->view('general/footer'); ?>				
            </div>				
            <!-- Chat Module -->
        <?php $this->load->view('general/chat'); ?>	
        </div>
        <!-- Bottom Scripts -->
<?php $this->load->view('general/load_js'); ?>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap-switch.min.js"></script>	
        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/datatables/TableTools.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/datatables/jquery.dataTables.columnFilter.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/datatables/lodash.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/datatables/responsive/js/datatables.responsive.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($)
            {
                var table = $("#advertisement_list").dataTable({
                    "sPaginationType": "bootstrap",
                    "sDom": "<'row'<'col-xs-3 col-left'l><'col-xs-9 col-right'<'export-data'T>f>r>t<'row'<'col-xs-6 col-left'i><'col-xs-6 col-right'p>>",
                    "oTableTools": {
                    },
                });
                table.columnFilter({
                    "sPlaceHolder": "head:after"
                });
            });
        </script>
    </body>
</html>