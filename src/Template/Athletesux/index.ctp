<!-- File: templates/Athletesux/index.php -->

<?php    ?> 

<h1>Athletes Fast Focus</h1>

<button id="add_button" class="fa fa-plus">Add</button>
<button id="multiadd_button" class="fa fa-plus">Multi</button>
<button id="multidelete_button" class="fa fa-trash">Check</button>
<button id="multiedit_button" class="fa fa-edit">Check</button>
<button id="filter_button" class="fa fa-filter">Filter</button>
<select id="country_select"></select>
<select id="gender_select"></select>

<br>

<?php echo $this->Paginator->counter(['format' => 'range']); ?> 

<?php $csrfToken = $this->request->getParam('_csrfToken'); ?>

<br>

<ul>
<?php echo $this->Paginator->numbers(); ?>
    </ul>

<table id="athlete_table">
    <thead>
        <tr>
            <th><input type="checkbox" class="athlete_check" id="select_all"></th>
            <th><?php echo $this->Paginator->sort('last_name', 'Name'); ?></th>
            <th><?php echo $this->Paginator->sort('threek_time', '3K PB'); ?></th>            
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
                <button class="fa fa-edit edit_onpage op_action" id="<?php echo $athlete->id ?>">OP</button>   
            </td>
            <td>
                <?php echo ($athlete['last_name'] . " " . $athlete['first_name']); ?>
            </td>
            <td><?php echo ($athlete['threek_time']->i18nFormat('HH:mm:ss')); ?></td>             
            <td><?php echo ($athlete['fivek_time']->i18nFormat('HH:mm:ss')); ?></td> 
            <td><?php echo ($athlete['tenk_time']->i18nFormat('HH:mm:ss')); ?></td>                    
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

<ul>

<a> <?php echo $this->Paginator->first('<< First', ['class' => 'paginate']); ?> </a>
<a> <?php echo $this->Paginator->prev(' << ' . __('Previous'), ['class' => 'paginate']); ?> </a>
<a> <?php echo $this->Paginator->next('Next >>'); ?> </a>
<a> <?php echo $this->Paginator->last('Last >>'); ?> </a>

</ul>

<div id="filter_table"></div>
<div id="add_data"></div>
<div id="multiadd_data"></div>
<div id="edit_data"></div>
<div id="delete_data"></div>


<script>

    var csrf_token = <?php echo json_encode($csrfToken) ?>;  // token for ajax calls 

    var addurl = "<?php echo $this->Url->build('/athletesux/add_dialog', true) ?>";   
    var multiaddurl = "<?php echo $this->Url->build('/athletesux/multiadd_dialog', true) ?>";      
    var editurl = "<?php echo $this->Url->build('/athletesux/edit_dialog', true) ?>";    
    var deleteurl = "<?php echo $this->Url->build('/athletesux/delete', true) ?>";
    var multideleteurl = "<?php echo $this->Url->build('/athletesux/multidelete', true) ?>";
    var multiediturl = "<?php echo $this->Url->build('/athletesux/multiedit', true) ?>";
    var editonpageeurl = "<?php echo $this->Url->build('/athletesux/edit_on_page', true) ?>";
    var filterurl = "<?php echo $this->Url->build('/athletesux/filter_data', true) ?>";
    var select_all = 0; // toggle value for select all 
    var edit_op = 0;  // toggle value edit on page     
    var countries = {"AF":"Afghanistan","AX":"\u00c5land Islands","AL":"Albania","DZ":"Algeria","AS":"American Samoa","AD":"Andorra","AO":"Angola","AI":"Anguilla","AQ":"Antarctica","AG":"Antigua and Barbuda","AR":"Argentina","AM":"Armenia","AW":"Aruba","AU":"Australia","AT":"Austria","AZ":"Azerbaijan","BS":"Bahamas","BH":"Bahrain","BD":"Bangladesh","BB":"Barbados","BY":"Belarus","BE":"Belgium","BZ":"Belize","BJ":"Benin","BM":"Bermuda","BT":"Bhutan","BO":"Bolivia","BA":"Bosnia and Herzegovina","BW":"Botswana","BV":"Bouvet Island","BR":"Brazil","IO":"British Indian Ocean Territory","BN":"Brunei Darussalam","BG":"Bulgaria","BF":"Burkina Faso","BI":"Burundi","KH":"Cambodia","CM":"Cameroon","CA":"Canada","CV":"Cape Verde","KY":"Cayman Islands","CF":"Central African Republic","TD":"Chad","CL":"Chile","CN":"China","CX":"Christmas Island","CC":"Cocos (Keeling) Islands","CO":"Colombia","KM":"Comoros","CG":"Congo","CD":"Congo, The Democratic Republic of The","CK":"Cook Islands","CR":"Costa Rica","CI":"Cote D'ivoire","HR":"Croatia","CU":"Cuba","CY":"Cyprus","CZ":"Czech Republic","DK":"Denmark","DJ":"Djibouti","DM":"Dominica","DO":"Dominican Republic","EC":"Ecuador","EG":"Egypt","SV":"El Salvador","GQ":"Equatorial Guinea","ER":"Eritrea","EE":"Estonia","ET":"Ethiopia","FK":"Falkland Islands (Malvinas)","FO":"Faroe Islands","FJ":"Fiji","FI":"Finland","FR":"France","GF":"French Guiana","PF":"French Polynesia","TF":"French Southern Territories","GA":"Gabon","GM":"Gambia","GE":"Georgia","DE":"Germany","GH":"Ghana","GI":"Gibraltar","GR":"Greece","GL":"Greenland","GD":"Grenada","GP":"Guadeloupe","GU":"Guam","GT":"Guatemala","GG":"Guernsey","GN":"Guinea","GW":"Guinea-bissau","GY":"Guyana","HT":"Haiti","HM":"Heard Island and Mcdonald Islands","VA":"Holy See (Vatican City State)","HN":"Honduras","HK":"Hong Kong","HU":"Hungary","IS":"Iceland","IN":"India","ID":"Indonesia","IR":"Iran, Islamic Republic of","IQ":"Iraq","IE":"Ireland","IM":"Isle of Man","IL":"Israel","IT":"Italy","JM":"Jamaica","JP":"Japan","JE":"Jersey","JO":"Jordan","KZ":"Kazakhstan","KE":"Kenya","KI":"Kiribati","KP":"Korea, Democratic People's Republic of","KR":"Korea, Republic of","KW":"Kuwait","KG":"Kyrgyzstan","LA":"Lao People's Democratic Republic","LV":"Latvia","LB":"Lebanon","LS":"Lesotho","LR":"Liberia","LY":"Libyan Arab Jamahiriya","LI":"Liechtenstein","LT":"Lithuania","LU":"Luxembourg","MO":"Macao","MK":"Macedonia, The Former Yugoslav Republic of","MG":"Madagascar","MW":"Malawi","MY":"Malaysia","MV":"Maldives","ML":"Mali","MT":"Malta","MH":"Marshall Islands","MQ":"Martinique","MR":"Mauritania","MU":"Mauritius","YT":"Mayotte","MX":"Mexico","FM":"Micronesia, Federated States of","MD":"Moldova, Republic of","MC":"Monaco","MN":"Mongolia","ME":"Montenegro","MS":"Montserrat","MA":"Morocco","MZ":"Mozambique","MM":"Myanmar","NA":"Namibia","NR":"Nauru","NP":"Nepal","NL":"Netherlands","AN":"Netherlands Antilles","NC":"New Caledonia","NZ":"New Zealand","NI":"Nicaragua","NE":"Niger","NG":"Nigeria","NU":"Niue","NF":"Norfolk Island","MP":"Northern Mariana Islands","NO":"Norway","OM":"Oman","PK":"Pakistan","PW":"Palau","PS":"Palestinian Territory, Occupied","PA":"Panama","PG":"Papua New Guinea","PY":"Paraguay","PE":"Peru","PH":"Philippines","PN":"Pitcairn","PL":"Poland","PT":"Portugal","PR":"Puerto Rico","QA":"Qatar","RE":"Reunion","RO":"Romania","RU":"Russian Federation","RW":"Rwanda","SH":"Saint Helena","KN":"Saint Kitts and Nevis","LC":"Saint Lucia","PM":"Saint Pierre and Miquelon","VC":"Saint Vincent and The Grenadines","WS":"Samoa","SM":"San Marino","ST":"Sao Tome and Principe","SA":"Saudi Arabia","SN":"Senegal","RS":"Serbia","SC":"Seychelles","SL":"Sierra Leone","SG":"Singapore","SK":"Slovakia","SI":"Slovenia","SB":"Solomon Islands","SO":"Somalia","ZA":"South Africa","GS":"South Georgia and The South Sandwich Islands","ES":"Spain","LK":"Sri Lanka","SD":"Sudan","SR":"Suriname","SJ":"Svalbard and Jan Mayen","SZ":"Swaziland","SE":"Sweden","CH":"Switzerland","SY":"Syrian Arab Republic","TW":"Taiwan, Province of China","TJ":"Tajikistan","TZ":"Tanzania, United Republic of","TH":"Thailand","TL":"Timor-leste","TG":"Togo","TK":"Tokelau","TO":"Tonga","TT":"Trinidad and Tobago","TN":"Tunisia","TR":"Turkey","TM":"Turkmenistan","TC":"Turks and Caicos Islands","TV":"Tuvalu","UG":"Uganda","UA":"Ukraine","AE":"United Arab Emirates","GB":"United Kingdom","US":"United States","UM":"United States Minor Outlying Islands","UY":"Uruguay","UZ":"Uzbekistan","VU":"Vanuatu","VE":"Venezuela","VN":"Viet Nam","VG":"Virgin Islands, British","VI":"Virgin Islands, U.S.","WF":"Wallis and Futuna","EH":"Western Sahara","YE":"Yemen","ZM":"Zambia","ZW":"Zimbabwe"}          
    var gender = {"M" : "male", "f" : "female"};
    
    $(window).load(function() { 

        $.each(countries, function(val, text) {
            $('#country_select').append(
                $('<option></option>').val(val).html(text)
            );  
        });

        $.each(gender, function(val, text) {
            $('#gender_select').append(
                $('<option></option>').val(val).html(text)
            );          
        });

        // run through table will act funny with paginate..  
        // therefore ajax call with DB interaction        
        $('#filter_button').click(function(){

            var filter_data = [];
            var country_sel = $('#country_select').val();
            var gender_sel = $('#gender_select').children("option:selected").text();
            filter_data.push(country_sel, gender_sel);

            $.ajax({
                    type: 'post',
                    url: filterurl,
                    headers: {'X-CSRF-Token': csrf_token},
                    data: {tofilter : filter_data},
                    success: function(result){

                        $('#athlete_table').remove();
                        $('#filter_table').html(result);
                        
                    }
            });    
        });     

        $('#multiedit_button').click(function(){

            // run through all rows of the table and check if the checkbox is checked 
            var checked = [];

            // loop through each row of the table 
            $('#athlete_table').find('input[type=checkbox]').each(function(idx, ele){
                
                var checkbox = $(this);

                // if the checkbox is checked 
                if(checkbox.is(':checked')){

                    checked.push(checkbox.attr('id'));

                }
            });  
-
            // action multiedit in controller 
            $.ajax({
                    type: 'post',
                    url: multiediturl,
                    headers: {'X-CSRF-Token': csrf_token},
                    data: {toedit : checked},
                    success: function(result){

                        console.log(result);
                        
                    }
            });              

        });   
        
        // function for selecting/ deselecting all checkboxes 
        $('#select_all').click(function(){    

            console.log("select al");    

            if(select_all == 0){

                $('#athlete_table').find('input[type=checkbox]').each(function(idx, ele){

                    $(this).prop('checked', true);

                });

                select_all = 1;

            } else {        

                $('#athlete_table').find('input[type=checkbox]').each(function(idx, ele){

                $(this).prop('checked', false);

                });    

                select_all = 0;

            };
        });

        // calls the dialog for adding single object  
        $('#add_button').click(function(){

            $.ajax({
                    type: 'post',
                    url: addurl,
                    headers: {'X-CSRF-Token': csrf_token},
                    success: function(result){

                        $('#add_data').html(result);
                        
                    }
                });      
        }); 

        // calls the dialog for adding multiple objects 
        $('#multiadd_button').click(function(){

            $.ajax({
                    type: 'post',
                    url: multiaddurl,
                    headers: {'X-CSRF-Token': csrf_token},
                    success: function(result){

                        $('#multiadd_data').html(result);
                        
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

                        if(result == 1){

                            location.reload(true);

                        } else {

                            console.log(2);                     
                            $('#delete_data').html(result);

                        }
                }
            });  
        });        


        // calls the dialog for editing single object 
        $('.edit_class').click(function(){

            var athlete_id = event.target.id;

            $.ajax({
                    type: 'post',
                    url: editurl,
                    headers: {'X-CSRF-Token': csrf_token},
                    data: {atid : athlete_id},
                    success: function(result){

                        console.log(result);
                        $('#edit_data').html(result);
                        
                    }
                });  
        });

        // logic for editing single object in table 
        $('.edit_onpage').click(function(){

            if(edit_op == 0){

                // make row content editable 
                var row = $(this).closest('tr');  
                row.attr('contenteditable', true);

                // change text on button 
                $(this).html('save');

                edit_op = 1;

            } else {

                // make row content editable 
                var row = $(this).closest('tr');  
                row.attr('contenteditable', false);

                // change text on button 
                $(this).html('op');

                // data to database 
                var athlete_save = [];

                // save data in the row - needed some manipulation for the names because this gives long array 
                var fullname = $(this).closest('tr').children("td:nth-child(2)").html();
                var names = fullname.split(" ");
                var names_filtered = [];
                var regex_test = new RegExp('[a-zA-Z]')

                // case multiple first names 
                $.each(names, function(index, value){
                    if(regex_test.test(value)){

                        names_filtered.push(value);

                    }
                });

                var firstname = "";
                for (i = 0; i < names_filtered.length - 1; i++){

                    if (i == 0){

                        firstname += names_filtered[i];

                    } else {

                        firstname += " " + names_filtered[i];                        

                    }
                }

                var lastname = names_filtered[names_filtered.length - 1];

                var threek = $(this).closest('tr').children("td:nth-child(3)").text();
                var fivek = $(this).closest('tr').children("td:nth-child(4)").text();
                var tenk = $(this).closest('tr').children("td:nth-child(5)").text();
                var id = $(this).closest('tr').children("td:nth-child(7)").text();     

                athlete_save.push(firstname);
                athlete_save.push(lastname);      
                athlete_save.push(threek);     
                athlete_save.push(fivek);     
                athlete_save.push(tenk);    
                athlete_save.push(id);  
                
                console.log(athlete_save);  

                $.ajax({
                    type: 'post',
                    url: editonpageeurl,
                    headers: {'X-CSRF-Token': csrf_token},
                    data: {toedit : athlete_save},
                    success: function(result){

                        console.log(result);
                        // location.reload(true);
                        
                    }
                });                

                edit_op = 0;                

            }
        });        

        $('#multidelete_button').click(function(){

            // run through all rows of the table and check if the checkbox is checked 
            var checked = [];

            if($('#athlete_table').length){

                console.log('multi delete basic');

                // loop through each row of the table 
                $('#athlete_table').find('input[type=checkbox]').each(function(idx, ele){
                    
                    var checkbox = $(this);

                    // if the checkbox is checked 
                    if(checkbox.is(':checked')){

                        checked.push(checkbox.attr('id'));

                    }
                });  

            } else if($('#filterathlete_table').length) {

                console.log('multi delete filter');                

                // loop through each row of the table 
                $('#filterathlete_table').find('input[type=checkbox]').each(function(idx, ele){
                    
                    var checkbox = $(this);

                    // if the checkbox is checked 
                    if(checkbox.is(':checked')){

                        checked.push(checkbox.attr('id'));

                    }
                });  
            }

            console.log(checked);

            // action multidelete in controller 
            $.ajax({
                    type: 'post',
                    url: multideleteurl,
                    headers: {'X-CSRF-Token': csrf_token},
                    data: {todelete : checked},
                    success: function(result){

                        location.reload(true);
                        
                    }
                });              
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

    #athlete_table td{

        vertical-align: middle;

    }
 

</style>