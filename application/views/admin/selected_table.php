<table>
   <thead>
      <tr>
         <?php foreach($columns as $column) {?>
            <th><?= $column['column_name'] ?></th>
         <?php } ?>
      </tr>
   </thead>
   <tbody>
      <?php foreach($table as $data) {?>
         <tr>
            <?php foreach($data as $value) { ?>
               <td><?= $value ?></td>
            <?php } ?>
         </tr>
      <?php } ?>
   </tbody>
</table>