<?php foreach($table as $data) {?>
	<tr>
	<?php foreach($data as $key => $value) { ?>
		<?php if ($key != 'password') {?>
			<td><?= $value ?></td>
		<?php } ?>
	<?php } ?>
	</tr>
<?php } ?>