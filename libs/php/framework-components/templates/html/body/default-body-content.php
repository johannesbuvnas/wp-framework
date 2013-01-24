<div id="page-wrapper">
	<div id="page-wrapper-inner">
		
		<?php 
			if($pageHeader) $pageHeader->render();
		?>
		
		<?php
			if($pageBody) $pageBody->render();
		?>
		
		<?php
			if($pageFooter) $pageFooter->render();
		?>
		
	</div>
</div>