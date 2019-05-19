<?php

ob_start();

include 'header.php';

if(isset($_SESSION['u_id'])){
  header("location: index.php?signup=alreadysignedin");
  exit();
}
?>

<div id="body">

<div class="errorsuccesspanel">

    <?php
    if(strpos($fullURL, "signup=empty") == TRUE) {
        echo "<p class='error'>Fill in all fields!</p>";
    }

    else if(strpos($fullURL, "signup=invalidname") == TRUE){
      echo "<p class='error'>Please enter valid names</p>";
    }

    else if(strpos($fullURL, "signup=invalidemail") == TRUE){
      echo "<p class='error'>Please enter a valid email</p>";
    }

    else if(strpos($fullURL, "signup=invaliduserid") == TRUE){
      echo "<p class='error'>Please enter a valid user id</p>";
    }

    else if(strpos($fullURL, "signup=invalidphonenumber") == TRUE){
      echo "<p class='error'>Please enter a valid phone number</p>";
    }

    else if(strpos($fullURL, "signup=invalidage") == TRUE){
      echo "<p class='error'>You must be 18 years of age to sign up</p>";
    }

    else if(strpos($fullURL, "signup=invalidpassword") == TRUE){
      echo "<p class='error'>Please enter a valid password</p>";
    }
    
    else if(strpos($fullURL, "signup=invalidzipcode") == TRUE){
      echo "<p class='error'>Please enter a valid zipcode</p>";
    }

    else if(strpos($fullURL, "signup=usernametaken") == TRUE){
      echo "<p class='error'>Username is already taken</p>";
    }

    else if(strpos($fullURL, "signup=passwordmismatch") == TRUE){
      echo "<p class='error'>Passwords mismatch</p>";
    }

    else if(strpos($fullURL, "signup=error") == TRUE){
      echo "<p class='error'>An error has occured, try again</p>";
    }
    ?>

</div>

<form class="signup-form" name="signup" action="processingforms/signupprocessing.php" method="POST">

  <div class="signuptitle">
    <h1>Sign Up</h1>
  </div>

  <div>
  <div class="firstlast">
    <label>First Name</label>
    <input type="text" name="firstname" maxlength="20" placeholder="First Name" required/>
  </div>

  <div class="firstlast">
    <label>Last Name</label>
      <input type="text" name="lastname" maxlength="20" placeholder="Last Name" required/>
  </div>
  </div>

  <div class="email">
    <label>E-Mail</label>
      <input type="email" name="email" maxlength="40" placeholder="E-Mail" required/>
  </div>

  <div class="username">
    <label>Username (4-12 Characters Long)</label>
      <input type="text" name="username" placeholder="Username" pattern=".{4,12}" required/>
  </div>

  <div class="passwords">
    <label>Password <br/><br/>(4-12 Characters, Contain at least one Lower-Case letter, One Upper-Case Letter and One Digit)</label>
      <input type="password" name="password" id="thepassword" placeholder="4-12 Characters and Contains at least 1 digit" pattern=".{4,12}" required/>
  </div>

  <div class="checkboxespassword">
    <input type="checkbox" onclick="showPassword()">Show Password
  </div>

  <div class="passwords">
    <label>Re-Enter Password</label>
      <input type="password" name="secpassword" id="repeatpassword" placeholder="Re-enter Password" pattern=".{4,12}" required/>
  </div>

  <div class="checkboxespassword">
    <input type="checkbox" onclick="showRepeatPassword()">Show Password
  </div>

  <div class="selectnationality">
  <label>Nationality</label>
  <select name="nationality" required>
      <option value="" disabled="disabled" selected="selected">Select Country</option>
      <option value="Afganistan">Afghanistan</option>
      <option value="Albania">Albania</option>
      <option value="Algeria">Algeria</option>
      <option value="American Samoa">American Samoa</option>
      <option value="Andorra">Andorra</option>
      <option value="Angola">Angola</option>
      <option value="Anguilla">Anguilla</option>
      <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
      <option value="Argentina">Argentina</option>
      <option value="Armenia">Armenia</option>
      <option value="Aruba">Aruba</option>
      <option value="Australia">Australia</option>
      <option value="Austria">Austria</option>
      <option value="Azerbaijan">Azerbaijan</option>
      <option value="Bahamas">Bahamas</option>
      <option value="Bahrain">Bahrain</option>
      <option value="Bangladesh">Bangladesh</option>
      <option value="Barbados">Barbados</option>
      <option value="Belarus">Belarus</option>
      <option value="Belgium">Belgium</option>
      <option value="Belize">Belize</option>
      <option value="Benin">Benin</option>
      <option value="Bermuda">Bermuda</option>
      <option value="Bhutan">Bhutan</option>
      <option value="Bolivia">Bolivia</option>
      <option value="Bonaire">Bonaire</option>
      <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
      <option value="Botswana">Botswana</option>
      <option value="Brazil">Brazil</option>
      <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
      <option value="Brunei">Brunei</option>
      <option value="Bulgaria">Bulgaria</option>
      <option value="Burkina Faso">Burkina Faso</option>
      <option value="Burundi">Burundi</option>
      <option value="Cambodia">Cambodia</option>
      <option value="Cameroon">Cameroon</option>
      <option value="Canada">Canada</option>
      <option value="Canary Islands">Canary Islands</option>
      <option value="Cape Verde">Cape Verde</option>
      <option value="Cayman Islands">Cayman Islands</option>
      <option value="Central African Republic">Central African Republic</option>
      <option value="Chad">Chad</option>
      <option value="Channel Islands">Channel Islands</option>
      <option value="Chile">Chile</option>
      <option value="China">China</option>
      <option value="Christmas Island">Christmas Island</option>
      <option value="Cocos Island">Cocos Island</option>
      <option value="Colombia">Colombia</option>
      <option value="Comoros">Comoros</option>
      <option value="Congo">Congo</option>
      <option value="Cook Islands">Cook Islands</option>
      <option value="Costa Rica">Costa Rica</option>
      <option value="Cote DIvoire">Cote D'Ivoire</option>
      <option value="Croatia">Croatia</option>
      <option value="Cuba">Cuba</option>
      <option value="Curaco">Curacao</option>
      <option value="Cyprus">Cyprus</option>
      <option value="Czech Republic">Czech Republic</option>
      <option value="Denmark">Denmark</option>
      <option value="Djibouti">Djibouti</option>
      <option value="Dominica">Dominica</option>
      <option value="Dominican Republic">Dominican Republic</option>
      <option value="East Timor">East Timor</option>
      <option value="Ecuador">Ecuador</option>
      <option value="Egypt">Egypt</option>
      <option value="El Salvador">El Salvador</option>
      <option value="Equatorial Guinea">Equatorial Guinea</option>
      <option value="Eritrea">Eritrea</option>
      <option value="Estonia">Estonia</option>
      <option value="Ethiopia">Ethiopia</option>
      <option value="Falkland Islands">Falkland Islands</option>
      <option value="Faroe Islands">Faroe Islands</option>
      <option value="Fiji">Fiji</option>
      <option value="Finland">Finland</option>
      <option value="France">France</option>
      <option value="French Guiana">French Guiana</option>
      <option value="French Polynesia">French Polynesia</option>
      <option value="French Southern Ter">French Southern Ter</option>
      <option value="Gabon">Gabon</option>
      <option value="Gambia">Gambia</option>
      <option value="Georgia">Georgia</option>
      <option value="Germany">Germany</option>
      <option value="Ghana">Ghana</option>
      <option value="Gibraltar">Gibraltar</option>
      <option value="Great Britain">Great Britain</option>
      <option value="Greece">Greece</option>
      <option value="Greenland">Greenland</option>
      <option value="Grenada">Grenada</option>
      <option value="Guadeloupe">Guadeloupe</option>
      <option value="Guam">Guam</option>
      <option value="Guatemala">Guatemala</option>
      <option value="Guinea">Guinea</option>
      <option value="Guyana">Guyana</option>
      <option value="Haiti">Haiti</option>
      <option value="Hawaii">Hawaii</option>
      <option value="Honduras">Honduras</option>
      <option value="Hong Kong">Hong Kong</option>
      <option value="Hungary">Hungary</option>
      <option value="Iceland">Iceland</option>
      <option value="India">India</option>
      <option value="Indonesia">Indonesia</option>
      <option value="Iran">Iran</option>
      <option value="Iraq">Iraq</option>
      <option value="Ireland">Ireland</option>
      <option value="Isle of Man">Isle of Man</option>
      <option value="Israel">Israel</option>
      <option value="Italy">Italy</option>
      <option value="Jamaica">Jamaica</option>
      <option value="Japan">Japan</option>
      <option value="Jordan">Jordan</option>
      <option value="Kazakhstan">Kazakhstan</option>
      <option value="Kenya">Kenya</option>
      <option value="Kiribati">Kiribati</option>
      <option value="Korea North">Korea North</option>
      <option value="Korea Sout">Korea South</option>
      <option value="Kuwait">Kuwait</option>
      <option value="Kyrgyzstan">Kyrgyzstan</option>
      <option value="Laos">Laos</option>
      <option value="Latvia">Latvia</option>
      <option value="Lebanon">Lebanon</option>
      <option value="Lesotho">Lesotho</option>
      <option value="Liberia">Liberia</option>
      <option value="Libya">Libya</option>
      <option value="Liechtenstein">Liechtenstein</option>
      <option value="Lithuania">Lithuania</option>
      <option value="Luxembourg">Luxembourg</option>
      <option value="Macau">Macau</option>
      <option value="Macedonia">Macedonia</option>
      <option value="Madagascar">Madagascar</option>
      <option value="Malaysia">Malaysia</option>
      <option value="Malawi">Malawi</option>
      <option value="Maldives">Maldives</option>
      <option value="Mali">Mali</option>
      <option value="Malta">Malta</option>
      <option value="Marshall Islands">Marshall Islands</option>
      <option value="Martinique">Martinique</option>
      <option value="Mauritania">Mauritania</option>
      <option value="Mauritius">Mauritius</option>
      <option value="Mayotte">Mayotte</option>
      <option value="Mexico">Mexico</option>
      <option value="Midway Islands">Midway Islands</option>
      <option value="Moldova">Moldova</option>
      <option value="Monaco">Monaco</option>
      <option value="Mongolia">Mongolia</option>
      <option value="Montserrat">Montserrat</option>
      <option value="Morocco">Morocco</option>
      <option value="Mozambique">Mozambique</option>
      <option value="Myanmar">Myanmar</option>
      <option value="Nambia">Nambia</option>
      <option value="Nauru">Nauru</option>
      <option value="Nepal">Nepal</option>
      <option value="Netherland Antilles">Netherland Antilles</option>
      <option value="Netherlands">Netherlands (Holland, Europe)</option>
      <option value="Nevis">Nevis</option>
      <option value="New Caledonia">New Caledonia</option>
      <option value="New Zealand">New Zealand</option>
      <option value="Nicaragua">Nicaragua</option>
      <option value="Niger">Niger</option>
      <option value="Nigeria">Nigeria</option>
      <option value="Niue">Niue</option>
      <option value="Norfolk Island">Norfolk Island</option>
      <option value="Norway">Norway</option>
      <option value="Oman">Oman</option>
      <option value="Pakistan">Pakistan</option>
      <option value="Palau Island">Palau Island</option>
      <option value="Palestine">Palestine</option>
      <option value="Panama">Panama</option>
      <option value="Papua New Guinea">Papua New Guinea</option>
      <option value="Paraguay">Paraguay</option>
      <option value="Peru">Peru</option>
      <option value="Phillipines">Philippines</option>
      <option value="Pitcairn Island">Pitcairn Island</option>
      <option value="Poland">Poland</option>
      <option value="Portugal">Portugal</option>
      <option value="Puerto Rico">Puerto Rico</option>
      <option value="Qatar">Qatar</option>
      <option value="Republic of Montenegro">Republic of Montenegro</option>
      <option value="Republic of Serbia">Republic of Serbia</option>
      <option value="Reunion">Reunion</option>
      <option value="Romania">Romania</option>
      <option value="Russia">Russia</option>
      <option value="Rwanda">Rwanda</option>
      <option value="St Barthelemy">St Barthelemy</option>
      <option value="St Eustatius">St Eustatius</option>
      <option value="St Helena">St Helena</option>
      <option value="St Kitts-Nevis">St Kitts-Nevis</option>
      <option value="St Lucia">St Lucia</option>
      <option value="St Maarten">St Maarten</option>
      <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
      <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
      <option value="Saipan">Saipan</option>
      <option value="Samoa">Samoa</option>
      <option value="Samoa American">Samoa American</option>
      <option value="San Marino">San Marino</option>
      <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
      <option value="Saudi Arabia">Saudi Arabia</option>
      <option value="Senegal">Senegal</option>
      <option value="Serbia">Serbia</option>
      <option value="Seychelles">Seychelles</option>
      <option value="Sierra Leone">Sierra Leone</option>
      <option value="Singapore">Singapore</option>
      <option value="Slovakia">Slovakia</option>
      <option value="Slovenia">Slovenia</option>
      <option value="Solomon Islands">Solomon Islands</option>
      <option value="Somalia">Somalia</option>
      <option value="South Africa">South Africa</option>
      <option value="Spain">Spain</option>
      <option value="Sri Lanka">Sri Lanka</option>
      <option value="Sudan">Sudan</option>
      <option value="Suriname">Suriname</option>
      <option value="Swaziland">Swaziland</option>
      <option value="Sweden">Sweden</option>
      <option value="Switzerland">Switzerland</option>
      <option value="Syria">Syria</option>
      <option value="Tahiti">Tahiti</option>
      <option value="Taiwan">Taiwan</option>
      <option value="Tajikistan">Tajikistan</option>
      <option value="Tanzania">Tanzania</option>
      <option value="Thailand">Thailand</option>
      <option value="Togo">Togo</option>
      <option value="Tokelau">Tokelau</option>
      <option value="Tonga">Tonga</option>
      <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
      <option value="Tunisia">Tunisia</option>
      <option value="Turkey">Turkey</option>
      <option value="Turkmenistan">Turkmenistan</option>
      <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
      <option value="Tuvalu">Tuvalu</option>
      <option value="Uganda">Uganda</option>
      <option value="Ukraine">Ukraine</option>
      <option value="United Arab Erimates">United Arab Emirates</option>
      <option value="United Kingdom">United Kingdom</option>
      <option value="United States of America">United States of America</option>
      <option value="Uraguay">Uruguay</option>
      <option value="Uzbekistan">Uzbekistan</option>
      <option value="Vanuatu">Vanuatu</option>
      <option value="Vatican City State">Vatican City State</option>
      <option value="Venezuela">Venezuela</option>
      <option value="Vietnam">Vietnam</option>
      <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
      <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
      <option value="Wake Island">Wake Island</option>
      <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
      <option value="Yemen">Yemen</option>
      <option value="Zaire">Zaire</option>
      <option value="Zambia">Zambia</option>
      <option value="Zimbabwe">Zimbabwe</option>
    </select>
  </div>

    <div class="passportnumber">
      <label>Passport Number</label>
        <input type="text" name="passportno" maxlength="15" pattern=".{4,15}" placeholder="Passport Number" required/>
    </div>

    <div>
      <div class="phonegender">
        <label>Phone Number</label>
          <input type="tel" name="phoneno" maxlength="10" pattern=".{10,10}" placeholder="Phone Number" required/>
      </div>

      <div class="phonegender">
        <label>Gender</label>
          <select name="gender" required>
            <option disabled="disabled" selected="selected" value="">Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
      </div>
    </div>

    <div class="dateofbirth">
      <label>Date of Birth</label>
      <input type="date" name="dob" required/>
    </div>

  <h2>Delivery Address</h2>

  <div class="countryresidence">
  <label>Country of Residence</label>
  <select name="countryres" required>
    <option value="" disabled="disabled" selected="selected">Select Country</option>
    <option value="Afganistan">Afghanistan</option>
    <option value="Albania">Albania</option>
    <option value="Algeria">Algeria</option>
    <option value="American Samoa">American Samoa</option>
    <option value="Andorra">Andorra</option>
    <option value="Angola">Angola</option>
    <option value="Anguilla">Anguilla</option>
    <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
    <option value="Argentina">Argentina</option>
    <option value="Armenia">Armenia</option>
    <option value="Aruba">Aruba</option>
    <option value="Australia">Australia</option>
    <option value="Austria">Austria</option>
    <option value="Azerbaijan">Azerbaijan</option>
    <option value="Bahamas">Bahamas</option>
    <option value="Bahrain">Bahrain</option>
    <option value="Bangladesh">Bangladesh</option>
    <option value="Barbados">Barbados</option>
    <option value="Belarus">Belarus</option>
    <option value="Belgium">Belgium</option>
    <option value="Belize">Belize</option>
    <option value="Benin">Benin</option>
    <option value="Bermuda">Bermuda</option>
    <option value="Bhutan">Bhutan</option>
    <option value="Bolivia">Bolivia</option>
    <option value="Bonaire">Bonaire</option>
    <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
    <option value="Botswana">Botswana</option>
    <option value="Brazil">Brazil</option>
    <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
    <option value="Brunei">Brunei</option>
    <option value="Bulgaria">Bulgaria</option>
    <option value="Burkina Faso">Burkina Faso</option>
    <option value="Burundi">Burundi</option>
    <option value="Cambodia">Cambodia</option>
    <option value="Cameroon">Cameroon</option>
    <option value="Canada">Canada</option>
    <option value="Canary Islands">Canary Islands</option>
    <option value="Cape Verde">Cape Verde</option>
    <option value="Cayman Islands">Cayman Islands</option>
    <option value="Central African Republic">Central African Republic</option>
    <option value="Chad">Chad</option>
    <option value="Channel Islands">Channel Islands</option>
    <option value="Chile">Chile</option>
    <option value="China">China</option>
    <option value="Christmas Island">Christmas Island</option>
    <option value="Cocos Island">Cocos Island</option>
    <option value="Colombia">Colombia</option>
    <option value="Comoros">Comoros</option>
    <option value="Congo">Congo</option>
    <option value="Cook Islands">Cook Islands</option>
    <option value="Costa Rica">Costa Rica</option>
    <option value="Cote DIvoire">Cote D'Ivoire</option>
    <option value="Croatia">Croatia</option>
    <option value="Cuba">Cuba</option>
    <option value="Curaco">Curacao</option>
    <option value="Cyprus">Cyprus</option>
    <option value="Czech Republic">Czech Republic</option>
    <option value="Denmark">Denmark</option>
    <option value="Djibouti">Djibouti</option>
    <option value="Dominica">Dominica</option>
    <option value="Dominican Republic">Dominican Republic</option>
    <option value="East Timor">East Timor</option>
    <option value="Ecuador">Ecuador</option>
    <option value="Egypt">Egypt</option>
    <option value="El Salvador">El Salvador</option>
    <option value="Equatorial Guinea">Equatorial Guinea</option>
    <option value="Eritrea">Eritrea</option>
    <option value="Estonia">Estonia</option>
    <option value="Ethiopia">Ethiopia</option>
    <option value="Falkland Islands">Falkland Islands</option>
    <option value="Faroe Islands">Faroe Islands</option>
    <option value="Fiji">Fiji</option>
    <option value="Finland">Finland</option>
    <option value="France">France</option>
    <option value="French Guiana">French Guiana</option>
    <option value="French Polynesia">French Polynesia</option>
    <option value="French Southern Ter">French Southern Ter</option>
    <option value="Gabon">Gabon</option>
    <option value="Gambia">Gambia</option>
    <option value="Georgia">Georgia</option>
    <option value="Germany">Germany</option>
    <option value="Ghana">Ghana</option>
    <option value="Gibraltar">Gibraltar</option>
    <option value="Great Britain">Great Britain</option>
    <option value="Greece">Greece</option>
    <option value="Greenland">Greenland</option>
    <option value="Grenada">Grenada</option>
    <option value="Guadeloupe">Guadeloupe</option>
    <option value="Guam">Guam</option>
    <option value="Guatemala">Guatemala</option>
    <option value="Guinea">Guinea</option>
    <option value="Guyana">Guyana</option>
    <option value="Haiti">Haiti</option>
    <option value="Hawaii">Hawaii</option>
    <option value="Honduras">Honduras</option>
    <option value="Hong Kong">Hong Kong</option>
    <option value="Hungary">Hungary</option>
    <option value="Iceland">Iceland</option>
    <option value="India">India</option>
    <option value="Indonesia">Indonesia</option>
    <option value="Iran">Iran</option>
    <option value="Iraq">Iraq</option>
    <option value="Ireland">Ireland</option>
    <option value="Isle of Man">Isle of Man</option>
    <option value="Israel">Israel</option>
    <option value="Italy">Italy</option>
    <option value="Jamaica">Jamaica</option>
    <option value="Japan">Japan</option>
    <option value="Jordan">Jordan</option>
    <option value="Kazakhstan">Kazakhstan</option>
    <option value="Kenya">Kenya</option>
    <option value="Kiribati">Kiribati</option>
    <option value="Korea North">Korea North</option>
    <option value="Korea Sout">Korea South</option>
    <option value="Kuwait">Kuwait</option>
    <option value="Kyrgyzstan">Kyrgyzstan</option>
    <option value="Laos">Laos</option>
    <option value="Latvia">Latvia</option>
    <option value="Lebanon">Lebanon</option>
    <option value="Lesotho">Lesotho</option>
    <option value="Liberia">Liberia</option>
    <option value="Libya">Libya</option>
    <option value="Liechtenstein">Liechtenstein</option>
    <option value="Lithuania">Lithuania</option>
    <option value="Luxembourg">Luxembourg</option>
    <option value="Macau">Macau</option>
    <option value="Macedonia">Macedonia</option>
    <option value="Madagascar">Madagascar</option>
    <option value="Malaysia">Malaysia</option>
    <option value="Malawi">Malawi</option>
    <option value="Maldives">Maldives</option>
    <option value="Mali">Mali</option>
    <option value="Malta">Malta</option>
    <option value="Marshall Islands">Marshall Islands</option>
    <option value="Martinique">Martinique</option>
    <option value="Mauritania">Mauritania</option>
    <option value="Mauritius">Mauritius</option>
    <option value="Mayotte">Mayotte</option>
    <option value="Mexico">Mexico</option>
    <option value="Midway Islands">Midway Islands</option>
    <option value="Moldova">Moldova</option>
    <option value="Monaco">Monaco</option>
    <option value="Mongolia">Mongolia</option>
    <option value="Montserrat">Montserrat</option>
    <option value="Morocco">Morocco</option>
    <option value="Mozambique">Mozambique</option>
    <option value="Myanmar">Myanmar</option>
    <option value="Nambia">Nambia</option>
    <option value="Nauru">Nauru</option>
    <option value="Nepal">Nepal</option>
    <option value="Netherland Antilles">Netherland Antilles</option>
    <option value="Netherlands">Netherlands (Holland, Europe)</option>
    <option value="Nevis">Nevis</option>
    <option value="New Caledonia">New Caledonia</option>
    <option value="New Zealand">New Zealand</option>
    <option value="Nicaragua">Nicaragua</option>
    <option value="Niger">Niger</option>
    <option value="Nigeria">Nigeria</option>
    <option value="Niue">Niue</option>
    <option value="Norfolk Island">Norfolk Island</option>
    <option value="Norway">Norway</option>
    <option value="Oman">Oman</option>
    <option value="Pakistan">Pakistan</option>
    <option value="Palau Island">Palau Island</option>
    <option value="Palestine">Palestine</option>
    <option value="Panama">Panama</option>
    <option value="Papua New Guinea">Papua New Guinea</option>
    <option value="Paraguay">Paraguay</option>
    <option value="Peru">Peru</option>
    <option value="Phillipines">Philippines</option>
    <option value="Pitcairn Island">Pitcairn Island</option>
    <option value="Poland">Poland</option>
    <option value="Portugal">Portugal</option>
    <option value="Puerto Rico">Puerto Rico</option>
    <option value="Qatar">Qatar</option>
    <option value="Republic of Montenegro">Republic of Montenegro</option>
    <option value="Republic of Serbia">Republic of Serbia</option>
    <option value="Reunion">Reunion</option>
    <option value="Romania">Romania</option>
    <option value="Russia">Russia</option>
    <option value="Rwanda">Rwanda</option>
    <option value="St Barthelemy">St Barthelemy</option>
    <option value="St Eustatius">St Eustatius</option>
    <option value="St Helena">St Helena</option>
    <option value="St Kitts-Nevis">St Kitts-Nevis</option>
    <option value="St Lucia">St Lucia</option>
    <option value="St Maarten">St Maarten</option>
    <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
    <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
    <option value="Saipan">Saipan</option>
    <option value="Samoa">Samoa</option>
    <option value="Samoa American">Samoa American</option>
    <option value="San Marino">San Marino</option>
    <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
    <option value="Saudi Arabia">Saudi Arabia</option>
    <option value="Senegal">Senegal</option>
    <option value="Serbia">Serbia</option>
    <option value="Seychelles">Seychelles</option>
    <option value="Sierra Leone">Sierra Leone</option>
    <option value="Singapore">Singapore</option>
    <option value="Slovakia">Slovakia</option>
    <option value="Slovenia">Slovenia</option>
    <option value="Solomon Islands">Solomon Islands</option>
    <option value="Somalia">Somalia</option>
    <option value="South Africa">South Africa</option>
    <option value="Spain">Spain</option>
    <option value="Sri Lanka">Sri Lanka</option>
    <option value="Sudan">Sudan</option>
    <option value="Suriname">Suriname</option>
    <option value="Swaziland">Swaziland</option>
    <option value="Sweden">Sweden</option>
    <option value="Switzerland">Switzerland</option>
    <option value="Syria">Syria</option>
    <option value="Tahiti">Tahiti</option>
    <option value="Taiwan">Taiwan</option>
    <option value="Tajikistan">Tajikistan</option>
    <option value="Tanzania">Tanzania</option>
    <option value="Thailand">Thailand</option>
    <option value="Togo">Togo</option>
    <option value="Tokelau">Tokelau</option>
    <option value="Tonga">Tonga</option>
    <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
    <option value="Tunisia">Tunisia</option>
    <option value="Turkey">Turkey</option>
    <option value="Turkmenistan">Turkmenistan</option>
    <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
    <option value="Tuvalu">Tuvalu</option>
    <option value="Uganda">Uganda</option>
    <option value="Ukraine">Ukraine</option>
    <option value="United Arab Erimates">United Arab Emirates</option>
    <option value="United Kingdom">United Kingdom</option>
    <option value="United States of America">United States of America</option>
    <option value="Uraguay">Uruguay</option>
    <option value="Uzbekistan">Uzbekistan</option>
    <option value="Vanuatu">Vanuatu</option>
    <option value="Vatican City State">Vatican City State</option>
    <option value="Venezuela">Venezuela</option>
    <option value="Vietnam">Vietnam</option>
    <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
    <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
    <option value="Wake Island">Wake Island</option>
    <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
    <option value="Yemen">Yemen</option>
    <option value="Zaire">Zaire</option>
    <option value="Zambia">Zambia</option>
    <option value="Zimbabwe">Zimbabwe</option>
  </select>
</div>

<div class="province">
  <label>Province</label>
  <input type="text" name="province" placeholder="Province" maxlength="30" required/>
</div>

<div class="city">
  <label>City</label>
  <input type="text" name="city" placeholder="City" maxlength="30" required/>
</div>

<div class="addressline1">
  <label>Address Line 1</label>
  <input type="text" name="addresslineone" placeholder="Address Line 1" maxlength="50" required/>
</div>

<div class="addressline2">
  <label>Address Line 2 (Optional)</label>
  <input type="text" name="addresslinetwo" maxlength="50" placeholder="Address Line 2"/>
</div>

<div class="zipcode">
  <label>Zipcode</label>
  <input type="text" name="zipcode" maxlength="10" placeholder="Zipcode" required/>
</div>

<div class="checkboxes">
  <input type="checkbox" name="agree" required><p>I agree to the <a style="color:inherit; text-decoration:none; " href="termsandconditions.php"> terms and conditions</a></p>
</div>

<div class="signupbutton">
    <button type="submit" onclick="return validate()" name="submit">Sign Up</button>
</div>

</form>

</div>


<!-- Javascript Validation -->
<script type="text/javascript">

function showPassword() {
    var x = document.getElementById("thepassword");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}

function showRepeatPassword() {
    var y = document.getElementById("repeatpassword");
    if (y.type === "password") {
        y.type = "text";
    } else {
        y.type = "password";
    }
}

function validate() { //Edit later.
  //Gathers Variables from Signup Form
var firstn = document.forms["signupform"]["firstname"].value;
var lastn = document.forms["signupform"]["lastname"].value;
var emailad = document.forms["signupform"]["email"].value;
var uname = document.forms["signupform"]["username"].value;
var upass = document.forms["signupform"]["password"].value;
var usecpass = document.forms["signupform"]["secpassword"].value;
var passportnum = document.forms["signupform"]["passportno"].value;
var phonenum = document.forms["signupform"]["phoneno"].value;
var userdob = document.forms["signupform"]["dob"].value;
var uprovince = document.forms["signupform"]["province"].value;
var ucity = document.forms["signupform"]["city"].value;
var uaddresslineone = document.forms["signupform"]["addresslineone"].value;
var uzipcode = document.forms["signupform"]["zipcode"].value;

//First and Last name Validation
if (firstn == "" || lastn == "") {
    alert("Please fill in both name fields");
      return false;
  }
  else{
    //New conditions start here
    //Email address validation
    if(emailad == ""){
      alert("Please fill in E-Mail address");
      return false;
    }
    else{
      //Username Validation
      if(uname == ""){
        alert("Please fill in Username field");
        return false;
      }
       else{
      //Password validation
      if(upass == ""){
        alert("Please fill out Password field");
        return false;
      }
       else{
      //Second Password Validation
      if(usecpass == ""){
        alert("Please repeat your password");
        return false;
      }
        else{
        //Checks if First password matches second password
      if(!(upass == usecpass)){
        alert("Passwords do not match");
        return false;
      }
        else{
        //Passport Number Verification
      if(passportnum == ""){
        alert("Please fill out passport number");
        return false;
      }
        else{
        //Nationality Selected Verification
      if(signupform.nationality.selectedIndex == 0){
        alert("Please select your nationality");
        return false;
      }
        else{
        //Phone Number Validation
      if(phonenum == ""){
        alert("Please enter phone number");
        return false;
      }
        else{
        //Gender Check
        if(signupform.gender.selectedIndex == 0){
          alert("Please select your gender");
          return false;
      }
        else{
        //DOB Check
        if(!userdob){
          alert("Enter your date of birth");
          return false;
      }
        else{
        //Country of Residence Check
        if(signupform.countryres.selectedIndex == 0){
          alert("Please select your country of residence");
          return false;
      }
        else{
        //Province Check
        if(uprovince == ""){
          alert("Please enter your province");
          return false;
      }
        else{
        //City Check
        if(ucity == ""){
          alert("Please enter your city");
          return false;
      }
        else{
        //Address Line One Check
        if(uaddresslineone == ""){
          alert("Please enter your address line");
          return false;
      }
        else{
        //Zipcode Validation
        if(uzipcode == ""){
          alert("Please enter your zipcode");
          return false;
      }
        else{
        //Numeric Zipcode Validation
        if(isNaN(uzipcode)){
          alert("Enter only numbers for zipcode");
          return false;
      }else{
        return confirm("Sign up?");
      }
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
}
  //End of Function
}


</script>

<?php include 'footer.php'; ?>
