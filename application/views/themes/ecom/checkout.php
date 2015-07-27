<? if(!$user) echo "<script>window.location='".site_url."/login/'</script>"; ?>

<div style="padding-left:25px;">
  <div id="">
    <p class="p-class-1" />
    <span id="">
    <table id="" class="tblCheckoutProcess">
      <tr id="">
        <td id=""><a id="" class="complete" href="#">Shopping Cart</a></td>
        <td id=""><img id="" src="<?=temp_path?>/img/Arrow.jpg" alt=" > " /></td>
        <td id=""><a id="" class="complete" href="#">Log In</a></td>
        <td id=""><img id="" src="<?=temp_path?>/img/Arrow.jpg" alt=" > " /></td>
        <td id=""><a id="" class="current">Shipping</a></td>
        <td id=""><img id="" src="<?=temp_path?>/img/Arrow.jpg" alt=" > " /></td>
        <td id=""><a id="" class="notVisited">Billing</a></td>
        <td id=""><img id="" src="<?=temp_path?>/img/Arrow.jpg" alt=" > " /></td>
       <td id=""><a id="" class="notVisited">Submitted Order</a></td>
      </tr>
    </table>
    </span> <br />
    <div id="">
      <div>
        <div > <br />
          <span id="" class="categoryHeading">Customer Number</span> <span id=""><?=$user->uniqueId;?></span> <br />
          <br />
        </div>
		<form action="" id="form_inline" method="post">
        <table width="35%" id="">
          <tr id="">
            <td id=""><span id="" class="categoryHeading">Order Type *</span></td>
            <td id=""><table id="">
                <tr>
                  <td><input id="" type="radio" name="orderType" value="Company" checked="checked" /></td>
                  <td width="5">&nbsp;</td>
                  <td><label>Company</label></td>
                  <td width="15">&nbsp;</td>
                  <td><input id="" type="radio" name="orderType" value="Personal" onClick="" /></td>
                  <td width="5">&nbsp;</td>
                  <td><label>Personal</label></td>
                </tr>
              </table></td>
            <td id=""><span id="" style="color:Red;visibility:hidden;">&nbsp;*</span></td>
          </tr>
        </table>
        <br />
      
        <br />
<? $naam = explode(' ',$user->name); ?>      
        <table id="" class="tblborder" cellspacing="0" cellpadding="3" style="border-width:2px;border-style:solid;border-collapse:collapse;">
          <tr class="tblhead" align="center">
            <th colspan="3">Shipping Address</th>
          </tr>
          <tr style="border-width:1px;border-style:solid;">
            <td style="border-width:1px;border-style:solid;font-weight:bold;white-space:nowrap;">Country</td>
            <td style="border-width:1px;border-style:solid;border-left:0px;border-right:0px;">
			<select name="country" style="width:278px;">
                <option value="00">USA</option>
                <option value="05">CANADA</option>
                <option value="0A">AFGHANISTAN</option>
                <option value="0C">ALAND ISLANDS</option>
                <option value="0F">ALBANIA</option>
                <option value="0K">ALGERIA</option>
                <option value="0P">AMERICAN SAMOA</option>
                <option value="0U">ANDORRA</option>
                <option value="0Z">ANGOLA</option>
                <option value="14">ANGUILLA</option>
                <option value="19">ANTARCTICA</option>
                <option value="1E">ANTIGUA AND BARBUDA</option>
                <option value="1J">ARGENTINA</option>
                <option value="1O">ARMENIA</option>
                <option value="1T">ARUBA</option>
                <option value="1Y">AUSTRALIA</option>
                <option value="23">AUSTRIA</option>
                <option value="28">AZERBAIJAN</option>
                <option value="2D">BAHAMAS</option>
                <option value="2I">BAHRAIN</option>
                <option value="2N">BANGLADESH</option>
                <option value="2S">BARBADOS</option>
                <option value="32">BELARUS</option>
                <option value="37">BELGIUM</option>
                <option value="3C">BELIZE</option>
                <option value="3H">BENIN</option>
                <option value="3M">BERMUDA</option>
                <option value="3R">BHUTAN</option>
                <option value="3W">BOLIVIA</option>
                <option value="41">BOSNIA AND HERZEGOVINA</option>
                <option value="46">BOTSWANA</option>
                <option value="4B">BOUVET ISLAND</option>
                <option value="4G">BRAZIL</option>
                <option value="4L">BRITISH INDIAN OCEAN TERRITORY</option>
                <option value="4Q">BRUNEI DARUSSALAM</option>
                <option value="4V">BULGARIA</option>
                <option value="50">BURKINA FASO</option>
                <option value="55">BURUNDI</option>
                <option value="5A">CAMBODIA</option>
                <option value="5F">CAMEROON</option>
                <option value="5K">CAPE VERDE</option>
                <option value="5P">CAYMAN ISLANDS</option>
                <option value="5U">CENTRAL AFRICAN REPUBLIC</option>
                <option value="5Z">CHAD</option>
                <option value="64">CHILE</option>
                <option value="69">CHINA</option>
                <option value="6E">CHRISTMAS ISLAND</option>
                <option value="6J">COCOS (KEELING) ISLANDS</option>
                <option value="6O">COLOMBIA</option>
                <option value="6T">COMOROS</option>
                <option value="6Y">CONGO (REPUBLIC OF THE)</option>
                <option value="73">CONGO (DEMOCRATIC REPUBLIC OF)</option>
                <option value="78">COOK ISLANDS</option>
                <option value="7D">COSTA RICA</option>
                <option value="7I">COTE D&#39;IVOIRE</option>
                <option value="7N">CROATIA</option>
                <option value="7U">CURACAO</option>
                <option value="7X">CYPRUS</option>
                <option value="82">CZECH REPUBLIC</option>
                <option value="87">DENMARK</option>
                <option value="8C">DJIBOUTI</option>
                <option value="8H">DOMINICA</option>
                <option value="8M">DOMINICAN REPUBLIC</option>
                <option value="8W">ECUADOR</option>
                <option value="91">EGYPT</option>
                <option value="96">EL SALVADOR</option>
                <option value="9B">EQUATORIAL GUINEA</option>
                <option value="9G">ERITREA</option>
                <option value="9L">ESTONIA</option>
                <option value="9Q">ETHIOPIA</option>
                <option value="9V">FALKLAND ISLANDS (MALVINAS)</option>
                <option value="A0">FAROE ISLANDS</option>
                <option value="A5">FIJI</option>
                <option value="AA">FINLAND</option>
                <option value="AF">FRANCE</option>
                <option value="AK">FRENCH GUIANA</option>
                <option value="AP">FRENCH POLYNESIA</option>
                <option value="AU">FRENCH SOUTHERN TERRITORIES</option>
                <option value="AZ">GABON</option>
                <option value="B4">GAMBIA</option>
                <option value="B9">GEORGIA</option>
                <option value="BE">GERMANY</option>
                <option value="BJ">GHANA</option>
                <option value="BO">GIBRALTAR</option>
                <option value="BT">GREECE</option>
                <option value="BY">GREENLAND</option>
                <option value="C3">GRENADA</option>
                <option value="C8">GUADALOUPE</option>
                <option value="CD">GUAM</option>
                <option value="CI">GUATEMALA</option>
                <option value="CN">GUINEA</option>
                <option value="CS">GUINEA-BISSAU</option>
                <option value="CX">GUYANA</option>
                <option value="D2">HAITI</option>
                <option value="D7">HEARD ISLAND &amp; MCDONALD ISLAND</option>
                <option value="DC">HOLY SEE (VATICAN CITY STATE)</option>
                <option value="DH">HONDURAS</option>
                <option value="DM">HONG KONG</option>
                <option value="DR">HUNGARY</option>
                <option value="DW">ICELAND</option>
                <option selected="selected" value="E1">INDIA</option>
                <option value="E6">INDONESIA</option>
                <option value="EG">IRAQ</option>
                <option value="EL">IRELAND</option>
                <option value="EQ">ISRAEL</option>
                <option value="EV">ITALY</option>
                <option value="F0">JAMAICA</option>
                <option value="F5">JAPAN</option>
                <option value="FA">JORDAN</option>
                <option value="FF">KAZAKHSTAN</option>
                <option value="FK">KENYA</option>
                <option value="FP">KIRIBATI</option>
                <option value="FU">KUWAIT</option>
                <option value="FZ">KYRGYZSTAN</option>
                <option value="G4">LAOS</option>
                <option value="G9">LATVIA</option>
                <option value="GE">LEBANON</option>
                <option value="GJ">LESOTHO</option>
                <option value="GO">LIBERIA</option>
                <option value="GT">LIBYA</option>
                <option value="GY">LIECHTENSTEIN</option>
                <option value="H3">LITHUANIA</option>
                <option value="H8">LUXEMBOURG</option>
                <option value="HD">MACAU</option>
                <option value="HI">MACEDONIA</option>
                <option value="HN">MADAGASCAR</option>
                <option value="HS">MALAWI</option>
                <option value="HX">MALAYSIA</option>
                <option value="I2">MALDIVES</option>
                <option value="I7">MALI</option>
                <option value="IC">MALTA</option>
                <option value="IH">MARSHALL ISLANDS</option>
                <option value="IM">MARTINIQUE</option>
                <option value="IR">MAURITANIA</option>
                <option value="IW">MAURITIUS</option>
                <option value="J1">MAYOTTE</option>
                <option value="J6">MEXICO</option>
                <option value="JB">MICRONESIA</option>
                <option value="JG">MOLDOVA</option>
                <option value="JL">MONACO</option>
                <option value="JQ">MONGOLIA</option>
                <option value="JV">MONTSERRAT</option>
                <option value="JX">MONTENEGRO</option>
                <option value="K0">MOROCCO</option>
                <option value="K5">MOZAMBIQUE</option>
                <option value="KA">MYANMAR</option>
                <option value="KF">NAMIBIA</option>
                <option value="KK">NAURU</option>
                <option value="KP">NEPAL</option>
                <option value="KU">NETHERLANDS</option>
                <option value="KZ">NETHERLANDS ANTILLES</option>
                <option value="L4">NEW CALEDONIA</option>
                <option value="L9">NEW ZEALAND</option>
                <option value="LE">NICARAGUA</option>
                <option value="LJ">NIGER</option>
                <option value="LO">NIGERIA</option>
                <option value="LT">NIUE</option>
                <option value="LY">NORFOLK ISLAND</option>
                <option value="M8">NORTHERN MARIANA ISLANDS</option>
                <option value="MD">NORWAY</option>
                <option value="MI">OMAN</option>
                <option value="MN">PAKISTAN</option>
                <option value="MS">PALAU</option>
                <option value="MX">PALESTINIAN TERRITORY</option>
                <option value="N2">PANAMA</option>
                <option value="N7">PAPUA NEW GUINEA</option>
                <option value="NC">PARAGUAY</option>
                <option value="NH">PERU</option>
                <option value="NM">PHILIPPINES</option>
                <option value="NR">PITCAIRN</option>
                <option value="NW">POLAND</option>
                <option value="O1">PORTUGAL</option>
                <option value="O6">PUERTO RICO</option>
                <option value="OB">QATAR</option>
                <option value="OG">REUNION</option>
                <option value="OL">ROMANIA</option>
                <option value="OQ">RUSSIA</option>
                <option value="OV">RWANDA</option>
                <option value="P0">S GEORGIA &amp; S SANDWICH ISLANDS</option>
                <option value="P5">SAINT HELENA</option>
                <option value="PA">SAINT KITTS AND NEVIS</option>
                <option value="PF">SAINT LUCIA</option>
                <option value="PK">SAINT PIERRE AND MIQUELON</option>
                <option value="PP">SAMOA</option>
                <option value="PU">SAN MARINO</option>
                <option value="PZ">SAO TOME AND PRINCIPE</option>
                <option value="Q4">SAUDI ARABIA</option>
                <option value="Q9">SENEGAL</option>
                <option value="QA">SERBIA</option>
                <option value="QE">SEYCHELLES</option>
                <option value="QJ">SIERRA LEONE</option>
                <option value="QO">SINGAPORE</option>
                <option value="QQ">SINT MAARTEN (DUTCH PART)</option>
                <option value="QT">SLOVAKIA</option>
                <option value="QY">SLOVENIA</option>
                <option value="R3">SOLOMON ISLANDS</option>
                <option value="R8">SOMALIA</option>
                <option value="RD">SOUTH AFRICA</option>
                <option value="RI">SOUTH KOREA</option>
                <option value="RN">SPAIN</option>
                <option value="RS">SRI LANKA</option>
                <option value="RX">ST VINCENT AND THE GRENADINES</option>
                <option value="S7">SURINAME</option>
                <option value="SC">SVALBARD AND JAN MAYEN</option>
                <option value="SH">SWAZILAND</option>
                <option value="SM">SWEDEN</option>
                <option value="SR">SWITZERLAND</option>
                <option value="T1">TAIWAN</option>
                <option value="T6">TAJIKISTAN</option>
                <option value="TB">TANZANIA</option>
                <option value="TG">THAILAND</option>
                <option value="TI">TIMOR-LESTE</option>
                <option value="TL">TOGO</option>
                <option value="TQ">TOKELAU</option>
                <option value="TV">TONGA</option>
                <option value="U0">TRINIDAD AND TOBAGO</option>
                <option value="U5">TUNISIA</option>
                <option value="UA">TURKEY</option>
                <option value="UF">TURKMENISTAN</option>
                <option value="UK">TURKS AND CAICOS ISLANDS</option>
                <option value="UP">TUVALU</option>
                <option value="UU">UGANDA</option>
                <option value="UZ">UKRAINE</option>
                <option value="V4">UNITED ARAB EMIRATES</option>
                <option value="V9">UNITED KINGDOM</option>
                <option value="VE">URUGUAY</option>
                <option value="VJ">US MINOR OUTLYING ISLANDS</option>
                <option value="VO">UZBEKISTAN</option>
                <option value="VT">VANUATU</option>
                <option value="VY">VENEZUELA</option>
                <option value="W3">VIETNAM</option>
                <option value="W8">VIRGIN ISLANDS, BRITISH</option>
                <option value="WD">VIRGIN ISLANDS, U.S.</option>
                <option value="WI">WALLIS AND FUTUNA</option>
                <option value="WN">WESTERN SAHARA</option>
                <option value="WS">YEMEN</option>
                <option value="X2">ZAMBIA</option>
                <option value="X7">ZIMBABWE</option>
              </select></td>
            <td style="border-width:1px;border-style:solid;border-right:0px;border-left:0px;"></td>
          </tr>
          <tr style="border-width:1px;border-style:solid;">
            <td style="border-width:1px;border-style:solid;font-weight:bold;white-space:nowrap;">First Name *</td>
            <td  style="border-width:1px;border-style:solid;border-left:0px;border-right:0px;">
			<input name="firstname" data-validation="required"
            data-validation-error-msg="Please enter your name" type="text" value="<?=$naam[0];?>" style="width:275px;" /></td>
            <td style="border-width:1px;border-style:solid;border-right:0px;border-left:0px;"></td>
          </tr>
          <tr style="border-width:1px;border-style:solid;">
            <td style="border-width:1px;border-style:solid;font-weight:bold;white-space:nowrap;">Last Name *</td>
            <td style="border-width:1px;border-style:solid;border-left:0px;border-right:0px;">
			<input name="lastname" data-validation="required"
            data-validation-error-msg="Please enter your Last Name" type="text" value="<?=$naam[1];?>" style="width:275px;" /></td>
            <td style="border-width:1px;border-style:solid;border-right:0px;border-left:0px;"></td>
          </tr>
          <tr style="border-width:1px;border-style:solid;">
            <td style="border-width:1px;border-style:solid;font-weight:bold;white-space:nowrap;">Company *</td>
            <td style="border-width:1px;border-style:solid;border-left:0px;border-right:0px;">
			<input name="companyName" data-validation="required"
            data-validation-error-msg="Please enter your Company Name" type="text" value="<?=$user->companyName?>" maxlength="40" id="" style="width:275px;" /></td>
            <td style="border-width:1px;border-style:solid;border-right:0px;border-left:0px;"></td>
          </tr>
          
          <tr style="border-width:1px;border-style:solid;">
            <td style="border-width:1px;border-style:solid;font-weight:bold;white-space:nowrap;">Address Line 1 *</td>
            <td style="border-width:1px;border-style:solid;border-left:0px;border-right:0px;">
			<input name="address1" data-validation="required"
            data-validation-error-msg="Please enter your Address" type="text" value="" maxlength="40" id="" style="width:275px;" /></td>
            <td style="border-width:1px;border-style:solid;border-right:0px;border-left:0px;"></td>
          </tr>
          <tr style="border-width:1px;border-style:solid;">
            <td style="border-width:1px;border-style:solid;font-weight:bold;white-space:nowrap;">Address Line 2</td>
            <td style="border-width:1px;border-style:solid;border-left:0px;border-right:0px;">
			<input name="address2" type="text" maxlength="40" id="" style="width:275px;" /></td>
            <td style="border-width:1px;border-style:solid;border-right:0px;border-left:0px;"></td>
          </tr>
          <tr style="border-width:1px;border-style:solid;">
            <td style="border-width:1px;border-style:solid;font-weight:bold;white-space:nowrap;">City *</td>
            <td style="border-width:1px;border-style:solid;border-left:0px;border-right:0px;">
			<input name="city" data-validation="required"
            data-validation-error-msg="Please enter City" type="text" maxlength="30" style="width:275px;" /></td>
            <td style="border-width:1px;border-style:solid;border-right:0px;border-left:0px;"></td>
          </tr>
          <tr style="border-width:1px;border-style:solid;">
            <td style="border-width:1px;border-style:solid;font-weight:bold;white-space:nowrap;">State</td>
            <td style="border-width:1px;border-style:solid;border-left:0px;border-right:0px;">
			<input name="state" data-validation="required"
            data-validation-error-msg="Please enter State" type="text" maxlength="5" id="" style="width:100px;" /></td>
            <td style="border-width:1px;border-style:solid;border-right:0px;border-left:0px;"></td>
          </tr>
          <tr style="border-width:1px;border-style:solid;">
            <td style="border-width:1px;border-style:solid;font-weight:bold;white-space:nowrap;">Postal Code *</td>
            <td style="border-width:1px;border-style:solid;border-left:0px;border-right:0px;">
			<input name="pincode" data-validation="required"
            data-validation-error-msg="Please enter State" type="text" value="" maxlength="10" style="width:100px;" /></td>
            <td style="border-width:1px;border-style:solid;border-right:0px;border-left:0px;"></td>
          </tr>
        </table>
        <br />
        <br />
        <table cellspacing="0" cellpadding="3" style="border-width:2px;border-style:solid;border-collapse:collapse;">
          <tr class="tblhead">
            <th colspan="2">Contact Information</th>
          </tr>
          <tr style="border-width:1px;border-style:solid;">
            <td style="border-width:1px;border-style:solid;font-weight:bold;white-space:nowrap;">Email *</td>
            <td style="border-width:1px;border-style:solid;">
			<input name="email" data-validation="required"
            data-validation-error-msg="Please enter email" type="text" value="<?=$user->email?>" maxlength="64" style="width:400px;" />
            </td>
          </tr>
          <tr style="border-width:1px;border-style:solid;">
            <td style="border-width:1px;border-style:solid;font-weight:bold;white-space:nowrap;">Website</td>
            <td style="border-width:1px;border-style:solid;">
			<input name="website" data-validation="required"
            data-validation-error-msg="Please enter email"  type="text" maxlength="128" style="width:400px;" /></td>
          </tr>
          <tr style="border-width:1px;border-style:solid;">
            <td style="border-width:1px;border-style:solid;font-weight:bold;white-space:nowrap;">Telephone *</td>
            <td style="border-width:1px;border-style:solid;">
			<input name="mobileNo" data-validation="required"
            data-validation-error-msg="Please enter Telephone No" type="text" maxlength="20" i/>
            </td>
          </tr>
        </table>
		<br />
		<!--<table cellspacing="0" cellpadding="3" style="border-width:2px;border-style:solid;border-collapse:collapse;">
          <tr class="tblhead">
            <th>Payment Mode</th>
          </tr>
          <tr style="border-width:1px;border-style:solid;">
            <td height="50" align="center" style="border-width:1px;border-style:solid;font-weight:bold;white-space:nowrap; width:480px;">
		 <input name="pMode" type="radio" value="paypal" /> &nbsp;&nbsp; Paypal
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="pMode" type="radio" value="CCavenue" /> &nbsp;&nbsp; CCavenue
			</td>
          </tr>
        </table>-->
       
        <!--<table id="" class="tblborder" cellspacing="0" cellpadding="3" style="border-width:2px;border-style:solid;border-collapse:collapse;">
          <tr id="" class="tblhead">
            <th id="" align="center"><span id="">Initial Ship Method Options</span></th>
          </tr>
          <tr id="">
            <td id=""><span id=""><a href='#' onClick="">International Shipping Costs Information</a></span></td>
          </tr>
          <tr>
            <td><select name="" onChange="javascript:setTimeout(&#39;__doPostBack(\&#39;ctl00$ctl00$mainContentPlaceHolder$mainContentPlaceHolder$ddlShipMethods\&#39;,\&#39;\&#39;)&#39;, 0)" id="" dir="ltr" style="font-family:Courier New;">
                <option value="-1">--Shipping Methods Available--</option>
                <option selected="selected" value="33">FedEx International Priority&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;40.00 Prepaid and Add</option>
                <option value="52">UPS World Wide Saver&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;40.00 Prepaid and Add</option>
                <option value="57">DHL Express International&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;40.00 Prepaid and Add</option>
                <option value="16">United States Postal Service Priority Mail Express International&#160;&#160;&#160;&#160;Prepaid and Add</option>
                <option value="15">UPS World Wide Expedited&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;Bill My Shipper Account</option>
                <option value="34">UPS World Wide Saver&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;Bill My Shipper Account</option>
                <option value="43">DHL Express International&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;Bill My Shipper Account</option>
                <option value="10">Other (specify in Order Notes)</option>
              </select>
              <input type="hidden" name="" id="" /></td>
          </tr>
          <tr id="">
            <td id="" style="width:600px;"><span id="">Note:  If your package is of excessive weight and size, someone will contact you prior to shipping and notify you of shipping costs.  Shipping charges will be prepaid and added to your order.</span></td>
          </tr>
        </table>-->
       
      </div>
      <br />
     
      <br />
	  
		 <input name="userId" id="userId" type="hidden" value="<?=$user->userId?>" > 
		 <input name="addtype" type="hidden" value="shipping" > 
		 <input name="goto" type="hidden" value="checkout2" > 
         <input name="<?=frontend?>" type="hidden" value="ecommerce/address" />     
      <input type="submit" name="" value="Continue" style="width:300px"/>
	  </form>
    </div>
     <br /><br /><br /><br />
   
  </div>
</div>
