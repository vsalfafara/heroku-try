   <div class="db-tables">
      <h3>Choose a table</h3>
      <div class="table-list">
         <?php foreach ($tables as $table) {?>
            <button class="table" value="<?= $table['table_target']?>"><?= $table['table_name'] ?></button>
         <?php } ?>
      </div>
   </div>
   <div class="selected-table">
      <div id="injection">
      </div>
   </div>
   
   <script src="<?= base_url()?>assets/js/admin.js"></script>