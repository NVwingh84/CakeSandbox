<?php

namespace App\Controller;

use Cake\Validation\Validator;
use Cake\Event\Event;

class AthletesController extends AppController {

    public function initialize(){

        parent::initialize();

        // what can you do without being logged in.. 
        $this->Auth->allow(['edit']);    

        // $this->Security->requireSecure();     

    }

    public function index(){

        $this->request->allowMethod(['get']);  

        // users not yet connected to roles 
        // debug($this->getRequest()->getSession()->read('Auth'));    

        $all_athletes = $this->Athletes->find('all', array('recursive' => 2));

        $this->set('athletes', $all_athletes);

        // debug($this->request->getParam('action'));  

        
    }   

    public function delete($id){

        // only method needed for delete action is get.. 
        // here you limit what an attacker can do.. 
        $this->request->allowMethod(['get']);        

        $athlete = $this->Athletes->get($id);

        if ($this->Athletes->delete($athlete)) {
            $this->Flash->success(__('The {0} athlete has been deleted.', $athlete->name));
            return $this->redirect(['action' => 'index']);
        }
    }    

    public function edit($id){

        $this->request->allowMethod(['get', 'put']);    

        // set gender options, might need to adapt language... 
        $gender = array( "male" => "m", "female" => "f");      
        $this->set('gender', $gender);

        // set country options 
        $countries = $this->countryOptions();
        $this->set('countries', $countries);        

        $athlete = $this->Athletes->get($id);  
        
        // transform FrozenTime into normal time 
        // would be interesting to automate this centrally 
        $threek_time = $athlete['threek_time']->i18nFormat('HH:mm:ss');
        $fivek_time = $athlete['fivek_time']->i18nFormat('HH:mm:ss');
        $tenk_time = $athlete['tenk_time']->i18nFormat('HH:mm:ss');                

        $athlete_new = $athlete;
        $athlete_new['3K_time'] = $threek_time;
        $athlete_new['5K_time'] = $fivek_time;
        $athlete_new['10K_time'] = $tenk_time;

        // if you are not just landing on page but making the save 
        if ($this->request->is(['post', 'put'])) {
            
            // prepare Athlete entity for saving 
            $this->Athletes->patchEntity($athlete_new, $this->request->getData());

            // Set the user_id from the session.
            $athlete_new->user_id = $this->Auth->user('id');
        
            if ($this->Athletes->save($athlete_new)) {
            
                $this->Flash->success(__('Athlete Profile has been updated.'));
                return $this->redirect(['action' => 'index']);

            }
        
        $this->Flash->error(__('Unable to update athlete profile.'));
        
        }

        // debug($athlete_new);

        $this->set('athlete_pass', $athlete_new);    

    }



    public function add(){

        $this->request->allowMethod(['get', 'post']);   

        // set gender options, might need to adapt language... 
        $gender = array( "male" => "m", "female" => "f");      
        $this->set('gender', $gender);    
        
        // set country options 
        $countries = $this->countryOptions();
        $this->set('countries', $countries);

        // create a new entity in data model 
        $athlete = $this->Athletes->newEntity();

        // if not first time on page, but save made
        if ($this -> request -> is('post')) {

            if ($athlete->getErrors()){

                // Entity failed validation 
                // print_r($event->getErrors());
                $this->Flash->error(__('Please correct values and try again.'));                

            } else {

                // patch data given in form inputs in new entity 
                $athlete_save = $this->Athletes->patchEntity($athlete, $this->request->getData());

                // Set the user_id from the session.
                $athlete->user_id = $this->Auth->user('id');

                if ($this->Athletes->save($athlete_save)) {

                    $this->Flash->success(__('The Athlete Profile has been created.'));
                    $this -> redirect(array('action' => 'index'));

                } else {

                    $this->Flash->error(__('The Athlete Profile could not be created. Please, try again.'));

                }
            } 
        }

        $this->set('athletes', $athlete);

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

