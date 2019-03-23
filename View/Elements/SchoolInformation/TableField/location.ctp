<?php if ($this->SchoolInformation->isDisplayLocation()): ?>
	<tr>
		<th><?= __d('school_informations', 'Location') ?></th>
		<td>
			<?= $this->SchoolInformation->displayLocation(); ?>
		</td>
	</tr>
<?php endif; ?>
