<?php
/**
 * データ未登録時の画面
 */
?>
<div align="right">
	<?php
	echo $this->LinkButton->edit(
		__d('net_commons', 'Edit'),
		[
			'action' => 'edit'
		]
	);
	?>
</div>
