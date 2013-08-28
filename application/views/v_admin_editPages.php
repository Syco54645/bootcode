<div class="span3">
	<div id="admin">
		<div class="well" style="overflow-x:hidden; overflow-y:scroll">
			<?=$pageList?>
		</div><!--/.well -->
	</div>
</div><!--/span-->
<div class="span9">
	<div id="admin">
		<div class="row-fluid">
			<div class="span12" id="ajax-area">
			</div>
		</div>
	</div>
</div><!--/span-->

<script type="text/javascript">
		$(function() {
			$( ".column" ).sortable({
				connectWith: ".column"
			});

			$( ".portlet" ).addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
				.find( ".portlet-header" )
					.addClass( "ui-widget-header ui-corner-all" )
					.prepend( "<span class='ui-icon ui-icon-minusthick'></span>")
					.end()
				.find( ".portlet-content" );

			$(".portlet-header .ui-icon" ).click(function() {
				$( this ).toggleClass( "ui-icon-minusthick" ).toggleClass( "ui-icon-plusthick" );
				//$( this ).parents( ".portlet:first" ).find( ".portlet-content" ).toggle();
				$(this).parent().next().toggle();
			});

			$(".portlet-header .ui-title" ).click(function() {
				//alert();
				$('#ajax-area').load('/admin/editPage/'+$(this).attr("rel"), function() {
					CKEDITOR.basePath = "/ckeditor/";
					if(CKEDITOR.instances['editor']) {
						delete CKEDITOR.instances['editor'];
						CKEDITOR.replace('editor');
					}else{
						CKEDITOR.replace('editor');
					}
					
				}).hide().fadeIn();
				return false;
			});

			$( ".column" ).disableSelection();
			$( ".portlet-header .ui-icon" ).click();
		});
	</script>
	<style>
		.column { width: 170px; float: left; padding-bottom: 8px; }
		.portlet { margin: 0 1em 0em 0; }
		.portlet-header { margin: 0.3em; padding-bottom: 0px; padding-left: 0.2em; }
		.portlet-header .ui-icon { float: right; }
		.portlet-content { padding: 0.4em; }
		.ui-sortable-placeholder { border: 1px dotted black; visibility: visible !important; height: 50px !important; }
		.ui-sortable-placeholder * { visibility: hidden; }
		.column .portlet{ margin-left:30px;}
	</style>