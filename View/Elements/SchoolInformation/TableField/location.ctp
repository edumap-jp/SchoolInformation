<?php if ($this->SchoolInformationHtml->isDisplayLocation()): ?>
	<tr>
		<th><?php echo __d('school_informations', 'Location') ?></th>
		<td>
			<?php echo $this->SchoolInformationHtml->displayLocation(); ?>
		</td>
	</tr>
<?php endif;