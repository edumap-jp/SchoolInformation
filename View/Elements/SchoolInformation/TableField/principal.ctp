<?php if ($this->SchoolInformation->isDisplayPrincipal()): ?>
	<tr>
		<th><?php echo $this->SchoolInformation->labelPrincipal(); ?></th>
		<td>
			<?php echo $this->SchoolInformation->displayPrincipal(); ?>
		</td>
	</tr>
<?php endif; ?>
