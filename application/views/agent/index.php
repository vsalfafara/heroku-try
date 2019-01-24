
<div id="blur">
   <nav>
      <div class="container">
         <p>Solex Argo Ferry Corporation</p>
         <!-- REMOVE A TAG ONCE SIDEBAR DESIGN IS UP -->
         <a href="<?= base_url()?>login/logout"><i class="material-icons">dehaze</i></a>
      </div>
   </nav>
   <div class="header">
      <div class="port-name">
         <h1>San Jose Mindoro Port</h1>
      </div>
      <div class="progress-section">
         <div class="progress">
            <span>1</span>
            <p class="progress-name">Vessel <br> Selection</p>
         </div>
         <div class="progress">
            <span>2</span>
            <p class="progress-name">Voyage <br> Details</p>
         </div>
         <div class="progress">
            <span>3</span>
            <p class="progress-name">Route <br> Options</p>
         </div>
         <div class="progress">
            <span>4</span>
            <p class="progress-name">Fare <br> Options</p>
         </div>
         <div class="progress">
            <span>5</span>
            <p class="progress-name">Confirm</p>
         </div>
      </div>
   </div>

   <div class="nav-btns">
      <button id="back" class="btn-nav"><</button>
      <button id="next" class="btn-nav">></button>
   </div>
   <div class="form-slide">
      <section class="originLeft reveal">
         <div class="container">
            <h1>Vessel Selection</h1>
            <p>Choose a vessel</p>
            <div class="vessels">
               <!-- <button class="vessel" value="1">MV ARGE DE ORO-I</button>
               <button class="vessel" value="2">MV ARGE DE ORO-II</button>
               <button class="vessel" value="3">MV ARGE DE ORO-III</button>
               <button class="vessel" value="4">MV KALAYAN XI</button> -->
               <?php foreach($vessels as $vessel) { ?>
                  <button class="vessel form-btn" value="<?= $vessel['vessel_gid']?>"><?= $vessel['vessel_name']?></button>
               <?php } ?>
            </div>
         </div>
      </section>
      <section class="originRight">
         <div class="container">
            <h1>Voyage Details</h1>
            <div class="voyage">
               <p>Voyage Number</p>
               <div class="voyage-number">
                  <input type="number" id="voyage-number">
                  <i class="material-icons">check</i>
               </div>
               <p>Voyage Date</p>
               <div class="voyage-date">
                  <select name="year" id="year">
                     <option value="" disabled selected>Year</option>
                     <option value="2019">2019</option>
                     <option value="2020">2020</option>
                     <option value="2021">2021</option>
                     <option value="2022">2022</option>
                     <option value="2023">2023</option>
                  </select>
                  <select name="month" id="month">
                     <option value="" disabled selected>Month</option>
                     <option value="1">January</option>
                     <option value="2">February</option>
                     <option value="3">Match</option>
                     <option value="4">April</option>
                     <option value="5">May</option>
                     <option value="6">June</option>
                     <option value="7">July</option>
                     <option value="8">August</option>
                     <option value="9">September</option>
                     <option value="10">October</option>
                     <option value="11">November</option>
                     <option value="12">December</option>
                  </select>
                  <select name="day" id="day">
                     <option value="" disabled selected>Day</option>
                  </select>
               </div>
               <p>Ticketing Agent</p>
               <div class="ticketing-agent">
                  <input type="text" id="voyage-agent">
               </div>
            </div>
         </div>
      </section>
      <section class="originRight">
         <div class="container">
            <h1>Route Options</h1>
            <p>Choose a route</p>
            <div class="routes">
               <!-- <button class="route form-btn" value="1">San Jose - Caluya</button>
               <button class="route form-btn" value="2">San Jose - Calusi</button>
               <button class="route form-btn" value="3">San Jose - Libertad</button>
               <button class="route form-btn" value="4">San Jose - Semirara</button> -->

               <?php foreach($routes as $route) { ?>
                  <button class="route form-btn" value="<?= $route['route_gid']?>"><?= $route['source_location'] . ' - ' . $route['dest_location'] ?></button>
               <?php } ?>
            </div>
         </div>
      </section>
      <section class="originRight">
         <div class="container">
            <h1>Fare Options</h1>
            <p>Choose a fare</p>
            <div class="fares">
               <button class="fare form-btn" value="Senior Citizen">Senior Citizen</button>
               <button class="fare form-btn" value="Half">Half</button>
               <button class="fare form-btn" value="Regular">Regular</button>
               <button class="fare form-btn" value="Student">Student</button>
            </div>
         </div>
      </section>
   </div>
</div>
<div class="modal">  
   <div class="container">
      <h3>Booking Confirmation</h3>
      <div class="booking-details">
         <div class="left">
            <h4>Vessel Selection</h4>
            <p>Vessel</p>
         </div>
         <div class="right">
            <h4 id="confirm-vessel"></h4>
         </div>
      </div>
      <div class="booking-details">
         <div class="left">
            <h4>Voyage Details</h4>
            <div class="sub-details">
               <p>Voyage Number</p>
               <p>Voyage Date</p>
               <p>Ticketing Agent</p>
            </div>
         </div>
         <div class="right">
            <div class="sub-details">
               <h4 id="confirm-number"></h4>
               <h4 id="confirm-date"></h4>
               <h4 id="confirm-agent"></h4>
            </div>
         </div>
      </div>
      <div class="booking-details">
         <div class="left">
            <h4>Route Options</h4>
            <p>Route</p>
         </div>
         <div class="right">
            <h4 id="confirm-route"></h4>
         </div>
      </div>
      <div class="booking-details">
         <div class="left">
            <h4>Fare Options</h4>
            <p>Fare</p>
         </div>
         <div class="right">
            <h4 id="confirm-fare"></h4>
         </div>
      </div>
   </div>
   <form method="post" action="insertTicket">
      <input type="text" id="vessel" name="vessel">
      <input type="text" id="number" name="number">
      <input type="text" id="date" name="date">
      <input type="text" id="ticketing-agent" name="ticketing-agent">
      <input type="text" id="route" name="route">
      <input type="text" id="fare" name="fare">
      <div class="action-buttons">
         <button id="edit">EDIT</button>
         <button id="submit">CONFIRM</button>
      </div>
   </form>
</div>
<script>
   let agentName = '<?= $agent ?>'
</script>
<script src="<?= base_url()?>assets/js/main.js"></script>
<script src="<?= base_url()?>assets/js/date.js"></script>