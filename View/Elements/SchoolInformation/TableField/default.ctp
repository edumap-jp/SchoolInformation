<?php if ($this->SchoolInformationHtml->isDisplay($field)): ?>
	<tr>
		<th>
			<?php
			$methodName = 'label' . ucfirst(Inflector::camelize($field));
			if (isset($extraOptions['label'])) :
				echo $extraOptions['label'];
			elseif (method_exists($this->SchoolInformationHtml, $methodName)) :
				echo $this->SchoolInformationHtml->$methodName();
			else :
				echo __d('school_informations', Inflector::humanize($field));
			endif;
			?>
		</th>
		<td>
			<?php echo $this->SchoolInformationHtml->display($field, $extraOptions); ?>
		</td>
	</tr>
<?php endif;
