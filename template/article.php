<div class="span9">
	<div class="hero-unit">
		<h2><?php echo urldecode($TEMPLATE['title'])?></h2>
		<p><?php echo eval('?>'.$TEMPLATE['parsedText'].'<?php ')?></p>
		<?php if($TEMPLATE['user_id'] !== false){?>
		<a class="btn btn-danger" href="<?php echo ltrim(dirname($_SERVER['SCRIPT_NAME']), ' \\');?>/wiki/<?php echo $TEMPLATE['id']."/".preg_replace( '/\s+/', '_', $item['title']);?>/remove"><i class="icon-remove"></i>remove</a>
		<a class="btn btn-primary" href="<?php echo ltrim(dirname($_SERVER['SCRIPT_NAME']), ' \\');?>/wiki/<?php echo $TEMPLATE['id']."/".preg_replace( '/\s+/', '_', $item['title']);?>/change"><i class="icon-pencil"></i>change</a>
		<?php }
			 $first = true; 
			foreach($TEMPLATE['linklist'] as $item){
			if($first){
				$first = false;
				echo "<br><br>Linked by:";
			}?>
			<li><a href="<?php echo ltrim(dirname($_SERVER['SCRIPT_NAME']), ' \\');?>/wiki/<?php echo $item['id']."/".preg_replace('/\s+/', '_', $item['title']);?>/"> <?php echo $item['title'];?></a></li>
		<?php }?> 
		
		Creator:<?php echo $TEMPLATE['UserCreate']?><br />
		Modified by:<?php echo $TEMPLATE['UserModified']?><br />
		Last Modification:<?php echo $TEMPLATE['dateMod']?><br />
	</div>
</div>
