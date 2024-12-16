<?php

namespace App\Shipping;

use Illuminate\Support\Facades\Log;

class Aramex
{

    protected $api_shipping_url;
    protected $api_location_url;
    protected $api_tracking_url;
    protected $api_cancel_url;
    protected $is_exp = "SA";

    public function __construct()
    {
        if (env("ARAMEX_ENV_TEST") == true) {
            $this->api_shipping_url = 'https://ws.dev.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc?wsdl';
            $this->api_location_url = 'https://ws.dev.aramex.net/ShippingAPI.V2/Location/Service_1_0.svc?wsdl';
            $this->api_tracking_url = 'https://ws.dev.aramex.net/ShippingAPI.V2/Tracking/Service_1_0.svc?wsdl';
            $this->api_cancel_url = 'https://ws.dev.aramex.net/shippingapi.v2/shipping/service_1_0.svc?wsdl';
        } else {
            $this->api_shipping_url = 'https://ws.aramex.net/ShippingAPI.V2/Shipping/Service_1_0.svc?wsdl';
            $this->api_location_url = 'https://ws.aramex.net/ShippingAPI.V2/Location/Service_1_0.svc?wsdl';
            $this->api_tracking_url = 'https://ws.aramex.net/ShippingAPI.V2/Tracking/Service_1_0.svc?wsdl';
            $this->api_cancel_url = 'https://ws.dev.aramex.net/shippingapi.v2/shipping/service_1_0.svc?wsdl';
        }
    }
    public function fetchCities()
    {
        $params = [
            'ClientInfo' => $this->_getClientInfo(),
            'CountryCode' => "SA"
        ];

        $result = [];

        try {
            $soapClient = new \SoapClient($this->api_location_url);
            $response = $soapClient->FetchCities($params);
            if ($response->HasErrors) {
                $result = [
                    'status' => 0,
                    'params' => $params,
                    'response' => $response,
                ];
            } else {
                if (is_array($response->Cities->string)) {
                    $x = $response->Cities->string;
                } else {
                    $x = [$response->Cities->string];
                }
                $result = [
                    'status' => 1,
                    'cities' => $x,
                ];
            }
        } catch (\Throwable $th) {
            $result = [
                'status' => 0,
                'code' => $th->getCode(),
                'message' => $th->getMessage(),
            ];
        }

        return $result;
    }
    public function getCities()
    {
        return [
            "Aba Alworood" => "أبا الورود",
            "Abha" => "أبها",
            "Abha Manhal" => "أبها منهل",
            "Abqaiq" => "بقيق",
            "Abu Ajram" => "أبو عجرم",
            "Abu Areish" => "أبو عريش",
            "Ad Dahinah" => "الضاحية",
            "Ad Dubaiyah" => "الذبيية",
            "Addayer" => "الداير ",
            "Adham" => "أضم",
            "Afif" => "عفيف",
            "Aflaj" => "الأفلاج",
            "Ahad Masarha" => "أحد المسارحه",
            "Ahad Rufaidah" => "أحد رفيدة",
            "Ain Dar" => "عين دار",
            "Al Adari" => "العداري",
            "Al Ais" => "العيس",
            "Al Ajfar" => "الأجفار",
            "Al Ammarah" => "العمارة",
            "Al Ardah" => "العارضة",
            "Al Arja" => "العرجاء",
            "Al Asyah" => "العسية",
            "Al Bada" => "البدع",
            "Al Bashayer" => "البشائر",
            "Al Batra" => "البترا",
            "Al Bijadyah" => "البجادية",
            "Al Dalemya" => "الدالمية",
            "Al Fuwaileq" => "الفويلق",
            "Al hait" => "الحائط",
            "Al Haith" => "الحيث",
            "Al Hassa" => "الأحساء",
            "Al Hayathem" => "الهياثم",
            "Al Hufayyirah" => "الحفيرة",
            "Al Hulayfah As Sufla" => "الحليفة السفلى",
            "Al Idabi" => "العيدابي",
            "Al Khishaybi" => "الخشيبي",
            "Al Khitah" => "الخيط",
            "Al Laqayit" => "اللقيت",
            "Al Mada" => "المدى",
            "Al Mahani" => "المهاني",
            "Al Mahd" => "المهد",
            "Al Midrij" => "المدريج",
            "Al Moya" => "المويا",
            "Al Qarin" => "القرين",
            "Al Uwayqilah" => "العويقيله",
            "Al Wasayta" => "الوصيطة",
            "Al-Jsh" => "الجش",
            "Alghat" => "الغاط",
            "Alhada" => "الهدا",
            "Alnabhanya" => "النبهانية",
            "Alrass" => "الرس",
            "Amaq" => "أعماق",
            "An Nabk Abu Qasr" => "النبك أبو قصر",
            "An Nafiah" => "النافيه",
            "An Nuqrah" => "النقرة",
            "Anak" => "عنك",
            "Aqiq" => "عقيق",
            "Aqool" => "عقول",
            "Ar Radifah" => "الرديفه",
            "Ar Rafi'ah" => "الرافعة",
            "Ar Rishawiyah" => "الريشاوية",
            "Arar" => "عرعر",
            "Artawiah" => "أرطاوية",
            "As Sulaimaniyah" => "السليمانية",
            "As Sulubiayh" => " السلوبية",
            "Asfan" => "عسفان",
            "Ash Shaara" => "الشعراء",
            "Ash Shamli" => "الشملي",
            "Ash Shananah" => "آش شناناه",
            "Ash Shimasiyah" => "الشيميسية",
            "Ash Shuqaiq" => "الشقيق",
            "Asheirah" => "العشيرة",
            "At Tuwayr" => "الطوير",
            "Atawleh" => "الأطاوله",
            "Ath Thybiyah" => "الذيبيه  ",
            "Awamiah" => "العوامية",
            "Ayn Fuhayd" => "عين فهيد",
            "Badaya" => "البدايع",
            "Bader" => "بدر",
            "Badr Al Janoub" => "بدر الجنوب",
            "Baha" => "الباحه",
            "Bahara" => "بحرة",
            "Bahr Abu Sukaynah" => "بحر أبو سكينة",
            "Bahrat Al Moujoud" => "بحرة المجود",
            "Balahmar" => "بالحمر",
            "Balasmar" => "بالسمر",
            "Balqarn" => "بلقرن",
            "Baqa Ash Sharqiyah" => "بقعه الشرقية",
            "Baqaa" => "البقعة",
            "Baqiq" => "بقيق",
            "Bareq" => "باريق",
            "Batha" => "بطحاء",
            "Biljurashi" => "بلجرشي",
            "Birk" => "البرك",
            "Bish " => "بيش",
            "Bisha" => "بيشة",
            "Bukeiriah" => "البكيرية",
            "Buraidah" => "بريدة",
            "Daelim" => "ديلم",
            "Damad" => "ضمد",
            "Dammam" => "الدمام",
            "Darb" => "درب",
            "Dariyah" => "ضريه",
            "Dawadmi" => "الدوادمي",
            "Deraab" => "ديراب",
            "Dere'Iyeh" => "الدرعيه",
            "Dhahban" => "ذهبان",
            "Dhahran" => "الظهران",
            "Dhahran Al Janoob" => "ظهران الجنوب",
            "Dhurma" => "دورما",
            "Domat Al Jandal" => "دومات الجندل",
            "Duba" => "ضبا",
            "Duhknah" => "دخنه",
            "Dulay Rachid" => "دولاي راشد",
            "Dulay Rashid" => "ضليع رشيد",
            "Farasan" => "فرسان",
            "Ghazalah" => "غزالة",
            "Ghtai" => "غتاي",
            "Gilwa" => "قلوة",
            "Gizan" => "جازان",
            "Hadeethah" => "حديثة",
            "Hafer Al Batin" => "حفر الباطن",
            "Hail" => "حائل",
            "Halat Ammar" => "حاله عمار",
            "Hali" => "حلي",
            "Haqil" => "حقل",
            "Harad" => "حرض",
            "Harajah" => "حرجه",
            "Hareeq" => "حريق",
            "Hawea/Taif" => "الحويه/الطائف",
            "Haweyah" => "الحوية",
            "Hawtat Bani Tamim" => "حوطة بني تميم",
            "Hazm Al Jalamid" => "حزم الجلميد",
            "Hedeb" => "حدب",
            "Hinakeya" => "الحناكيه",
            "Hofuf" => "الهفوف",
            "Horaimal" => "حوريملا",
            "Hotat Sudair" => "حوطة سدير",
            "Hubuna" => "هبونا",
            "Huraymala" => "حوريملا",
            "Ja'Araneh" => "جعرانه",
            "Jafar" => "جفر",
            "Jalajel" => "جلجل",
            "Jeddah" => "جدة",
            "Jouf" => "الجوف",
            "Jubail" => "الجبيل",
            "Al Jumum" => "الجموم",
            "Kahlah" => "كهلة",
            "Kara" => "كارا",
            "Kara'A" => "كراء",
            "Karboos" => "كربوس",
            "Khafji" => "الخفجي",
            "Khaibar" => "خيبر",
            "Khairan" => "خيران",
            "Khamaseen" => "خماسين",
            "Khamis Mushait" => "خميس مشيط",
            "Kharj" => "الخرج",
            "Khasawyah" => "الخصاوية",
            "Khobar" => "الخبر",
            "Khodaria" => "خوداريا",
            "Khulais" => "خليص",
            "Khurma" => "خورما",
            "King Abdullah Economic City" => "مدينة الملك عبدالله الاقتصادية",
            "King Khalid Military City" => "مدينة الملك خالد العسكرية",
            "Kubadah" => "كبادة",
            "Laith" => "الليث",
            "Layla" => "ليلى",
            "Madinah" => "المدينة المنورة",
            "Mahad Al Dahab" => "مهد الدهب",
            "Majarda" => "مجارده",
            "Majma" => "مجمعة",
            "Makkah" => "مكة المكرمة",
            "Mandak" => "مندق ",
            "Mastura" => "مستورة",
            "Mawqaq" => "موق",
            "Midinhab" => "ميدينهاب",
            "Mikhwa" => "المخواه",
            "Mohayel Aseer" => "محايل عسير",
            "Moqaq" => "موقاق",
            "Mrat" => "مرات",
            "Mubaraz" => "مبرز",
            "Mubayid" => "مبيد",
            "Mulaija" => "المليجة",
            "Mulayh" => "مليح",
            "Munifat Al Qaid" => "منيفات القايد",
            "Muthaleif" => "المظيليف",
            "Muzahmiah" => "المزاحمية",
            "Muzneb" => "المذنب",
            "Nabiya" => "نبية",
            "Najran" => "نجران",
            "Namas" => "النماص",
            "Neom" => "نيوم",
            "Al Khurmah" => "الخرمه",
            "New Muwayh" => "المويه الجديد",
            "Nimra" => "نمرة",
            "Nisab" => "نساب",
            "Noweirieh" => "النعيريه",
            "Nwariah" => "النوريه",
            "Ojam" => "أوجام",
            "Onaiza" => "عنيزة",
            "Othmanyah" => "العثمانية",
            "Oula" => "العلا",
            "Oyaynah" => "العيينا",
            "Oyoon Al Jawa" => "عيون الجوة",
            "Qahmah" => "قهمة",
            "Qana" => "قنا",
            "Qarah" => "قره",
            "Qariya Al Olaya" => "قارية العليا",
            "Qasab" => "قصب",
            "Qassim" => "القصيم",
            "Qatif" => "القطيف",
            "Qaysoomah" => "قيصومه",
            "Qbah" => "قبه",
            "Qouz" => "قوز",
            "Qufar" => "القفار",
            "Qunfudah" => "القنفذة",
            "Qurayat" => "القريات",
            "Qusayba" => "قصيبة",
            "Quwei'Ieh" => "القويعيه",
            "Rabigh" => "رابغ",
            "Rafha" => "رفحاء",
            "Rahima" => "رحيمة",
            "Rania" => "رنيه",
            "Ras Al Kheir" => "رأس الخير",
            "Ras Baridi" => "راس بريدي",
            "Ras Tanura" => "رأس تنورة",
            "Rawdat Habbas" => "روضة حباس",
            "Rejal Alma'A" => "رجال ألمع",
            "Remah" => "رماح",
            "Riyadh" => "الرياض",
            "Riyadh Al Khabra" => "رياض الخبرة",
            "Rowdat Sodair" => "روضه سدير",
            "Rvaya Aljamsh" => "رفايع الجمش",
            "Rwaydah" => "الرويضه",
            "Sabt El Alaya" => "سبت العلايا",
            "Sabya" => "صبيا",
            "Sadal Malik" => "سادال مالك",
            "Sadyan" => "ساديان",
            "Safanyah" => "السفانية",
            "Safwa" => "صفوة",
            "Sahna" => "صحنا",
            "Sajir" => "ساجر",
            "Sakaka" => "سكاكا",
            "Salbookh" => "صلبوخ",
            "Salwa" => "سلوى",
            "Samakh" => "سماخ",
            "Samtah " => "صامطة",
            "Saqf" => "سقف",
            "Sarar" => "سعار",
            "Sarat Obeida" => "سارات عبيدة",
            "Satorp" => "ساتورب",
            "Seihat" => "سيهات",
            "Shaqra" => "شقراء",
            "Shari" => "الشريعة",
            "Sharourah" => "شرورة",
            "Shefa'A" => "شفاء",
            "Shinanh" => "الشنانه",
            "Shoaiba" => "الشعيبة",
            "Shraie'E" => "الشرايع",
            "Shumeisi" => "الشميسي",
            "Shumran" => "شمران",
            "Siir" => "سيير",
            "Simira" => "سيميرا",
            "Subheka" => "صبحيكا",
            "Sulaiyl" => "السليل",
            "Suwayr" => "السوير",
            "Tablah" => "طبلة",
            "Tabrjal" => "طبرجل",
            "Tabuk" => "تبوك",
            "Taiba" => "طيبة",
            "Taif" => "الطائف",
            "Tanda" => "تاندا",
            "Tanjeeb" => "طنجيب",
            "Tanuma" => "تانوما",
            "Tanumah" => "تنومة",
            "Tereeb" => "طريب",
            "Tarut" => "تاروت",
            "Tatleeth" => "التثليث",
            "Tayma" => "تيماء",
            "Tebrak" => "تبراك",
            "Thabya" => "ذبية",
            "Thadek" => "ثادق ",
            "Tharmada" => "ثرمادا",
            "Thebea" => "طيبة",
            "Tamir" => "تمير",
            "Thuqba" => "الثقابة",
            "Towal" => "الطوال",
            "Turaib" => "طريب",
            "Turaif" => "طريف",
            "Turba" => "تربة",
            "Tuwaim" => "توييم",
            "Udhaliyah" => "الوذالية",
            "Um Aljamajim" => "أم الجماجم",
            "Umluj" => "أملج",
            "Uqlat Al Suqur" => "عقبة الصقور",
            "Ushayqir" => "اوشيقر",
            "Uyun" => "العيون",
            "Wadeien" => "الواديين",
            "Wadi Bin Hasbal" => "وادي بن هشبل",
            "Wadi El Dwaser" => "وادي الدواسر",
            "Wadi Faraah" => "وادي فرح",
            "Wadi Fatmah" => "وادي فاطمة",
            "Wajeh (Al Wajh)" => "الوجيه (الوجه)",
            "Waly Al Ahd" => "والي العهد",
            "Yanbu" => "ينبع",
            "Yanbu Al Baher" => "ينبع البحر",
            "Yanbu Nakhil" => "ينبع النخل",
            "Yuthma" => "اليتما",
            "Zahban " => "ذهبان",
            "Zallum" => "ظلم",
            "Zulfi" => "الزلفي"
        ];
        $params = [
            'ClientInfo' => $this->_getClientInfo(),
            'CountryCode' => "SA"
        ];

        $result = [];

        try {
            $soapClient = new \SoapClient($this->api_location_url);
            $response = $soapClient->FetchCities($params);
            if ($response->HasErrors) {
                $result = [
                    'status' => 0,
                    'params' => $params,
                    'response' => $response,
                ];
            } else {
                if (is_array($response->Cities->string)) {
                    $x = $response->Cities->string;
                } else {
                    $x = [$response->Cities->string];
                }
                $result = [
                    'status' => 1,
                    'cities' => $x,
                ];
            }
        } catch (\Throwable $th) {
            $result = [
                'status' => 0,
                'code' => $th->getCode(),
                'message' => $th->getMessage(),
            ];
        }

        return $result;
    }

    public function getTrackShipmentsTest($id) {

        $params = [
            'ClientInfo' => $this->_getClientInfo(),
            'GetLastTrackingUpdateOnly' => '1',
		    'Shipments'				=> array($id)
        ];

        $results = [];

    	try {
    	    $soapClient = new \SoapClient($this->api_tracking_url);

    		$response = $soapClient->TrackShipments($params);


    		if ($response->HasErrors) {
    		    $results = "Error";
    		}else{

    		$results = $response->TrackingResults->KeyValueOfstringArrayOfTrackingResultmFAkxlpY->Value->TrackingResult;
    		//dd($results);
    		}
    	} catch (SoapFault $fault) {
    		$results = "Error";
    	}

        return $results;
    }
    public function getTrackShipments($id) {

        $params = [
            'ClientInfo' => $this->_getClientInfo(),
            'GetLastTrackingUpdateOnly' => '1',
		    'Shipments'				=> array($id)
        ];

        $results = [];

    	try {
    	    $soapClient = new \SoapClient($this->api_tracking_url);

    		$response = $soapClient->TrackShipments($params);

    		if ($response->HasErrors) {
    		    $results = "Error";
    		}else{

    		$results = $response->TrackingResults->KeyValueOfstringArrayOfTrackingResultmFAkxlpY->Value->TrackingResult->UpdateDescription;

    		}
    	} catch (SoapFault $fault) {
    		$results = "Error";
    	}

        return $results;
    }

    public function getTrackUrl($awb)
    {
        return "https://www.aramex.com/track/results?ShipmentNumber=" . $awb;
    }

    public function _getClientInfo()
    {
        return [
            'UserName' => "g.wx.990@gmail.com",
            'Password' => "Com@0099",
            'AccountNumber' => "60532689",
            'AccountPin' => "442542",
            'AccountEntity' => "JED",
            'AccountCountryCode' => "SA",
            'Version' => "1.0",
            'Source' => 0,
        ];
    }

    public function _getStoreData($data)
    {
        return [
            'Reference1' => $data->id,
            "Reference2" => '',
            'AccountNumber' => $this->_getClientInfo()["AccountNumber"],
            'PartyAddress' => [
                'Line1' => $data->store["address_name"],
                'Line2' => '',
                'Line3' => '',
                'country_code' => "SA",
                'City' => $data->store["city"],
                'StateOrProvinceCode' => $data->store["city"], // CITY,
                'PostCode' => "35419",
                'CountryCode' => "SA",
            ],
            'Contact' => [
                'Department' => '',
                'PersonName' => $data->store['name'],
                'Title' => '',
                'CompanyName' => $data->user->store_name,
                'PhoneNumber1' => $data->store['phone'],
                'PhoneNumber1Ext' => '',
                'PhoneNumber2' => '',
                'PhoneNumber2Ext' => '',
                'FaxNumber' => '',
                'CellPhone' => $data->store['phone'],
                'EmailAddress' => $data->store['email'],
                'Type' => '',
            ],
        ];
    }

    public function _getCustomerData($data)
    {
        return [
            'Reference1' => $data->id,
            "Reference2" => '',
            'AccountNumber' => '',
            'PartyAddress' => [
                'Line1' => $data->customer['address_name'],
                'Line2' => '',
                'Line3' => '',
                'country_code' => "SA",
                'City' => $data->customer['city'],
                'StateOrProvinceCode' => $data->customer['city'],
                'PostCode' => "35419",
                'CountryCode' => "SA",
            ],
            'Contact' => [
                'Department' => '',
                'PersonName' => $data->customer['name'],
                'Title' => '',
                'CompanyName' => $data->customer['name'],
                'PhoneNumber1' => $data->customer['phone'],
                'PhoneNumber1Ext' => '',
                'PhoneNumber2' => '',
                'PhoneNumber2Ext' => '',
                'FaxNumber' => '',
                'CellPhone' => $data->customer['phone1'] ?? 0,
                'EmailAddress' => $data->store['email'],
                'Type' => '',
            ],
        ];
    }

    public function _getShipmentDetails($data)
    {
        if($data->cod_price >= 0){
            $cod_price = $data->cod_price;

        }else{
            $cod_price = 0;
        }
        $items[] = [
            'PackageType' => 'Box',
            'Quantity' => 2,
            'Reference' => 1,
            'Weight' => [
                'Unit' => "kg",
                'Value' => $data->weight ?? 0,
            ]
        ];

        return [
            'ActualWeight' => [
                'Unit' => "kg",
                'Value' => $data->weight ?? 0,
            ],
            'CustomsValueAmount' => [
                'CurrencyCode' => "SAR",
                'Value' => '',
            ],
            'CashOnDeliveryAmount' => [
                'CurrencyCode' => "SAR",
                'Value' => $cod_price,
            ],
            'Dimensions' => [
                'Length' => 0,
                'Width' => 0,
                'Height' => 0,
                'Unit' => 'cm',
            ],
            'Items' => $items,
            'DescriptionOfGoods' => $data->description,
            'GoodsOriginCountry' => $data->store["city"],
            'NumberOfPieces' => $data->pcs ?? 1,
            // "number_of_pieces"=> $data->pcs ?? 1,
            'PaymentOptions' => '',
            'PaymentType' => '3',
            'ProductGroup' => 'DOM',
            'ProductType' => 'CDS',
            'Services' => $data['is_cod'] ? 'CODS' : ''
        ];
    }

    /*
        order_id,
        customer_id,
        courier_name,
        items_ids,
        items_weights,
        customer_name,
        customer_email,
        phone,
        country,
        country_code,
        city,
        customer_address,
        customer_postcode,
        NumberOfPieces,
        is_cod,
        cod_value,
        currency,
        weight,
        weight_class,
        DescriptionOfGoods
    */

    public function createShipment($data)
    {

        $params = [
            'ClientInfo' => $this->_getClientInfo(),
            'Shipments' => [
                [
                    'Shipper' => $this->_getStoreData($data),
                    'Consignee' => $this->_getCustomerData($data),
                    'ThirdParty' => $this->_getStoreData($data),
                    'Details' => $this->_getShipmentDetails($data),
                    'ShippingDateTime' => time(),
                    'DueDate' => time() + (7 * 24 * 60 * 60),
                    'Comments' => '',
                    "PickupGUID" => '',
                    'PickupLocation' => 'Reception',
                    'TransportType' => 0,
                    'Reference1' => $data->id,
                    "Reference2" => '',
                    "Reference3" => '',
                    "ForeignHAWB" => '',
                    "AccountingInstrcutions" => '',
                    "OperationsInstructions" => '',
                ]
            ],
            'LabelInfo' => [
                'ReportID' => '9729',
                'ReportType' => 'URL',
            ]
        ];

        try {
            $soapClient = new \SoapClient($this->api_shipping_url);
            $response = $soapClient->CreateShipments($params);
             //dd($response);
            if ($response->HasErrors) {
                $result['status'] = 'api_error';
                $result['awb'] = '';
                $result['message'] = $response->Notifications->Notification->Message ?? $response->Shipments->ProcessedShipment->Notifications->Notification->Message;
                $result['response'] = $response;
            } else {
                $result['status'] = 'success';
                $result['awb'] = $response->Shipments->ProcessedShipment->ID;
                $result['message'] = 'created';
                $result['response'] = $response;
            }
        } catch (\Throwable $th) {
            $result['status'] = 'api_error';
            $result['awb'] = '';
            $result['message'] = $th->getMessage();
            $result['response'] = $th->getCode();
        }

        return $result;
    }

    private function savePdf($awb, $url)
    {
        $directory = public_path("shipments/aramex");
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        $file_path = $directory . '/' . $awb . '.pdf';
        $data = file_get_contents($url);
        $result = file_put_contents($file_path, $data);
        return $file_path;
    }

    public function getPdf($awb)
    {
        $params = [
            'ClientInfo' => $this->_getClientInfo(),
            'ShipmentNumber' => $awb,
            'LabelInfo' => [
                'ReportID' => '9729',
                'ReportType' => 'URL',
            ]
        ];

        try {
            $soapClient = new \SoapClient($this->api_shipping_url);
            $response = $soapClient->PrintLabel($params);
              //dd($response,$awb);
            if ($response->HasErrors) {
                $result['status'] = 'api_error';
                $result['message'] = $response->Notifications->Notification->Message ?? $response->Shipments->ProcessedShipment->Notifications->Notification->Message;
                $result['response'] = $response;
            } else {
                $result['status'] = 'success';
                $result['pdf'] = $this->savePdf($awb, $response->ShipmentLabel->LabelURL);
            }
        } catch (\Throwable $th) {
            $response['status'] = 'error';
            $response['message'] = 'There was something wrong';
        }

        return $response;
    }
    public function cancelShipment($awb)
    {
        $params = [
            'ClientInfo' => $this->_getClientInfo(),
            'PickupGUID' => $awb,
            'Comments' => "Made by mistake"
        ];

        try {
            $soapClient = new \SoapClient($this->api_cancel_url);
            $response = $soapClient->CancelPickup($params);
            dd($response);
            if ($response->HasErrors) {
                $result['status'] = 'api_error';
                $result['message'] = $response->Message;
            } else {
                $result['status'] = 'success';
                $result['message'] = 'Canceled';
            }
        } catch (\Throwable $th) {
            $result['status'] = 'error';
            $result['message'] = 'There was something wrong';
        }
        dd($response);
        return $result;
    }

}
