<?php if ($this->SchoolInformation->isDisplayPrincipal()): ?>
	<tr>
		<th><?php echo __d('school_informations', 'Principal Name') ?></th>
		<td>
			<?php echo $this->SchoolInformation->displayPrincipal(); ?>
		</td>
	</tr>
<?php endif; ?>
