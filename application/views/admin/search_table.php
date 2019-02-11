<?php foreach($table_values as $data) {?>
	<tr>
		<?php foreach($data as $key => $value) { ?>
			<?php 
				reset($data);
				if ($key === key($data)) {
			?>
				<td>
					<a href="<?= $link['delete'] . $value?>" onclick="return confirm('Are you sure?')"><i class="material-icons">delete_forever</i></a>
					<a href="<?= $link['edit'] . $value?>"><i class="material-icons">create</i></a>
				</td>
			<?php } if ($key != 'password') {?>
				<td><?= $value ?></td>
			<?php } ?>
		<?php } ?>
	</tr>
<?php } ?>