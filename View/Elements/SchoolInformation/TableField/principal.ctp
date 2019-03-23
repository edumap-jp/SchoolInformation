<?php if ($this->SchoolInformation->isDisplayPrincipal()): ?>
	<tr>
		<th><?= __d('school_informations', 'Principal Name') ?></th>
		<td>
			<ruby>
				<?= $this->SchoolInformation->display(
					'principal_name'
				); ?>
				<?= $this->SchoolInformation->display(
					'principal_name_roma',
					['tag' => 'rt']
				); ?>
			</ruby>
		</td>
	</tr>
<?php endif; ?>
