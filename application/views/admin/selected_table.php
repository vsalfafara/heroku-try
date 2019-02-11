
<h3>Selected Table: <?= $table ?></h3>
<input type="hidden" name="table" id="table-name" value="<?= $target ?>">

<table>
   <thead>
      <tr>
         <th></th>
         <?php foreach($columns as $column) {?>
            <?php if ($column['column_name'] != 'password') {?>
               <th><?= $column['column_name'] ?></th>
            <?php } ?>
         <?php } ?>
      </tr>
   </thead>
   <tbody id="filter">
      <tr id="search-row">
         <td></td>
         <?php foreach($columns as $column) {?>
            <?php if ($column['column_name'] != 'password') {?>
               <td><input type="text" name="<?= $column['column_name'] ?>" class="table-text-search" placeholder="Search <?= $column['column_name'] ?>"></td>
            <?php } ?>
         <?php } ?>
      </tr>
      <?php foreach($table_values as $data) {?>
         <tr>
            <!-- <td>
               <a href="<?= $link['delete']?>" onclick="return confirm('Are you sure?')"><i class="material-icons">delete_forever</i></a>
               <a href="<?= $link['edit']?>"><i class="material-icons">create</i></a>
            </td> -->
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
   </tbody>
</table>