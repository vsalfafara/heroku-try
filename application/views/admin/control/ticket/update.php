<?php
   $CI =& get_instance();

   $CI->load->model('user_model');
   $CI->load->model('vessel_model');
   $CI->load->model('port_model');
   $CI->load->model('route_model');

   $users = $CI->user_model->getUsers();
   $vessels = $CI->vessel_model->getVessels();
   $ports = $CI->port_model->getPorts();
   $routes = $CI->route_model->getRoutes($data['port_gid']);

   $date = explode(' ', $data['voyage_date'])[0];
?>

<style>
   .container {
      box-sizing: border-box;
      height: 100%;
      min-width: 100%;
      padding: 20px;
      box-shadow: 0 10px 20px rgba(0,0,0,.25);
      background: #fff;
   }

   .header {
      margin-bottom: 50px;
   }

   .row {
      display: inline-flex;
      flex-direction: row;
      width: 75%;
      margin-bottom: 20px;
      padding: 0 20px;
      box-sizing: border-box;
      align-items: center;
   }

   form {
      display: flex;
      flex-direction: column;
   }

   label {
      min-width: 200px;
   }

   input {
      width: calc(100% - 200px);
      padding: 5px 10px;
   }

   input[type='date'] {
      padding: 2px 10px;
   }

   select {
      width: calc(100% - 200px);
      padding: 5px 10px;
   }

   .action {
      margin-top: 30px;
      display: flex;
      justify-content: flex-end;
   }

   .btn {
      padding: 10px 20px;
      width: 150px;
      text-align: center;
      color: #fff;
      margin: 10px;
      font-size: 14px;
      cursor: pointer;
   }

   .confirm {
      background: #5BC0BE;
   }

   .cancel {
      background: rgba(0, 0, 0, 0.5);
   }

</style>
<div class="container">
<div class="header"><h3>Updating: <?= $id ?></h3></div>
   <form method="post" action="<?= base_url()?>ticket_action/update">
   <div class="row">
      <input type="hidden" name="ticket_gid" value="<?= $data['ticket_gid']?>">
   </div>
   <div class="row">
      <label for="user_gid">User</label>
      <select name="user_gid" id="user_gid">
         <?php foreach ($users as $user) {?>
            <option value="<?= $user['user_gid'] ?>" <?= $user['user_gid'] == $data['user_gid'] ? 'selected' : ''?>>
               <?= $user['first_name'] . ' ' . $user['last_name']?>
            </option>
         <?php } ?>
      </select>
   </div>
   <div class="row">
      <label for="voyage_num">Voyage Number</label>
      <input type="number" name="voyage_num" id="voyage_num" value="<?= $data['voyage_num']?>">
   </div>
   <div class="row">
      <label for="voyage_data">Voyage Data</label>
      <input type="date" name="voyage_date" id="voyage_data" value="<?=$date?>">
   </div>
   <div class="row">
      <label for="vessel_gid">Vessel</label>
      <select name="vessel_gid" id="vessel_gid">
         <?php foreach ($vessels as $vessel) {?>
            <option value="<?= $vessel['vessel_gid']?>" <?= $vessel['vessel_gid'] == $data['vessel_gid'] ? 'selected' : '' ?>>
               <?= $vessel['vessel_name']?>
            </option>
         <?php } ?>
      </select>
   </div>
   <div class="row">
      <label for="port_gid">Port</label>
      <select name="port_gid" id="port_gid">
         <?php foreach ($ports as $port) {?>
            <option value="<?= $port['port_gid']?>" <?= $port['port_gid'] == $data['port_gid'] ? 'selected' : '' ?>>
               <?= $port['town'] . ', ' . $port['province']?>
            </option>
         <?php } ?>
      </select>
   </div>
   <div class="row">
      <label for="route_gid">Route</label>
      <select name="route_gid" id="route_gid">
         <?php foreach ($routes as $route) {?>
            <option value="<?= $route['route_gid']?>" <?= $route['route_gid'] == $data['route_gid'] ? 'selected' : '' ?>>
               <?= $route['source_location'] . ' to ' . $route['dest_location']?>
            </option>
         <?php } ?>
      </select>
   </div>
   <div class="row">
      <label for="fair_type">Fare Type</label>
      <select name="fair_type" id="fair_type">
         <option value="Senior Citizen">Senior Citizen</option>
         <option value="Half">Half</option>
         <option value="Regular">Regular</option>
         <option value="Student">Student</option>
      </select>
   </div>
   <div class="row">
      <label for="fair_price">Fare Price</label>
      <input type="text" name="fair_price" id="fair_price" readonly value="<?= $data['fair_price']?>">
   </div>
   <div class="action">
      <button value="Submit" name="submit" class="reset-this btn confirm">CONFIRM</button>
      <a href="<?= base_url()?>admin" class="reset-this btn cancel">CANCEL</a>
   </div>
   </form>
</div>

<script>
   const port = document.querySelector('#port_gid')
   const route = document.querySelector('#route_gid')
   const type = document.querySelector('#fair_type')
   const fare = document.querySelector('#fair_price')

   port.addEventListener('change', function() {
      let form = new FormData
      form.append('port', port.options[port.selectedIndex].value)
      fetch('<?= base_url()?>ticket_action/getRouteByPort', {
         method: 'post',
         body: form
      })
      .then(res => res.text())
      .then(function(data) {
         while (route.firstChild)
            route.firstChild.remove()

         route.innerHTML = data
      })

      checkValues()
   })

   route.addEventListener('change', () => checkValues())
   type.addEventListener('change', () => checkValues())

   function checkValues() {
      if (
         port.options[port.selectedIndex].value &&
         route.options[route.selectedIndex].value &&
         type.options[type.selectedIndex].value
      )
         {
            let form = new FormData
            form.append('port', port.options[port.selectedIndex].value)
            form.append('route', route.options[route.selectedIndex].value)
            form.append('type', type.options[type.selectedIndex].value)
            fetch('<?= base_url()?>ticket_action/getFare', {
               method: 'post',
               body: form
            })
            .then(res => res.text())
            .then(function(data) {
               fare.value = data;
            })
         }
   }
</script>