<?php if ($this->SchoolInformation->isDisplay($field)): ?>
	<tr>
		<th>
			<?php
			if (isset($extraOptions['label'])) {
				echo $extraOptions['label'];
			} else {
				echo __d('school_informations', Inflector::humanize($field));
			}
			?>
		</th>
		<td>
			<?php echo $this->SchoolInformation->display($field, $extraOptions); ?>
		</td>
	</tr>
<?php endif; ?>
