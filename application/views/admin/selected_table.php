<table>
   <thead>
      <tr>
         <?php foreach($table[0] as $key => $data) {?>
            <th><?= $key ?></th>
         <?php } ?>
      </tr>
   </thead>
   <tbody>
      <?php foreach($table as $key => $data) {?>
         <tr>
            <?php foreach($data as $value) { ?>
               <td><?= $value ?></td>
            <?php } ?>
         </tr>
      <?php } ?>
   </tbody>
</table>