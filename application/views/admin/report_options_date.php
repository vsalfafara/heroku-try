<option value="empty" selected disabled>-- Select <?= $select ?> --</option>
<?php foreach ($options as $option) {?>
   <option value="<?= $option['voyage_date']?>"?>
      <?= $option['voyage_date'] ?>
   </option>
<?php } ?>