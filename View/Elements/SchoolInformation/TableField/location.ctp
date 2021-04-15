<?php if ($this->SchoolInformation->isDisplayLocation()): ?>
	<tr>
		<th><?php echo __d('school_informations', 'Location') ?></th>
		<td>
			<?php echo $this->SchoolInformation->displayLocation(); ?>
		</td>
	</tr>
<?php endif;