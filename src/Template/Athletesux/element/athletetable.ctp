<!-- modal for athlete add & edit actions --> 
<table id="filterathlete_table">
    <thead>
        <tr>
            <th><input type="checkbox" class="athlete_check" id="select_all"></th>
            <th>Full Name</th>
            <th>3K PB</th>            
            <th>5K PB</th>
            <th>10K PB</th>    
            <th>Edit</th>    
            <th>Delete</th>    
            <th class="hide">ID</th>   
        </tr>
    </thead>

    <tbody>
    <?php foreach ($athletes as $id => $athlete): ?>
        <tr>        
            <td class="checkbox_athlete">
                <input type="checkbox" class="athlete_check" id="<?php echo $athlete['id'] ?>">
            </td>
            <td>
                <?php echo ($athlete['first_name'] . " " . $athlete['last_name']) ?>
            </td>
            <td><?php echo ($athlete['threek_time']) ?></td>             
            <td><?php echo ($athlete['fivek_time']) ?></td> 
            <td><?php echo ($athlete['tenk_time']) ?></td>                    
            <td>
                <button class="fa fa-edit edit_class il_action" id="<?php echo $athlete->id ?>"></button>            
            </td>
            <td>
                <button class="fa fa-trash delete_class il_action" id="<?php echo $athlete->id ?>"></button>    
            </td>
            <td class="hide" ><?php echo ($athlete['id']) ?></td>                
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>

    var addurl = "http://wampprojects/composer_cakephptut/athletesux/add_dialog";    
    var editurl = "http://wampprojects/composer_cakephptut/athletesux/edit_dialog";
    var deleteurl = "http://wampprojects/composer_cakephptut/athletesux/delete";
    var editonpageeurl = "http://wampprojects/composer_cakephptut/athletesux/edit_on_page";
    var filterurl = "http://wampprojects/composer_cakephptut/athletesux/filter_data"; 
    var select_all = 0; // toggle value for select all 
    var edit_op = 0;  // toggle value edit on page     
    var countries = {"AF":"Afghanistan","AX":"\u00c5land Islands","AL":"Albania","DZ":"Algeria","AS":"American Samoa","AD":"Andorra","AO":"Angola","AI":"Anguilla","AQ":"Antarctica","AG":"Antigua and Barbuda","AR":"Argentina","AM":"Armenia","AW":"Aruba","AU":"Australia","AT":"Austria","AZ":"Azerbaijan","BS":"Bahamas","BH":"Bahrain","BD":"Bangladesh","BB":"Barbados","BY":"Belarus","BE":"Belgium","BZ":"Belize","BJ":"Benin","BM":"Bermuda","BT":"Bhutan","BO":"Bolivia","BA":"Bosnia and Herzegovina","BW":"Botswana","BV":"Bouvet Island","BR":"Brazil","IO":"British Indian Ocean Territory","BN":"Brunei Darussalam","BG":"Bulgaria","BF":"Burkina Faso","BI":"Burundi","KH":"Cambodia","CM":"Cameroon","CA":"Canada","CV":"Cape Verde","KY":"Cayman Islands","CF":"Central African Republic","TD":"Chad","CL":"Chile","CN":"China","CX":"Christmas Island","CC":"Cocos (Keeling) Islands","CO":"Colombia","KM":"Comoros","CG":"Congo","CD":"Congo, The Democratic Republic of The","CK":"Cook Islands","CR":"Costa Rica","CI":"Cote D'ivoire","HR":"Croatia","CU":"Cuba","CY":"Cyprus","CZ":"Czech Republic","DK":"Denmark","DJ":"Djibouti","DM":"Dominica","DO":"Dominican Republic","EC":"Ecuador","EG":"Egypt","SV":"El Salvador","GQ":"Equatorial Guinea","ER":"Eritrea","EE":"Estonia","ET":"Ethiopia","FK":"Falkland Islands (Malvinas)","FO":"Faroe Islands","FJ":"Fiji","FI":"Finland","FR":"France","GF":"French Guiana","PF":"French Polynesia","TF":"French Southern Territories","GA":"Gabon","GM":"Gambia","GE":"Georgia","DE":"Germany","GH":"Ghana","GI":"Gibraltar","GR":"Greece","GL":"Greenland","GD":"Grenada","GP":"Guadeloupe","GU":"Guam","GT":"Guatemala","GG":"Guernsey","GN":"Guinea","GW":"Guinea-bissau","GY":"Guyana","HT":"Haiti","HM":"Heard Island and Mcdonald Islands","VA":"Holy See (Vatican City State)","HN":"Honduras","HK":"Hong Kong","HU":"Hungary","IS":"Iceland","IN":"India","ID":"Indonesia","IR":"Iran, Islamic Republic of","IQ":"Iraq","IE":"Ireland","IM":"Isle of Man","IL":"Israel","IT":"Italy","JM":"Jamaica","JP":"Japan","JE":"Jersey","JO":"Jordan","KZ":"Kazakhstan","KE":"Kenya","KI":"Kiribati","KP":"Korea, Democratic People's Republic of","KR":"Korea, Republic of","KW":"Kuwait","KG":"Kyrgyzstan","LA":"Lao People's Democratic Republic","LV":"Latvia","LB":"Lebanon","LS":"Lesotho","LR":"Liberia","LY":"Libyan Arab Jamahiriya","LI":"Liechtenstein","LT":"Lithuania","LU":"Luxembourg","MO":"Macao","MK":"Macedonia, The Former Yugoslav Republic of","MG":"Madagascar","MW":"Malawi","MY":"Malaysia","MV":"Maldives","ML":"Mali","MT":"Malta","MH":"Marshall Islands","MQ":"Martinique","MR":"Mauritania","MU":"Mauritius","YT":"Mayotte","MX":"Mexico","FM":"Micronesia, Federated States of","MD":"Moldova, Republic of","MC":"Monaco","MN":"Mongolia","ME":"Montenegro","MS":"Montserrat","MA":"Morocco","MZ":"Mozambique","MM":"Myanmar","NA":"Namibia","NR":"Nauru","NP":"Nepal","NL":"Netherlands","AN":"Netherlands Antilles","NC":"New Caledonia","NZ":"New Zealand","NI":"Nicaragua","NE":"Niger","NG":"Nigeria","NU":"Niue","NF":"Norfolk Island","MP":"Northern Mariana Islands","NO":"Norway","OM":"Oman","PK":"Pakistan","PW":"Palau","PS":"Palestinian Territory, Occupied","PA":"Panama","PG":"Papua New Guinea","PY":"Paraguay","PE":"Peru","PH":"Philippines","PN":"Pitcairn","PL":"Poland","PT":"Portugal","PR":"Puerto Rico","QA":"Qatar","RE":"Reunion","RO":"Romania","RU":"Russian Federation","RW":"Rwanda","SH":"Saint Helena","KN":"Saint Kitts and Nevis","LC":"Saint Lucia","PM":"Saint Pierre and Miquelon","VC":"Saint Vincent and The Grenadines","WS":"Samoa","SM":"San Marino","ST":"Sao Tome and Principe","SA":"Saudi Arabia","SN":"Senegal","RS":"Serbia","SC":"Seychelles","SL":"Sierra Leone","SG":"Singapore","SK":"Slovakia","SI":"Slovenia","SB":"Solomon Islands","SO":"Somalia","ZA":"South Africa","GS":"South Georgia and The South Sandwich Islands","ES":"Spain","LK":"Sri Lanka","SD":"Sudan","SR":"Suriname","SJ":"Svalbard and Jan Mayen","SZ":"Swaziland","SE":"Sweden","CH":"Switzerland","SY":"Syrian Arab Republic","TW":"Taiwan, Province of China","TJ":"Tajikistan","TZ":"Tanzania, United Republic of","TH":"Thailand","TL":"Timor-leste","TG":"Togo","TK":"Tokelau","TO":"Tonga","TT":"Trinidad and Tobago","TN":"Tunisia","TR":"Turkey","TM":"Turkmenistan","TC":"Turks and Caicos Islands","TV":"Tuvalu","UG":"Uganda","UA":"Ukraine","AE":"United Arab Emirates","GB":"United Kingdom","US":"United States","UM":"United States Minor Outlying Islands","UY":"Uruguay","UZ":"Uzbekistan","VU":"Vanuatu","VE":"Venezuela","VN":"Viet Nam","VG":"Virgin Islands, British","VI":"Virgin Islands, U.S.","WF":"Wallis and Futuna","EH":"Western Sahara","YE":"Yemen","ZM":"Zambia","ZW":"Zimbabwe"}          
    var gender = {"M" : "male", "f" : "female"};

    // function for selecting/ deselecting all checkboxes 
    $('#select_all').click(function(){    

        if(select_all == 0){

            $('#filterathlete_table').find('input[type=checkbox]').each(function(idx, ele){

                $(this).prop('checked', true);

            });

            select_all = 1;

        } else {        

            $('#filterathlete_table').find('input[type=checkbox]').each(function(idx, ele){

            $(this).prop('checked', false);

            });    

            select_all = 0;

        };
    });

    // calls the dialog for editing single object 
    $('.edit_class').click(function(){

        var athlete_id = event.target.id;

        console.log(athlete_id);

        $.ajax({
                type: 'post',
                url: editurl,
                headers: {'X-CSRF-Token': csrf_token},
                data: {atid : athlete_id},
                success: function(result){

                    $('#edit_data').html(result);
                    
                }
        });  
    });    

        
    $('.delete_class').click(function(){

        var athlete_id = event.target.id;

        $.ajax({
                type: 'post',
                url: deleteurl,
                headers: {'X-CSRF-Token': csrf_token},
                data: {atid : athlete_id},
                success: function(result){
            
                    location.reload(true);   

            }
        });  
    });  

</script>

<style>

    .hide { display: none; }

    .il_action{

        background-color : transparent;
        color: black;
        height: 50px;

    }

    .op_action{

        background-color : transparent;
        color: black;
        height: 50px;

    }

    #filterathlete_table{

        vertical-align: middle;

    }

</style>