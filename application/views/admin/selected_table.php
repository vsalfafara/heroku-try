<style>
   #create-user {
      display: inline-block;
      text-decoration: none;
      background: #5bc0be;
      padding: 10px 20px;
      color: #fff;
      border-radius: 10px;
      margin-bottom: 20px;
   }
   
</style>
<h3>Selected Table: <?= $table ?></h3>
<input type="hidden" name="table" id="table-name" value="<?= $target ?>">
<?php if ($table === 'User' || $table === 'Login') {?>
   <a href="<?= base_url()?>admin/createuser" id="create-user">Create User</a>
<?php } ?>
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
            <?php foreach($data as $key => $value) { ?>
               <?php 
                  reset($data);
                  if ($key === key($data)) {
               ?>
               <td>
                  <?php if (!empty($link['edit'])) {?>
                     <a href="<?= $link['edit'] . $value?>"><i class="material-icons">create</i></a>
                  <?php } ?>
                  <?php if (!empty($link['delete'])) {?>
                     <a href="<?= $link['delete'] . $value?>" onclick="return confirm('Are you sure?')"><i class="material-icons">delete_forever</i></a>
                  <?php } ?>
               </td>
               <?php } if ($key != 'password') {?>
                  <td><?= $value ?></td>
               <?php } ?>
            <?php } ?>
         </tr>
      <?php } ?>
   </tbody>
</table>