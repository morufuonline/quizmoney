<?php include_once('../includes/user_header.php'); ?>

<div class="section pt-70 pb-80">

				<h3 class="text-uppercase mb-20 text-center">Select your game mode and start earning cash.</h3>
			
				<div class="container">
				
					<div class="user-action-wrapper">
			
						<div class="GridLex-gap-30">
						
							<div class="GridLex-grid-noGutter-equalHeight">
										
								<div class="GridLex-col-6_sm-6_xs-12">
								
									<div class="user-action-item clearfix">
									
										<div class="icon">
											<i class=" "><img src="../images/naira.png" style="padding-left: 132px;" /></i>
										</div>
										
										<div class="content">
										
											<h4 class="text-uppercase mb-20">Play with funded account mode.</h4>
											<p class="mb-25" style="text-align:left;">Once player funds account, he uses N100 to play. Here you can win big. This option is divided into categories players can choose on depending on their strength: Sports, entertainment, celebrities, History, Religion, Polities, finance, business, fashion, automobiles, quotes, books, movies, media, military, countries, animals, spellings, English, Catholic Christianity and maths. Once a player fails 3 question in this stage, he looses his N100. However, each question he gets gives him N10. Also a player has the option of quitting if he doesn't know the answer to a particular question and doesn't want to loose his money. Hence once he clicks quit before the timer ends, he gets the money he won added to his account. .</p>

				<?php if($account_type == 1 && $balance >= 100){ ?><a href="fund-game.php" class="btn btn-primary">PLAY GAME</a><?php } ?>
											
											
										</div>
									
									</div>
									
								</div>
										
								<div class="GridLex-col-6_sm-6_xs-12">
								
									<div class="user-action-item clearfix">
									
										<div class="icon">
											<i class="fa fa-thumbs-o-up"></i>
										</div>
										
										<div class="content">
										
											<h4 class="text-uppercase mb-20">Play free game mode</h4>
											<p class="mb-25" style="text-align:left;"">Player plays for free and answers 20 question correctly, then spins the wheel. Questions are random and without category here. Also where they fail too many questions in a stage, (10 questions), they are told to wait 1 hour before they can continue, pay N50 to continue playing or invite 20 facebook friends to continue playing.</p>
											
											<a href="free-game.php" class="btn btn-primary">PLAY GAME</a>
											
										</div>
									
									</div>
									
								</div>
								
							</div>
							
						</div>
						
					</div>
				
				</div>
				
			</div>


<?php include_once('../includes/user_footer.php'); ?>