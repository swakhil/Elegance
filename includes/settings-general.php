<?php
   include_once '../functions/functions.php';
   include_once '../ajax/settings.func.php';

   $msg == '';
   if (isset($_GET['ml']) && crypt_data($_GET['ml'], 'd') == '1') {
       $msg = "<div class='alert alert-success' role='alert'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Success! Your email has been updated!</div>";
   }
?>

                           <form method="POST" id="general-form">

                                    <p><?php echo $msg; ?></p>

                                    <div class="col-sm-10 col-sm-offset-1">

                                             <label class="control-label">FirstName </label>

                                             <input name="firstname" value='<?php echo isset($firstname)? $firstname:''; ?>' type="text" class="form-control" id="settings-input">

                                       <br/>

                                             <label class="control-label">LastName </label>

                                             <input name="lastname" type="text" value='<?php echo isset($lastname)? $lastname:''; ?>' class="form-control" id="settings-input">

                                       <br/>

                                       <label class="control-label">Username </label>

                                             <input name="username" type="text" value='<?php echo isset($username)? $username:''; ?>' class="form-control" id="settings-input">
                                             
                                           <br/>

                                    

                                         <label class="control-label">E-mail address </label>

                                             <input name="email" type="email" value='<?php echo isset($email)? $email:''; ?>' class="form-control" id="settings-input">

                                       

                                           <br/>



                                        <label class="control-label">Sex </label>

                                          <select name="sex" class="form-control" id="settings-input">

                                             <?php if (isset($sex)) {
    ?>

                                             <option value="<?php echo $sex; ?>"><?php echo $sex; ?></option>

                                             <?php
} else {
        ?>

                                             <option value="" selected="">Sex</option>

                                             <?php
    }
                                             ?>

                                             <option value="Male"> Male </option>

                                             <option value="Female"> Female </option>

                                          </select>

                                       <br/>



                                       <div class="birthdate">

                                       <label class="control-label">Birthday</label>

                                       <br/>

                                       <input name="birthday" type="text" value='<?php echo isset($birthday)? $birthday:''; ?>' class="form-control" id="settings-input">

                                       </div>

                                       <br/>



                                       <div class="form-group label-floating">

                                          <label class="control-label">Country</label>

                                          <select name="country" class="form-control">

                                             <?php if (isset($country)) {
                                                 ?>

                                             <option value="<?php echo $country; ?>"><?php echo $country; ?></option>

                                             <?php
                                             } else {
                                                 ?>

                                             <option value='' selected="selected"></option>

                                             <?php
                                             }
                                                ?>

                                             <option value="AL">Albania</option>

                                             <option value="DZ">Algeria</option>

                                             <option value="AD">Andorra</option>

                                             <option value="AO">Angola</option>

                                             <option value="AI">Anguilla</option>

                                             <option value="AG">Antigua and Barbuda</option>

                                             <option value="AR">Argentina</option>

                                             <option value="AM">Armenia</option>

                                             <option value="AW">Aruba</option>

                                             <option value="AU">Australia</option>

                                             <option value="AT">Austria</option>

                                             <option value="AZ">Azerbaijan Republic</option>

                                             <option value="BS">Bahamas</option>

                                             <option value="BH">Bahrain</option>

                                             <option value="BD">Bangladesh</option>

                                             <option value="BB">Barbados</option>

                                             <option value="BE">Belgium</option>

                                             <option value="BZ">Belize</option>

                                             <option value="BJ">Benin</option>

                                             <option value="BM">Bermuda</option>

                                             <option value="BT">Bhutan</option>

                                             <option value="BO">Bolivia</option>

                                             <option value="BA">Bosnia and Herzegovina</option>

                                             <option value="BW">Botswana</option>

                                             <option value="BR">Brazil</option>

                                             <option value="BN">Brunei</option>

                                             <option value="BG">Bulgaria</option>

                                             <option value="BF">Burkina Faso</option>

                                             <option value="BI">Burundi</option>

                                             <option value="KH">Cambodia</option>

                                             <option value="CA">Canada</option>

                                             <option value="CV">Cape Verde</option>

                                             <option value="KY">Cayman Islands</option>

                                             <option value="TD">Chad</option>

                                             <option value="CL">Chile</option>

                                             <option value="C2">China Worldwide</option>

                                             <option value="CO">Colombia</option>

                                             <option value="KM">Comoros</option>

                                             <option value="CK">Cook Islands</option>

                                             <option value="CR">Costa Rica</option>

                                             <option value="HR">Croatia</option>

                                             <option value="CY">Cyprus</option>

                                             <option value="CZ">Czech Republic</option>

                                             <option value="CD">Democratic Republic of the Congo</option>

                                             <option value="DK">Denmark</option>

                                             <option value="DJ">Djibouti</option>

                                             <option value="DM">Dominica</option>

                                             <option value="DO">Dominican Republic</option>

                                             <option value="EC">Ecuador</option>

                                             <option value="EG">Egypt</option>

                                             <option value="SV">El Salvador</option>

                                             <option value="ER">Eritrea</option>

                                             <option value="EE">Estonia</option>

                                             <option value="ET">Ethiopia</option>

                                             <option value="FK">Falkland Islands</option>

                                             <option value="FO">Faroe Islands</option>

                                             <option value="FJ">Fiji</option>

                                             <option value="FI">Finland</option>

                                             <option value="FR">France</option>

                                             <option value="GF">French Guiana</option>

                                             <option value="PF">French Polynesia</option>

                                             <option value="GA">Gabon Republic</option>

                                             <option value="GM">Gambia</option>

                                             <option value="GE">Georgia</option>

                                             <option value="DE">Germany</option>

                                             <option value="GI">Gibraltar</option>

                                             <option value="GR">Greece</option>

                                             <option value="GL">Greenland</option>

                                             <option value="GD">Grenada</option>

                                             <option value="GP">Guadeloupe</option>

                                             <option value="GT">Guatemala</option>

                                             <option value="GN">Guinea</option>

                                             <option value="GW">Guinea Bissau</option>

                                             <option value="GY">Guyana</option>

                                             <option value="HT">Haiti</option>

                                             <option value="HN">Honduras</option>

                                             <option value="HK">Hong Kong</option>

                                             <option value="HU">Hungary</option>

                                             <option value="IS">Iceland</option>

                                             <option value="IN">India</option>

                                             <option value="ID">Indonesia</option>

                                             <option value="IE">Ireland</option>

                                             <option value="IL">Israel</option>

                                             <option value="IT">Italy</option>

                                             <option value="JM">Jamaica</option>

                                             <option value="JP">Japan</option>

                                             <option value="JO">Jordan</option>

                                             <option value="KZ">Kazakhstan</option>

                                             <option value="KE">Kenya</option>

                                             <option value="KI">Kiribati</option>

                                             <option value="KW">Kuwait</option>

                                             <option value="KG">Kyrgyzstan</option>

                                             <option value="LA">Laos</option>

                                             <option value="LV">Latvia</option>

                                             <option value="LS">Lesotho</option>

                                             <option value="LI">Liechtenstein</option>

                                             <option value="LT">Lithuania</option>

                                             <option value="LU">Luxembourg</option>

                                             <option value="MG">Madagascar</option>

                                             <option value="MW">Malawi</option>

                                             <option value="MY">Malaysia</option>

                                             <option value="MV">Maldives</option>

                                             <option value="ML">Mali</option>

                                             <option value="MT">Malta</option>

                                             <option value="MH">Marshall Islands</option>

                                             <option value="MQ">Martinique</option>

                                             <option value="MR">Mauritania</option>

                                             <option value="MU">Mauritius</option>

                                             <option value="YT">Mayotte</option>

                                             <option value="MX">Mexico</option>

                                             <option value="FM">Micronesia</option>

                                             <option value="MN">Mongolia</option>

                                             <option value="MS">Montserrat</option>

                                             <option value="MA">Morocco</option>

                                             <option value="MZ">Mozambique</option>

                                             <option value="NA">Namibia</option>

                                             <option value="NR">Nauru</option>

                                             <option value="NP">Nepal</option>

                                             <option value="NL">Netherlands</option>

                                             <option value="AN">Netherlands Antilles</option>

                                             <option value="NC">New Caledonia</option>

                                             <option value="NZ">New Zealand</option>

                                             <option value="NI">Nicaragua</option>

                                             <option value="NE">Niger</option>

                                             <option value="NU">Niue</option>

                                             <option value="NF">Norfolk Island</option>

                                             <option value="NO">Norway</option>

                                             <option value="OM">Oman</option>

                                             <option value="PW">Palau</option>

                                             <option value="PA">Panama</option>

                                             <option value="PG">Papua New Guinea</option>

                                             <option value="PE">Peru</option>

                                             <option value="PH">Philippines</option>

                                             <option value="PN">Pitcairn Islands</option>

                                             <option value="PL">Poland</option>

                                             <option value="PT">Portugal</option>

                                             <option value="QA">Qatar</option>

                                             <option value="CG">Republic of the Congo</option>

                                             <option value="RE">Reunion</option>

                                             <option value="RO">Romania</option>

                                             <option value="RU">Russia</option>

                                             <option value="RW">Rwanda</option>

                                             <option value="KN">Saint Kitts and Nevis Anguilla</option>

                                             <option value="PM">Saint Pierre and Miquelon</option>

                                             <option value="VC">Saint Vincent and Grenadines</option>

                                             <option value="WS">Samoa</option>

                                             <option value="SM">San Marino</option>

                                             <option value="ST">São Tomé and Príncipe</option>

                                             <option value="SA">Saudi Arabia</option>

                                             <option value="SN">Senegal</option>

                                             <option value="RS">Serbia</option>

                                             <option value="SC">Seychelles</option>

                                             <option value="SL">Sierra Leone</option>

                                             <option value="SG">Singapore</option>

                                             <option value="SK">Slovakia</option>

                                             <option value="SI">Slovenia</option>

                                             <option value="SB">Solomon Islands</option>

                                             <option value="SO">Somalia</option>

                                             <option value="ZA">South Africa</option>

                                             <option value="KR">South Korea</option>

                                             <option value="ES">Spain</option>

                                             <option value="LK">Sri Lanka</option>

                                             <option value="SH">St. Helena</option>

                                             <option value="LC">St. Lucia</option>

                                             <option value="SR">Suriname</option>

                                             <option value="SJ">Svalbard and Jan Mayen Islands</option>

                                             <option value="SZ">Swaziland</option>

                                             <option value="SE">Sweden</option>

                                             <option value="CH">Switzerland</option>

                                             <option value="TW">Taiwan</option>

                                             <option value="TJ">Tajikistan</option>

                                             <option value="TZ">Tanzania</option>

                                             <option value="TH">Thailand</option>

                                             <option value="TG">Togo</option>

                                             <option value="TO">Tonga</option>

                                             <option value="TT">Trinidad and Tobago</option>

                                             <option value="TN">Tunisia</option>

                                             <option value="TR">Turkey</option>

                                             <option value="TM">Turkmenistan</option>

                                             <option value="TC">Turks and Caicos Islands</option>

                                             <option value="TV">Tuvalu</option>

                                             <option value="UG">Uganda</option>

                                             <option value="UA">Ukraine</option>

                                             <option value="AE">United Arab Emirates</option>

                                             <option value="GB">United Kingdom</option>

                                             <option value="US">United States</option>

                                             <option value="UY">Uruguay</option>

                                             <option value="VU">Vanuatu</option>

                                             <option value="VA">Vatican City State</option>

                                             <option value="VE">Venezuela</option>

                                             <option value="VN">Vietnam</option>

                                             <option value="VG">Virgin Islands (British)</option>

                                             <option value="WF">Wallis and Futuna Islands</option>

                                             <option value="YE">Yemen</option>

                                             <option value="ZM">Zambia</option>

                                          </select>

                                       </div>

                                       <label class="control-label">About me </label>

                                             <textarea name="about" class="form-control no-resize" id="settings-input"><?php echo isset($about)? $about:''; ?></textarea>

                                       

                                           <br/>

                                       <div class="pull-right" style="margin-top: 15px;">

                                        <input type='button' class='btn btn-finish btn-fill btn-success btn-wd' name='update_general' id="update_general" value='Update' />

                                     </div>



                                    </div>

                                  </form>