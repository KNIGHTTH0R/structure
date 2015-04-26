<?php

$object_params = json_decode( $params, TRUE );
extract( $object_params );	

$rss = simplexml_load_file( $url );
$count = 0;

?>
<h2><?=$rss->channel->title;?></h2>
<ul class="list-unstyled">
	<?php foreach( $rss->channel->item as $item ) :?>
		<?php
			if( $count == $feeds ) {
				break;
			}
		?>
		<li><a href="<?=$item->link;?>"><?=$item->title;?></a></li>
	<?php $count++; endforeach;?>	
</ul>