<?php if ($this->SchoolInformation->isDisplay($field)): ?>
	<tr>
		<th>
			<?php
			$methodName = 'label' . ucfirst(Inflector::camelize($field));
			if (isset($extraOptions['label'])) {
				echo $extraOptions['label'];
			} elseif (method_exists($this->SchoolInformation, $methodName)) {
				echo $this->SchoolInformation->$methodName();
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
