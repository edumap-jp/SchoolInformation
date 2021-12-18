<?php if ($this->SchoolInformationHtml->isDisplayPrincipal()): ?>
	<tr>
		<th><?php echo $this->SchoolInformationHtml->labelPrincipal(); ?></th>
		<td>
			<?php echo $this->SchoolInformationHtml->displayPrincipal(); ?>
		</td>
	</tr>
<?php endif;
