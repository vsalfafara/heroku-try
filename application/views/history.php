<div class="header">
   <div class="port-name">
      <h1>San Jose Mindoro Port</h1>
   </div>
   <div class="history">
      <h1>TICKET HISTORY</h1>
   </div>
</div>
<div class="history-table">
   <div class="history-form">
      <div class="form-group">
         <label for="from">Time From: </label>
         <input type="text" name="from">
      </div>
      <div class="form-group">
         <label for="to">Time To: </label>
         <input type="text" name="to">
      </div>
      <div class="form-group">
         <label for="display">Display: </label>
         <input type="text" name="display">
      </div>
   </div>
   <table>
      <thead>
         <tr>
            <th>Vessel</th>
            <th>Voyage Number</th>
            <th>Voyage Date <br><span>MM|DD|YY</span></th>
            <th>Route</th>
            <th>Fare</th>
            <th>Booked</th>
         </tr>
      </thead>
      <tbody>
         <?php foreach ($tickets as $ticket) { ?>
            <tr>
               <td><?= $ticket['vessel_name']?></td>
               <td><?= $ticket['voyage_num']?></td>
               <td><?= $ticket['voyage_date']?></td>
               <td><?= $ticket['route']?></td>
               <td><?= $ticket['fair_type']?></td>
               <td><?= $ticket['insert_date']?></td>
            </tr>
         <?php } ?>
      </tbody>
   </table>
</div>