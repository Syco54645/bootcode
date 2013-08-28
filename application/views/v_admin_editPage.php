<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
	$('#save-page').click(function(){
		submitPage();
	});

	$('#slug-span').click(function(){
		$(this).hide();
		$('#slug-edit').show();
	});

	$('#slug-cancel').click(function(){
		$('#slug-edit').hide();
		$('#slug-span').show();
		$('#slug').val($('#slug-span').html());
		return(false);
	});

	$('#slug-ok').click(function(){
		$('#slug-checker').load('/admin/checkSlug/'+$('#slug').val()+'/'+$('#post_id').val(), function(){
			$('#slug-edit').hide();
			$('#slug-span').html($('#slug-checker').html());
			$('#slug').val($('#slug-checker').html());
			$('#slug-span').show();
		});
		return(false);
	});

	function slugify(text){
		return text.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
	}

	//setup before functions
	var typingTimer;
	var doneTypingInterval = 1200;
	//on keyup, start the countdown
	$('#title').keyup(function(){
		typingTimer = setTimeout(doneTyping, doneTypingInterval);
	});

	//on keydown, clear the countdown 
	$('#title').keydown(function(){
		clearTimeout(typingTimer);
	});

	function doneTyping () {
		$('#slug').val(slugify($('#title').val()));
		$('#slug-ok').click();
	}

	function submitPage(){
		var title = $.trim($('#title').val());
		var contents = CKEDITOR.instances['editor'].getData(); //$.trim($('#editor').val());
		var post_id=$('#post_id').val();
		var status=$('#status').val();
		
		if(title==""){
			//dont send form				
			return;
		}else{

			var data = "post_id="+post_id;
			$.ajax({
				type: "POST",
				url: "/admin/deleteCategories",
				data: data,
				success: function() {
					//$('#admin-msg').html("Page saved successfully!!!");
					//$('#adminAjax').load('/admin/editPages/').hide().fadeIn('slow'); //reload the menu editor thingy
				}
			});
			$('.category:checked').each(function(){
				var data = "post_id="+post_id+"&category_id="+$(this).attr('rel');
				$.ajax({
					type: "POST",
					url: "/admin/saveCategory",
					data: data,
					success: function() {
						//$('#admin-msg').html("Page saved successfully!!!");
						//$('#adminAjax').load('/admin/editPages/').hide().fadeIn('slow'); //reload the menu editor thingy
					}
				});
			});
			
			var data = "title="+title+"&contents="+contents+"&post_id="+post_id+"&status="+status;
			$.ajax({
				type: "POST",
				url: "/admin/savePage",
				data: data,
				success: function() {
					$('#admin-msg').html("Page saved successfully!!!");
					$('#adminAjax').load('/admin/editPages/').hide().fadeIn('slow'); //reload the menu editor thingy
				}
			});
			return false;
		}
	}
</script>

<div class="well" id="postEditor">
	<div class="well" id="post-stats">
		<a class="btn btn-primary btn-small" id="save-page">Save</a><br /><br />
		<select name="status" id="status">
			<option value="0">Draft</option>
			<?php
				$selected="";
				if($status)
					$selected="selected = 'selected'";
			?>
			<option value="1" <?=$selected?>>Published</option>
		</select>
	</div>
	<input type="hidden" value="<?=$post_id?>" name="post_id" id="post_id" />
	<label for="title">Title</label><input type="text" name="title" id="title" value="<?=$title?>" /><br />
	<label for="link">Link</label><?=SITEURL?>/<span id="slug-span"><?=$slug?></span><span id="slug-checker" style="display:none"></span><span id="slug-edit" style="display:none"><input type="text" name="slug" id="slug" value="<?=$slug?>" /><a href="#" id="slug-ok">OK</a><a href="#" id="slug-cancel">Cancel</a></span><br />
	<?php

		
	?>
	<hr />
	<label for="editor">Contents</label>
	<textarea class="" name="editor" id="editor"><?=$content?></textarea>
</div>
<div class="well" id="categories">
	<h2>Categories</h2>
	<a href="/admin/addCategory">Add Category</a><br />
	<?php
		foreach($categories as $c){
			if($c['page'] !=1){
				continue;
			}
			$cslug=$c['category_slug'];
			$cname=$c['category_name'];
			$cid=$c['category_id'];

			$checked="";
			if(array_search($c['category_id'], $postCategories)){
				$checked="checked = 'checked'";
			}

			echo "<input type='checkbox' id='$cslug' class='category' name='$cslug' value='$cslug' $checked rel='$cid'/><label for='$cslug'>$cname</label>";
		}
		//pre_print_r($postCategories);
	?>
</div>
