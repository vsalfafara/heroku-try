<option value="empty" selected disabled>-- Select <?= $select?> --</option>
<?php foreach ($options as $option) {?>
   <option value="<?= $option['voyage_num']?>"?>
      <?= $option['voyage_num'] ?>
   </option>
<?php } ?>