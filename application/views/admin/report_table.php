<?php foreach ($report as $data) {?>
   <tr>
      <td><?= $data['port_from']?></td>
      <td><?= $data['port_to']?></td>
      <td><?= $data['from_no']?></td>
      <td><?= $data['to_no']?></td>
      <td><?= $data['fare']?></td>
      <td><?= $data['passengers']?></td>
      <td><?= $data['price']?></td>
      <td><?= $data['total']?></td>
   </tr>
<?php }?>
   <tr style="background: none; margin-top: 10px; font-weight: bolder; font-size: 14px;">
      <td colspan="5" style="text-align: right">Total Ticketed Passengers</td>
      <td><?= $total_record['total_passengers']?></td>
      <td>Gross Sales: Php</td>
      <td><?= $total_record['total_sum']?></td>
   </tr>