	<div class="row-fluid">
		<div class="span4"></div>
		<div class="span4" id="admin-msg"></div>
		<div class="span4"></div>
	</div>
	<div class="row-fluid">
		<!-- <div class="span2">
			<div class="well sidebar-nav">
				<?=$menu?>
			</div>
		</div> -->
		<div class="span12">
			<div class="row-fluid">
				<div id="adminAjax">
					<div class="well">
						this looks empty now doesnt it...
					</div>
				</div>
			</div>
		</div><!--/span-->
	</div><!--/row-->

	<script type="text/javascript">
		$(function() {
			$('.adminMenu').click(function(){
				//alert($(this).attr('id'));
				var id=$(this).attr('id');
				if(id == 'pages'){
					$('#adminAjax').load('/admin/editPages/', function() {
						//alert('loaded');
					}).hide().fadeIn('slow');
					return false;
				}
			});
		});
	</script>