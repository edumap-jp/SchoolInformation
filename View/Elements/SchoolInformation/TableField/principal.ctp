<?php if ($this->SchoolInformation->isDisplayPrincipal()): ?>
	<tr>
		<th><?php echo __d('school_informations', 'Principal Name') ?></th>
		<td>
			<ruby>
				<?php echo $this->SchoolInformation->display(
					'principal_name'
				); ?>
				<?php echo $this->SchoolInformation->display(
					'principal_name_kana',
					['tag' => 'rt']
				); ?>
			</ruby>
		</td>
	</tr>
<?php endif; ?>
