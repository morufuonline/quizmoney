<?php
require_once("server_header.php");
?>
           
            <!--BEGIN PAGE WRAPPER-->
            <div id="page-wrapper">
                <!--BEGIN TITLE & BREADCRUMB PAGE-->
                <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                    <div class="page-header pull-left">
                        <div class="page-title">Dashboard</div>
                    </div>
                    <ol class="breadcrumb page-breadcrumb pull-left">
                        <li><i class="fa fa-home"></i>&nbsp;<a href="/">Home</a>&nbsp;&nbsp;<i class="fa fa-angle-right"></i>&nbsp;&nbsp;</li>
                        <li class="active">Dashboard</li>
                    </ol>
                    <div class="btn btn-blue pull-right"><a onClick="javascript:return confirm('Are you sure you want to log out?')" href="index.php?logout=1"><i class="fa fa-sign-out"></i> Logout</a></div>
                    <div class="clearfix"></div>
                </div>
                <!--END TITLE & BREADCRUMB PAGE-->
                <!--BEGIN CONTENT-->
                <div class="page-content">
                    <div id="tab-general">
                        <div id="sum_box" class="row mbl">
                            <div class="col-sm-6 col-md-3">
                                <div class="panel profit db mbm">
                                    <div class="panel-body">
                                        <p class="icon"><i class="icon fa fa-users"></i>
                                        </p>
                                        <h4 class="value"><span data-counter="" data-start="10" data-end="50" data-step="1" data-duration="0"></span><span></span></h4>
                <p class="description">Users: <b><?php echo formatQty(in_table("COUNT(id) AS total", "register", "", "total")); ?></b></p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;" class="progress-bar progress-bar-success"><span class="sr-only">80% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="panel income db mbm">
                                    <div class="panel-body">
                                        <p class="icon"><i class="icon fa fa-signal"></i>
                                        </p>
                                        <h4 class="value"><span></span><span></span></h4>
        <p class="description">Questions: <b><?php echo formatQty(in_table("COUNT(id) AS total", "question", "", "total")); ?></b></p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;" class="progress-bar progress-bar-info"><span class="sr-only">60% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="panel task db mbm">
                                    <div class="panel-body">
                                        <p class="icon"><i class="icon fa fa-money"></i>
                                        </p>
                                        <h4 class="value"><span></span></h4>
      <p class="description">E-Wallet: <b>&#8358;<?php echo formatNumber(in_table("SUM(balance) AS total", "register", "", "total")); ?></b></p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;" class="progress-bar progress-bar-danger"><span class="sr-only">50% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <div class="panel visit db mbm">
                                    <div class="panel-body">
                                        <p class="icon"><i class="icon fa fa-list"></i>
                                        </p>
                                        <h4 class="value"><span></span></h4>
         <p class="description">Categories: <b><?php echo formatQty(in_table("COUNT(id) AS total", "categories", "", "total")); ?></b></p>
                                        <div class="progress progress-sm mbn">
                                            <div role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%;" class="progress-bar progress-bar-warning"><span class="sr-only">70% Complete (success)</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mbl">
                            <div class="col-lg-12">
                                <div class="panel">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                              <h2 class="value">Total Amount Earned <span><b>&#8358;<?php echo formatNumber(in_table("SUM(earned) AS total", "register", "", "total")); ?></b></span></h2>
                                              <h1 style="font-size:16px; font-weight:bold;">Fund User&#039;s Account (E-Wallet)</h1>

<form action="fund_account.php" method="post">
<input type="text" name="email" placeholder="Enter user&#039;s email" class="form-control"><br>
<button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
</form>

                                            </div>
                                            <div class="col-md-4">
                                                
                                            </div>
                                        </div>
                                        
                                    </div>
                             </div>  </div> 
    </div>
    
            </div>
        </div>
    </div>
    </div>
    </div>
    <!--END CONTENT-->
    </div>
<?php
require_once("footer.php");
?>