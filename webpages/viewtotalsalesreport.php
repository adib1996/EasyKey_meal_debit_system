<?php

    ob_start();

    include 'header.php';

    //Checks if there is a user logged in

    if(!isset($_SESSION['u_id'])){
    header("location: index.php?notloggedin"); //Sends unauthorized user back to homepage
    exit();
    }else{

    //Only authorizes admins to view this page

    if($_SESSION['u_role'] !== '1'){
    header("location: index.php?feature=adminonly"); //Sends customer/retailer back to homepage
    exit();
    }else{

      include 'processingforms/dbconnection.php'; //Includes database connection
?>
  <div id="bodyindex">

    <div class="dateselection">

      <h1>Select Date</h1>

    <form name="salesbymonth" target="_blank" action="generatetotalsalesreport.php" method="POST">

    <!-- Month Calendar -->

    <select name="monthselected" required>Select Month
    <option value="" <?php echo (isset($_POST['monthselected']) && $_POST['monthselected'] == '') ? 'selected="selected"' : ''; ?>>- Month -</option>
    <option value="1"<?php echo (isset($_POST['monthselected']) && $_POST['monthselected'] == '1') ? 'selected="selected"' : ''; ?>>January</option>
    <option value="2"<?php echo (isset($_POST['monthselected']) && $_POST['monthselected'] == '2') ? 'selected="selected"' : ''; ?>>Febuary</option>
    <option value="3"<?php echo (isset($_POST['monthselected']) && $_POST['monthselected'] == '3') ? 'selected="selected"' : ''; ?>>March</option>
    <option value="4"<?php echo (isset($_POST['monthselected']) && $_POST['monthselected'] == '4') ? 'selected="selected"' : ''; ?>>April</option>
    <option value="5"<?php echo (isset($_POST['monthselected']) && $_POST['monthselected'] == '5') ? 'selected="selected"' : ''; ?>>May</option>
    <option value="6"<?php echo (isset($_POST['monthselected']) && $_POST['monthselected'] == '6') ? 'selected="selected"' : ''; ?>>June</option>
    <option value="7"<?php echo (isset($_POST['monthselected']) && $_POST['monthselected'] == '7') ? 'selected="selected"' : ''; ?>>July</option>
    <option value="8"<?php echo (isset($_POST['monthselected']) && $_POST['monthselected'] == '8') ? 'selected="selected"' : ''; ?>>August</option>
    <option value="9"<?php echo (isset($_POST['monthselected']) && $_POST['monthselected'] == '9') ? 'selected="selected"' : ''; ?>>September</option>
    <option value="10"<?php echo (isset($_POST['monthselected']) && $_POST['monthselected'] == '10') ? 'selected="selected"' : ''; ?>>October</option>
    <option value="11"<?php echo (isset($_POST['monthselected']) && $_POST['monthselected'] == '11') ? 'selected="selected"' : ''; ?>>November</option>
    <option value="12"<?php echo (isset($_POST['monthselected']) && $_POST['monthselected'] == '12') ? 'selected="selected"' : ''; ?>>December</option>
    </select>

    <!-- Day Calendar, includes days only if checkbox is ticked-->
    <div class="includedaycheckbox">
    <input id="daycheckbox" type="checkbox" name="dayincludecheck" onchange = "showHide()" value="dayincluded">Include Day
    </div>

    <select style="display: none" id="daycalendar" name="dayselected">Select Day
    <option value="" <?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '') ? 'selected="selected"' : ''; ?>>- Day -</option>
    <option value="1"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '1') ? 'selected="selected"' : ''; ?>>1</option>
    <option value="2"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '2') ? 'selected="selected"' : ''; ?>>2</option>
    <option value="3"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '3') ? 'selected="selected"' : ''; ?>>3</option>
    <option value="4"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '4') ? 'selected="selected"' : ''; ?>>4</option>
    <option value="5"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '5') ? 'selected="selected"' : ''; ?>>5</option>
    <option value="6"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '6') ? 'selected="selected"' : ''; ?>>6</option>
    <option value="7"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '7') ? 'selected="selected"' : ''; ?>>7</option>
    <option value="8"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '8') ? 'selected="selected"' : ''; ?>>8</option>
    <option value="9"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '9') ? 'selected="selected"' : ''; ?>>9</option>
    <option value="10"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '10') ? 'selected="selected"' : ''; ?>>10</option>
    <option value="11"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '11') ? 'selected="selected"' : ''; ?>>11</option>
    <option value="12"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '12') ? 'selected="selected"' : ''; ?>>12</option>
    <option value="13"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '13') ? 'selected="selected"' : ''; ?>>13</option>
    <option value="14"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '14') ? 'selected="selected"' : ''; ?>>14</option>
    <option value="15"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '15') ? 'selected="selected"' : ''; ?>>15</option>
    <option value="16"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '16') ? 'selected="selected"' : ''; ?>>16</option>
    <option value="17"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '17') ? 'selected="selected"' : ''; ?>>17</option>
    <option value="18"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '18') ? 'selected="selected"' : ''; ?>>18</option>
    <option value="19"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '19') ? 'selected="selected"' : ''; ?>>19</option>
    <option value="20"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '20') ? 'selected="selected"' : ''; ?>>20</option>
    <option value="21"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '21') ? 'selected="selected"' : ''; ?>>21</option>
    <option value="22"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '22') ? 'selected="selected"' : ''; ?>>22</option>
    <option value="23"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '23') ? 'selected="selected"' : ''; ?>>23</option>
    <option value="24"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '24') ? 'selected="selected"' : ''; ?>>24</option>
    <option value="25"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '25') ? 'selected="selected"' : ''; ?>>25</option>
    <option value="26"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '26') ? 'selected="selected"' : ''; ?>>26</option>
    <option value="27"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '27') ? 'selected="selected"' : ''; ?>>27</option>
    <option value="28"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '28') ? 'selected="selected"' : ''; ?>>28</option>
    <option value="29"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '29') ? 'selected="selected"' : ''; ?>>29</option>
    <option value="30"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '30') ? 'selected="selected"' : ''; ?>>30</option>
    <option value="31"<?php echo (isset($_POST['dayselected']) && $_POST['dayselected'] == '31') ? 'selected="selected"' : ''; ?>>31</option>
    </select>

    <div class="selectdatebutton">
    <button type="submit" name="submit">Submit</button>
    </div>

    </form>

  </div>
  </div>

    <?php
      }
      }
      ?>

<?php
include 'footer.php';
?>

<script>

      function showHide(){
        if(document.getElementById('daycheckbox').checked == true){
           document.getElementById('daycalendar').style.display='inline-block';
           $('#daycalendar').attr('required', '');

        }else{
          document.getElementById('daycalendar').style.display='none';
          document.getElementById('daycalendar').value ="";
          $('#daycalendar').removeAttr('required');
        }
      }

</script>
