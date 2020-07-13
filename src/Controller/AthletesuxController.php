<?php
// src/Controller/AthletesuxController.php

namespace App\Controller;

use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;


class AthletesuxController extends AppController {

    public $paginate = [
        'limit' => 10,
        'order' => [
            'Races.title' => 'asc'
        ]
    ];    

    public function initialize(){

        parent::initialize();
        $this->loadModel('Athletes');
        $this->loadModel('Users');
        $this->loadModel('Events');        
        $this->loadComponent('Paginator');
        $this->Auth->allow(['edit', 'delete', 'addDialog']);     

    }

    public function index(){

        $all_athletes = $this->Athletes->find();   
        $this->set('athletes', $this->paginate($all_athletes));
        
    }   

    public function dragdroptests(){

        $all_athletes = $this->Athletes->find();   
        $this->set('athletes', $all_athletes);            

    }

    public function responsivechart(){

        $all_athletes = $this->Athletes->find();  

        $new_athletes = [];
        $country_athletes = [];

        foreach($all_athletes as $ath):

            $new_ath = $ath;
            $new_ath['threek_time'] = $ath['threek_time']->i18nFormat('HH:mm:ss');
            $new_ath['fivek_time'] = $ath['fivek_time']->i18nFormat('HH:mm:ss');
            $new_ath['tenk_time'] = $ath['tenk_time']->i18nFormat('HH:mm:ss');
            array_push($new_athletes, $new_ath);

        endforeach;

        // debug($new_athletes);

        // group per country 
        $countries = $this->countryOptions();

        foreach($countries as $ccode => $country):

            $country_athletes[$ccode]['country'] = [$country];
            $country_athletes[$ccode]['athletes'] = [];

            foreach($new_athletes as $ath):

                if($ccode === $ath['country']){

                    array_push($country_athletes[$ccode]['athletes'], $ath);

                }

            endforeach;

        endforeach;

        $this->set('athletes', $country_athletes);           

    }

    public function athletescatter(){

        $all_athletes = $this->Athletes->find();  

        $new_athletes = [];
        $country_athletes = [];

        foreach($all_athletes as $ath):

            $new_ath = $ath;
            $new_ath['threek_time'] = $ath['threek_time']->i18nFormat('HH:mm:ss');
            $new_ath['fivek_time'] = $ath['fivek_time']->i18nFormat('HH:mm:ss');
            $new_ath['tenk_time'] = $ath['tenk_time']->i18nFormat('HH:mm:ss');

            $duration_threek_minutes = intval(substr($ath['threek_time'], 3, 2));  
            $duration_threek_seconds = intval(substr($ath['threek_time'], 6, 2));  
            $new_ath['threek_duration'] = $duration_threek_minutes + $duration_threek_seconds/60;
            
            $duration_fivek_minutes = intval(substr($ath['fivek_time'], 3, 2));  
            $duration_fivek_seconds = intval(substr($ath['fivek_time'], 6, 2));  
            $new_ath['fivek_duration'] = $duration_fivek_minutes + $duration_fivek_seconds/60;            

            $duration_tenk_minutes = intval(substr($ath['tenk_time'], 3, 2));  
            $duration_tenk_seconds = intval(substr($ath['tenk_time'], 6, 2));  
            $new_ath['tenk_duration'] = $duration_tenk_minutes + $duration_tenk_seconds/60;               
        
            array_push($new_athletes, $new_ath);

        endforeach;


        $countries = $this->countryOptions();

        foreach($countries as $ccode => $country):

            // make array for each country 
            $country_athletes[$ccode]['country'] = [$country];
            $country_athletes[$ccode]['athletes'] = [];

            foreach($new_athletes as $ath):

                if($ccode === $ath['country']){

                    array_push($country_athletes[$ccode]['athletes'], $ath);

                }

            endforeach;

            // remove all countries without athletes 
            if(sizeof($country_athletes[$ccode]['athletes']) === 0 ){

                unset($country_athletes[$ccode]);

            }

        endforeach;

        $this->set('athletes', $country_athletes);    
        

        // populate select box with countries that have at least one athlete 
        $countries = $this->countryOptions();

        foreach($countries as $ccode => $country):

            // if country code is no key in country athletes array 
            if(!array_key_exists($ccode, $country_athletes)){

                unset($countries[$ccode]); 

            }

        endforeach; 

        $this->set('countryoptions', $countries);   

    }

    public function tooltipchart(){

        $all_athletes = $this->Athletes->find();  

        $new_athletes = [];
        $country_athletes = [];

        foreach($all_athletes as $ath):

            $new_ath = $ath;
            $new_ath['threek_time'] = $ath['threek_time']->i18nFormat('HH:mm:ss');
            $new_ath['fivek_time'] = $ath['fivek_time']->i18nFormat('HH:mm:ss');
            $new_ath['tenk_time'] = $ath['tenk_time']->i18nFormat('HH:mm:ss');
            array_push($new_athletes, $new_ath);

        endforeach;

        // debug($new_athletes);

        // group per country 
        $countries = $this->countryOptions();

        foreach($countries as $ccode => $country):

            $country_athletes[$ccode]['country'] = [$country];
            $country_athletes[$ccode]['athletes'] = [];

            foreach($new_athletes as $ath):

                if($ccode === $ath['country']){

                    array_push($country_athletes[$ccode]['athletes'], $ath);

                }

            endforeach;

        endforeach;

        $this->set('athletes', $country_athletes);           

    }    

    public function cartasesp(){

        $all_athletes = $this->Athletes->find();  

        $new_athletes = [];
        $country_athletes = [];

        foreach($all_athletes as $ath):

            $new_ath = $ath;
            $new_ath['threek_time'] = $ath['threek_time']->i18nFormat('HH:mm:ss');
            $new_ath['fivek_time'] = $ath['fivek_time']->i18nFormat('HH:mm:ss');
            $new_ath['tenk_time'] = $ath['tenk_time']->i18nFormat('HH:mm:ss');
            array_push($new_athletes, $new_ath);

        endforeach;

        // debug($new_athletes);

        // group per country 
        $countries = $this->countryOptions();

        foreach($countries as $ccode => $country):

            $country_athletes[$ccode]['country'] = [$country];
            $country_athletes[$ccode]['athletes'] = [];

            foreach($new_athletes as $ath):

                if($ccode === $ath['country']){

                    array_push($country_athletes[$ccode]['athletes'], $ath);

                }

            endforeach;

        endforeach;

        $this->set('athletes', $country_athletes);           

    }

    public function gaugechart(){

        $all_athletes = $this->Athletes->find();   
        $this->set('athletes', $all_athletes);        

    }    

    public function calendarchart(){

        $all_events = $this->Events->find();   
        $this->set('events', $all_events);             

    }

    public function piechart(){

        $all_athletes = $this->Athletes->find();   
        $this->set('athletes', $all_athletes);        

    }       

    public function charts(){

        $all_athletes = $this->Athletes->find();   
        $this->set('athletes', $all_athletes);        

    }

    public function cartes(){

        $all_athletes = $this->Athletes->find();  

        $new_athletes = [];
        $country_athletes = [];

        foreach($all_athletes as $ath):

            $new_ath = $ath;
            $new_ath['threek_time'] = $ath['threek_time']->i18nFormat('HH:mm:ss');
            $new_ath['fivek_time'] = $ath['fivek_time']->i18nFormat('HH:mm:ss');
            $new_ath['tenk_time'] = $ath['tenk_time']->i18nFormat('HH:mm:ss');
            array_push($new_athletes, $new_ath);

        endforeach;

        // debug($new_athletes);

        // group per country 
        $countries = $this->countryOptions();

        foreach($countries as $ccode => $country):

            $country_athletes[$ccode]['country'] = [$country];
            $country_athletes[$ccode]['athletes'] = [];

            foreach($new_athletes as $ath):

                if($ccode === $ath['country']){

                    array_push($country_athletes[$ccode]['athletes'], $ath);

                }

            endforeach;

        endforeach;

        $this->set('athletes', $country_athletes);          

    }

    public function delete(){

        $id = intval($this->request->getData('atid'));            

        // check if the user is logged in
        if($this->Auth->user('id')){

            $athlete = $this->Athletes->get($id);

            if ($this->Athletes->delete($athlete)) {

                $this->Flash->success(__('The {0} athlete has been deleted.', $athlete->name));

                $result = 1;

                $this->response->body(json_encode($result));
                return $this->response;  

            }   
        } else {

            $this->set('user', '');
            $this->render('element/logindialog', 'ajax'); 
  
        }
    }   

    public function addDialog(){

        if($this->Auth->user('id')){

            $gender = array( "male" => "m", "female" => "f");      
            $this->set('gender', $gender);        
    
            $athlete = $this->Athletes->newEntity();  
            $athlete['3K_time'] = '00:07:00';
            $athlete['5K_time'] = '00:13:00';        
            $athlete['10K_time'] = '00:27:00';
    
            $user_id = $this->Auth->user('id');
            $this->set('userid', $user_id);
    
            $countries = $this->countryOptions();
            $this->set('countryoptions', $countries);   
    
            $this->set('athlete', $athlete);      
    
            $action = 'add';   
            $this->set('action', $action);   

            // you need to add this field to the request, Security Component needs it.. 
            $this->request->params['_Token'] = ['unlockedFields' => []];
        
            $this->render('element/athletecreate', 'ajax'); 

        } else {
            
            $this->set('user', '');

            // you need to add this field to the request, Security Component needs it.. 
            $this->request->params['_Token'] = ['unlockedFields' => []];

            $this->render('element/logindialog', 'ajax'); 

        }
    }  
    
    public function add(){

        $athlete = $this->Athletes->newEntity();

        if ($this -> request -> is('post')) {

            $athlete_save = $this->Athletes->patchEntity($athlete, $this->request->getData());

            $athlete->user_id = $this->Auth->user('id');

            if ($this->Athletes->save($athlete_save)) {

                $this->Flash->success(__('The Athlete Profile has been created.'));
                $this -> redirect(array('action' => 'index'));

            } else {

                $this->Flash->error(__('The Athlete Profile could not be created. Please, try again.'));

            }
        } 
    }      

    public function multiaddDialog(){

        $gender = array( "male" => "m", "female" => "f");      
        $this->set('gender', $gender);             

        $athlete = $this->Athletes->newEntity();  
        $athlete['threek_time'] = '00:00:00';
        $athlete['fivek_time'] = '00:00:00';        
        $athlete['tenk_time'] = '00:00:00';

        $countries = $this->countryOptions();
        $this->set('countryoptions', $countries);   

        $this->set('athlete', $athlete);      

        $action = 'multiadd';   
        $this->set('action', $action);    
        
        // you need to add this field to the request, Security Component needs it.. 
        $this->request->params['_Token'] = ['unlockedFields' => []];

        $this->render('element/athletemulticreate', 'ajax'); 

    }         

    public function multiadd(){

        $athletes_save = $this->request->getData('athletes_save'); 

        $tenk = $athletes_save[1][0]['first_name'];
        $test = [];

        foreach($athletes_save as $ath):

            $athlete = $this->Athletes->newEntity();   
            
            $athlete->user_id = $ath[0]['user_id'];
            $athlete->first_name = $ath[0]['first_name'];
            $athlete->last_name = $ath[0]['last_name'];
            $athlete->threek_time = $ath[0]['threek_time'];
            $athlete->fivek_time = $ath[0]['fivek_time'];
            $athlete->tenk_time = $ath[0]['tenk_time'];  
            $athlete->country = $ath[0]['country'];
            $athlete->gender = $ath[0]['gender'];

            $this->Athletes->save($athlete);              
            
        endforeach;   

        $this->Flash->success(__('Selected Athletes have been added.'));             

        $this->response->body(json_encode($athletes_save));
        return $this->response;      

    }    
    
    public function editDialog(){
 
        $athlete_id = $this->request->getData('atid');   

        $countries = $this->countryOptions();
        $this->set('countryoptions', $countries);     
        
        $gender = array( "male" => "m", "female" => "f");      
        $this->set('gender', $gender);

        $user_id = $this->Auth->user('id');
        $this->set('userid', $user_id);        

        $athlete = $this->Athletes->get($athlete_id);  
        
        // transform FrozenTime into normal time 
        $threek_time = $athlete['threek_time']->i18nFormat('HH:mm:ss');
        $fivek_time = $athlete['fivek_time']->i18nFormat('HH:mm:ss');
        $tenk_time = $athlete['tenk_time']->i18nFormat('HH:mm:ss');                

        // build new object to pass to element 
        $athlete_new = $athlete;
        $athlete_new['3K_time'] = $threek_time;
        $athlete_new['5K_time'] = $fivek_time;
        $athlete_new['10K_time'] = $tenk_time;    
        $this->set('athlete', $athlete_new);  
        
        // set action to use on element 
        $action = 'edit';
        $this->set('action', $action);
        
        // you need to add this field to the request, Security Component needs it.. 
        $this->request->params['_Token'] = ['unlockedFields' => []];

        $this->render('element/athletecreate', 'ajax'); 

    }       
    
    public function edit($id){

        $athlete = $this->Athletes->get($id);  
        
        // if you are not just landing on page but making the save 
        if ($this->request->is(['post', 'put'])) {
            
            // prepare Athlete entity for saving 
            $this->Athletes->patchEntity($athlete, $this->request->getData());

            // Set the user_id from the session.
            $athlete->user_id = $this->Auth->user('id');
        
            if ($this->Athletes->save($athlete)) {
            
                $this->Flash->success(__('Athlete Profile has been updated.'));
                return $this->redirect(['action' => 'index']);

            }
        
        $this->Flash->error(__('Unable to update athlete profile.'));
        
        }
    }   

    public function multidelete(){

        $athletes_delete = $this->request->getData('todelete');  
        
        $check = [];

        foreach($athletes_delete as $ath_del):

            $athlete = $this->Athletes->get(intval($ath_del));
            $this->Athletes->delete($athlete); 
            
            array_push($check, $athlete);

        endforeach;
        
        $this->Flash->success(__('Selected Athletes have been deleted.'));

        $this->response->body(json_encode($check));
        return $this->response;   
    }

    public function multiedit(){

        $athletes_edit = $this->request->getData('toedit');  

        $this->response->body(json_encode($athletes_edit));
        return $this->response;          

    }

    public function editOnPage(){

        $athlete_edit = $this->request->getData('toedit');  

        // get corresponding athlete 
        $id = intval($athlete_edit[5]);  
        $athlete_corr = $this->Athletes->get($id); 

        $athlete_save = $athlete_corr;
        
        // need to get id from data.. 
        $athlete_save['first_name'] = $athlete_edit[0];          
        $athlete_save['last_name'] = $athlete_edit[1];  
        $athlete_save['threek_time'] = $athlete_edit[2];  
        $athlete_save['fivek_time'] = $athlete_edit[3]; 
        $athlete_save['tenk_time'] = $athlete_edit[4]; 

        // then save it   
        $this->Athletes->save($athlete_save);

        $aaa = $this->countryOptions();

        $this->response->body(json_encode($aaa));
        return $this->response;         

    }

    public function filterData(){

        $filterdata = $this->request->getData('tofilter');  
        $country = $filterdata[0];
        $gender = $filterdata[1];

        $athletes_filter = $this->Athletes->find('all')
            ->where(['Athletes.country' => $country, 'Athletes.gender' =>$gender]);

        // build array with formatted times 
        $new_athletesfilter = [];        

        foreach ($athletes_filter as $athlete):

            $new_athlete = $athlete;
            $new_athlete['threek_time'] = $athlete['threek_time']->i18nFormat('HH:mm:ss');
            $new_athlete['fivek_time'] = $athlete['fivek_time']->i18nFormat('HH:mm:ss');
            $new_athlete['tenk_time'] = $athlete['tenk_time']->i18nFormat('HH:mm:ss');  

            array_push($new_athletesfilter, $new_athlete);

        endforeach;

        // render an element with table inside it with the provided data 
        $this->set('athletes', $new_athletesfilter);      

        $this->render('element/athletetable', 'ajax'); 

    }

    public function countryOptions(){

        $countries = array("AF" => "Afghanistan",
            "AX" => "Åland Islands",
            "AL" => "Albania",
            "DZ" => "Algeria",
            "AS" => "American Samoa",
            "AD" => "Andorra",
            "AO" => "Angola",
            "AI" => "Anguilla",
            "AQ" => "Antarctica",
            "AG" => "Antigua and Barbuda",
            "AR" => "Argentina",
            "AM" => "Armenia",
            "AW" => "Aruba",
            "AU" => "Australia",
            "AT" => "Austria",
            "AZ" => "Azerbaijan",
            "BS" => "Bahamas",
            "BH" => "Bahrain",
            "BD" => "Bangladesh",
            "BB" => "Barbados",
            "BY" => "Belarus",
            "BE" => "Belgium",
            "BZ" => "Belize",
            "BJ" => "Benin",
            "BM" => "Bermuda",
            "BT" => "Bhutan",
            "BO" => "Bolivia",
            "BA" => "Bosnia and Herzegovina",
            "BW" => "Botswana",
            "BV" => "Bouvet Island",
            "BR" => "Brazil",
            "IO" => "British Indian Ocean Territory",
            "BN" => "Brunei Darussalam",
            "BG" => "Bulgaria",
            "BF" => "Burkina Faso",
            "BI" => "Burundi",
            "KH" => "Cambodia",
            "CM" => "Cameroon",
            "CA" => "Canada",
            "CV" => "Cape Verde",
            "KY" => "Cayman Islands",
            "CF" => "Central African Republic",
            "TD" => "Chad",
            "CL" => "Chile",
            "CN" => "China",
            "CX" => "Christmas Island",
            "CC" => "Cocos (Keeling) Islands",
            "CO" => "Colombia",
            "KM" => "Comoros",
            "CG" => "Congo",
            "CD" => "Congo, The Democratic Republic of The",
            "CK" => "Cook Islands",
            "CR" => "Costa Rica",
            "CI" => "Cote D'ivoire",
            "HR" => "Croatia",
            "CU" => "Cuba",
            "CY" => "Cyprus",
            "CZ" => "Czech Republic",
            "DK" => "Denmark",
            "DJ" => "Djibouti",
            "DM" => "Dominica",
            "DO" => "Dominican Republic",
            "EC" => "Ecuador",
            "EG" => "Egypt",
            "SV" => "El Salvador",
            "GQ" => "Equatorial Guinea",
            "ER" => "Eritrea",
            "EE" => "Estonia",
            "ET" => "Ethiopia",
            "FK" => "Falkland Islands (Malvinas)",
            "FO" => "Faroe Islands",
            "FJ" => "Fiji",
            "FI" => "Finland",
            "FR" => "France",
            "GF" => "French Guiana",
            "PF" => "French Polynesia",
            "TF" => "French Southern Territories",
            "GA" => "Gabon",
            "GM" => "Gambia",
            "GE" => "Georgia",
            "DE" => "Germany",
            "GH" => "Ghana",
            "GI" => "Gibraltar",
            "GR" => "Greece",
            "GL" => "Greenland",
            "GD" => "Grenada",
            "GP" => "Guadeloupe",
            "GU" => "Guam",
            "GT" => "Guatemala",
            "GG" => "Guernsey",
            "GN" => "Guinea",
            "GW" => "Guinea-bissau",
            "GY" => "Guyana",
            "HT" => "Haiti",
            "HM" => "Heard Island and Mcdonald Islands",
            "VA" => "Holy See (Vatican City State)",
            "HN" => "Honduras",
            "HK" => "Hong Kong",
            "HU" => "Hungary",
            "IS" => "Iceland",
            "IN" => "India",
            "ID" => "Indonesia",
            "IR" => "Iran, Islamic Republic of",
            "IQ" => "Iraq",
            "IE" => "Ireland",
            "IM" => "Isle of Man",
            "IL" => "Israel",
            "IT" => "Italy",
            "JM" => "Jamaica",
            "JP" => "Japan",
            "JE" => "Jersey",
            "JO" => "Jordan",
            "KZ" => "Kazakhstan",
            "KE" => "Kenya",
            "KI" => "Kiribati",
            "KP" => "Korea, Democratic People's Republic of",
            "KR" => "Korea, Republic of",
            "KW" => "Kuwait",
            "KG" => "Kyrgyzstan",
            "LA" => "Lao People's Democratic Republic",
            "LV" => "Latvia",
            "LB" => "Lebanon",
            "LS" => "Lesotho",
            "LR" => "Liberia",
            "LY" => "Libyan Arab Jamahiriya",
            "LI" => "Liechtenstein",
            "LT" => "Lithuania",
            "LU" => "Luxembourg",
            "MO" => "Macao",
            "MK" => "Macedonia, The Former Yugoslav Republic of",
            "MG" => "Madagascar",
            "MW" => "Malawi",
            "MY" => "Malaysia",
            "MV" => "Maldives",
            "ML" => "Mali",
            "MT" => "Malta",
            "MH" => "Marshall Islands",
            "MQ" => "Martinique",
            "MR" => "Mauritania",
            "MU" => "Mauritius",
            "YT" => "Mayotte",
            "MX" => "Mexico",
            "FM" => "Micronesia, Federated States of",
            "MD" => "Moldova, Republic of",
            "MC" => "Monaco",
            "MN" => "Mongolia",
            "ME" => "Montenegro",
            "MS" => "Montserrat",
            "MA" => "Morocco",
            "MZ" => "Mozambique",
            "MM" => "Myanmar",
            "NA" => "Namibia",
            "NR" => "Nauru",
            "NP" => "Nepal",
            "NL" => "Netherlands",
            "AN" => "Netherlands Antilles",
            "NC" => "New Caledonia",
            "NZ" => "New Zealand",
            "NI" => "Nicaragua",
            "NE" => "Niger",
            "NG" => "Nigeria",
            "NU" => "Niue",
            "NF" => "Norfolk Island",
            "MP" => "Northern Mariana Islands",
            "NO" => "Norway",
            "OM" => "Oman",
            "PK" => "Pakistan",
            "PW" => "Palau",
            "PS" => "Palestinian Territory, Occupied",
            "PA" => "Panama",
            "PG" => "Papua New Guinea",
            "PY" => "Paraguay",
            "PE" => "Peru",
            "PH" => "Philippines",
            "PN" => "Pitcairn",
            "PL" => "Poland",
            "PT" => "Portugal",
            "PR" => "Puerto Rico",
            "QA" => "Qatar",
            "RE" => "Reunion",
            "RO" => "Romania",
            "RU" => "Russian Federation",
            "RW" => "Rwanda",
            "SH" => "Saint Helena",
            "KN" => "Saint Kitts and Nevis",
            "LC" => "Saint Lucia",
            "PM" => "Saint Pierre and Miquelon",
            "VC" => "Saint Vincent and The Grenadines",
            "WS" => "Samoa",
            "SM" => "San Marino",
            "ST" => "Sao Tome and Principe",
            "SA" => "Saudi Arabia",
            "SN" => "Senegal",
            "RS" => "Serbia",
            "SC" => "Seychelles",
            "SL" => "Sierra Leone",
            "SG" => "Singapore",
            "SK" => "Slovakia",
            "SI" => "Slovenia",
            "SB" => "Solomon Islands",
            "SO" => "Somalia",
            "ZA" => "South Africa",
            "GS" => "South Georgia and The South Sandwich Islands",
            "ES" => "Spain",
            "LK" => "Sri Lanka",
            "SD" => "Sudan",
            "SR" => "Suriname",
            "SJ" => "Svalbard and Jan Mayen",
            "SZ" => "Swaziland",
            "SE" => "Sweden",
            "CH" => "Switzerland",
            "SY" => "Syrian Arab Republic",
            "TW" => "Taiwan, Province of China",
            "TJ" => "Tajikistan",
            "TZ" => "Tanzania, United Republic of",
            "TH" => "Thailand",
            "TL" => "Timor-leste",
            "TG" => "Togo",
            "TK" => "Tokelau",
            "TO" => "Tonga",
            "TT" => "Trinidad and Tobago",
            "TN" => "Tunisia",
            "TR" => "Turkey",
            "TM" => "Turkmenistan",
            "TC" => "Turks and Caicos Islands",
            "TV" => "Tuvalu",
            "UG" => "Uganda",
            "UA" => "Ukraine",
            "AE" => "United Arab Emirates",
            "GB" => "United Kingdom",
            "US" => "United States",
            "UM" => "United States Minor Outlying Islands",
            "UY" => "Uruguay",
            "UZ" => "Uzbekistan",
            "VU" => "Vanuatu",
            "VE" => "Venezuela",
            "VN" => "Viet Nam",
            "VG" => "Virgin Islands, British",
            "VI" => "Virgin Islands, U.S.",
            "WF" => "Wallis and Futuna",
            "EH" => "Western Sahara",
            "YE" => "Yemen",
            "ZM" => "Zambia",
            "ZW" => "Zimbabwe");

        return $countries;        

    }
}
