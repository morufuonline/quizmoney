<?php include_once('includes/header.php') ?>
<style type="text/css">
.in-circle{
	width: 130px;
	background-color: #f7f7f7;
    height: 126px;
    border-radius: 70px;
    border: 3px solid #FFEB3B;
}
.in-circle p{
	text-align: center;
	padding: 17px;
	margin-top: 10px
}
.in-circle p span{
	font-weight: bold;
	text-align:center
}


.out-circle{
	width: 220px;
	background-color: #f5f5f5;
    height: 215px;
    border-radius: 110px;
    border: 3px solid #FFEB3B;
}
@media screen and (min-width: 768px) {
    #count {
       text-align: center; font-size: 120px; font-weight: bold; padding: 40px; margin-top: 50px;
    }
}
@media screen and (max-width: 768px) {
    #count {
       text-align: center; font-size: 120px; font-weight: bold; padding: 0px; margin-top: 0px;
    }
}
</style>
<div class="container">
				
					<div class="GridLex-gap-30" style="margin: 0px 0px;">
					
						<div class="GridLex-grid-noGutter-equalHeight" style="margin-top: 3em;">
									
							<div class="col-md-3 col-sm-4 col-xs-12" style="text-align: center;">

							
							<div class="in-circle" style="margin: 5px auto;">
								<p>Number of games played<br>
								<span>2/10</span></p>
							</div>
							<div class="in-circle" style="margin: 5px auto;">
								<p style="font-size: 23px">Buy answer</p>
							</div>							
							
							</div>
							
							<div class="col-md-6 col-sm-4 col-xs-12">
							<div class="out-circle" style="margin: 5px auto;">
								<p id="count" style="">00</p>
							</div>
								
							</div>
							
							<div class="col-sm-4 col-md-3 col-xs-12">
							
							<div class="in-circle" style="margin: 5px auto;">
								<p style="font-size: 32px">Stage</p>
							</div>

							<div class="in-circle" style="margin: 5px auto;">
								<p>Questions left to spin wheel </br><span>5/10</span></p>
							</div>	

									</div>

			<div class="col-sm-12 col-md-12 col-xs-12" style="height:15px; border:2px solid #ffeb3b; margin: 5px auto">
				<div style="border:1px solid #ffeb3b; padding-top:9px">
					<p style="background-color: #ffeb3b;height: 2px; margin-top: -5px;""></p>
				</div>
			</div>
						
					</div>
				
				</div>
				</div>

<?php include_once('includes/footer.php') ?>