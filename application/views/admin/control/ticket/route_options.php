<option value="0" selected disabled>-- Select Route --</option>
<?php foreach ($routes as $route) {?>
   <option value="<?= $route['route_gid']?>"?>
      <?= $route['source_location'] . ' to ' . $route['dest_location']?>
   </option>
<?php } ?>