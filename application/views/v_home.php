	<div class="row-fluid">
		<div class="span2">
		<div class="well sidebar-nav">
			<?=$sideMenu?>
			
		</div><!--/.well -->
		</div><!--/span-->
		<div class="span10">
			<div id="blog">
				<?php
					//pre_print_r($blogs);
					foreach($blogs as $b){
						$link="/".$b['slug'];
						$title=$b['title'];
						$content=$b['content'];
						$date=$b['date'];
				?>
					<h1><a href="<?=SITEURL.$link?>"><?=$title?></a></h1>
					<p>
						<?=$date?>
					</p>
					<p>
						<?=$content?>
					</p>
					<hr />
				<?
					}
				?>
			</div>
		</div><!--/span-->
	</div><!--/row-->
