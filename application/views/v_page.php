	<div class="row-fluid">
		<div class="span2">
		<div class="well sidebar-nav">
			<?=$sideMenu?>
			
		</div><!--/.well -->
		</div><!--/span-->
		<div class="span10">
			<div id="page">
				<?php
					//pre_print_r($page);
					
					$title=$page['title'];
					$content=$page['content'];	
				?>
				<h1><?=$title?></h1>
				<p>
					<?=$content?>
				</p>

			</div>
		</div><!--/span-->
	</div><!--/row-->
