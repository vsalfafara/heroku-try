<input type="hidden" name="table" id="table-name" value="<?= $target ?>">

<table>
   <thead>
      <tr>
         <?php foreach($columns as $column) {?>
            <?php if ($column['column_name'] != 'password') {?>
               <th><?= $column['column_name'] ?></th>
            <?php } ?>
         <?php } ?>
      </tr>
   </thead>
   <tbody id="filter">
      <tr id="search-row">
         <?php foreach($columns as $column) {?>
            <?php if ($column['column_name'] != 'password') {?>
               <td><input type="text" name="<?= $column['column_name'] ?>" class="table-text-search" placeholder="Search <?= $column['column_name'] ?>"></td>
            <?php } ?>
         <?php } ?>
      </tr>
      <?php foreach($table as $data) {?>
         <tr>
            <?php foreach($data as $key => $value) { ?>
               <?php if ($key != 'password') {?>
                  <td><?= $value ?></td>
               <?php } ?>
            <?php } ?>
         </tr>
      <?php } ?>
   </tbody>
</table>