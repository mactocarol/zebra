<style type="text/css">
    .pagination1 {
        display: inline-block;
    }

    .pagination1 .page {
        color: black;
        float: left;
        padding: 8px 16px;
    }
</style>
<div class="app-content content container-fluid">
    <div class="content-wrapper" style="height:100vh;">
        
        <div class="content-header row">
            
            <div class="content-header-left col-md-6 col-xs-12 mb-1">
                <h2 class="content-header-title">Basic Tables</h2>
            </div>

            <div class="content-header-right breadcrumbs-right breadcrumbs-top col-md-6 col-xs-12">
                <div class="breadcrumb-wrapper col-xs-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard'); ?>">Dashboard</a>
                        </li>
                        <!-- <li class="breadcrumb-item"><a href="#">Tables</a>
                        </li> -->
                        <li class="breadcrumb-item active">User-List
                        </li>
                    </ol>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="card">
                    <div class="card-header">
                        <!-- <h4 class="card-title">Bordered striped</h4> -->
                        <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <!-- <li><a data-action="collapse"><i class="icon-minus4"></i></a></li> -->
                                <li><a data-action="reload"><i class="icon-reload"></i></a></li>
                                <li><a data-action="expand"><i class="icon-expand2"></i></a></li>
                                <!-- <li><a data-action="close"><i class="icon-cross2"></i></a></li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="card-body collapse in">

                        <div class="table-responsive" id="ajaxData" >
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function ajax_fun (url){
        $.ajax({
          url: url,
          type : 'POST',
          data : {},
          success: function(result){
            $('#ajaxData').html(result);
          },
        });
      }
      ajax_fun (baseUrl+"admin/users/usersList/0");
</script>