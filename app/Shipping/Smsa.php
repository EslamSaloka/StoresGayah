<?php

namespace App\Shipping;

use Illuminate\Support\Facades\Http;

class Smsa {

    protected $api_url     = 'http://track.smsaexpress.com/SECOM/SMSAwebService.asmx?WSDL';
    //protected $addShipUrl  = 'https://track.smsaexpress.com/SecomRestWebApi/api/addship';
    protected $addShipUrl  = 'https://track.smsaexpress.com/SecomRestWebApi/api/addShipMps';
    protected $add_track_url  = 'https://track.smsaexpress.com/SecomRestWebApi/api/getTracking';

    protected $sender      = [];
    protected $customer    = [];

    public function __construct() {
        $this->passKey = (env("SMSA_ENV_TEST") == true) ?  'Testing0' : env("SMSA_PASS_KEY");
    }

    public function addShip($shipping) {
        if($shipping->cod_price >= 0){
            $cod_price = $shipping->cod_price;
        }else{
            $cod_price = 0;
        }
        $data = [
            "passkey"       => $this->passKey,
            "refno"         => $shipping->id.time(),
            "weight"        => $shipping->weight,
            "codAmt"        => $cod_price,
            "itemDesc"      => $shipping->description,
            "PCs"           => $shipping->pcs ?? 1,
        ];
        $data = $data+$this->sender+$this->customer+$this->defaultData();
        return Http::withHeaders([
            "Content-Type: application/json",
            "Accept: application/json",
        ])->post($this->addShipUrl, $data)->json();
    }

    public function setSender($sender) {
        $this->sender = [
            "sName"     => $sender["name"],
            "sContact"  => $sender["name"],
            "sAddr1"    => $sender["address_name"],
            "sCity"     => $sender["city"],
            "sPhone"    => $sender["phone"],
        ];
        return $this;
    }

    public function setCustomer($customer) {
        $this->customer = [
            "cName"     => $customer->customer["name"],
            "cCity"     => $customer->customer["city"],
            "cMobile"   => $customer->customer["phone"],
            "cTel1"         => $customer->customer["phone1"] ?? 0,
            "cAddr1"    => $customer->customer["address_name"],
            "cAddr2"    => " ",
            "cEmail"    => $customer->store["email"],
        ];
        return $this;
    }

    private function defaultData() {
        return [
            "sentDate"      => date('Y/m/d'),
            "custVal"       => "0",
            "custCurr"      => "SAR",
            "insrAmt"       => "0",
            "insrCurr"      => "0",
            "sAddr2"        => "",
            "sCntry"        => "SA",
            "prefDelvDate"  => "",
            "gpsPoints"     => "",
            "idNo"          => "",
            "cntry"         => "SA",
            "cZip"          => "",
            "cPOBox"        => "",
            "cTel2"         => "",
            "shipType"      => "DLV",
            "carrValue"     => "0",
            "carrCurr"      => "SAR",
        ];
    }
    public function getWeight($awbNo)
    {

	    $paramts = [
            'awbNo' => $awbNo,
            'passKey' => $this->passKey,
        ];
        $soapClient = Http::withHeaders([
            "Content-Type: application/json",
            "Accept: application/json",
        ])->get($this->add_track_url, $paramts)->json();

        if($soapClient){
            $response = $soapClient['Tracking'][0]['Activity'];
            dd($soapClient);
        }else{
            $response ="";
        }

        return $response;

    }
    public function getStatus($awbNo)
    {

	    $paramts = [
            'awbNo' => $awbNo,
            'passKey' => $this->passKey,
        ];
        $soapClient = Http::withHeaders([
            "Content-Type: application/json",
            "Accept: application/json",
        ])->get($this->add_track_url, $paramts)->json();

        if($soapClient){
            $response = $soapClient['Tracking'][0]['Activity'];

        }else{
            $response ="";
        }

        return $response;

    }

    public function getPdf($awb) {

        header("content-type: application/pdf");
	    $params = [
            'awbNo' => $awb,
            'passKey' => $this->passKey,
        ];
        $soapClient = new \SoapClient($this->api_url);
        $response = $soapClient->getPDF($params);
        die($response->getPDFResult);
        if ($response->getPDFResult) {
            $result['status'] = "success";
            $result['message'] = 'canceled';
            $result['pdf'] = $response->getPDFResult;
        } else {
            $result['status'] = "api_error";
            $result['message'] = "Something went wrong";
        }
        return $result;
    }


    public function cancelShipment($awb) {
        $params = [
            'awbNo' => $awb,
            'passkey' => $this->passKey,
            'reas' => 'Mady by mistake'
        ];

        $soapClient = new \SoapClient($this->api_url);

        $response = $soapClient->cancelShipment($params);

        if ($response->cancelShipmentResult == "Success Cancellation " || $response->cancelShipmentResult == "Success Cancellation") {
            $result['status'] = "success";
            $result['message'] = $response->cancelShipmentResult;
        } else {
            $result['status'] = "api_error";
            $result['message'] = $response->cancelShipmentResult;
        }


        return $result;
    }

    public function gCities() {
        $params = [
            'passkey' => $this->passKey
        ];

        $soapClient = new \SoapClient($this->api_url);

        $response = $soapClient->cities($params);

        return $response;

    }

    public function getCities() {
       return [
            "Abha" => "أبها",
            "Abu Arish" => "أبو عريش ",
            "Afif" => "عفيف",
            "Ahad Al Masarhah" => "أحد المسارحة",
            "Ahad Rafidah" => "أحد رفيدة ",
            "Ain Dar" => "ععين دار",
            "Al Aflaj (Layla)" => "الأفلاج (ليلى)",
            "Al Ahsa" => "الأحساء",
            "Al Aridhah" => "العارضة",
            "Al Ayun" => "العيون",
            "Al Dayer" => "الدائر",
            "Al Edabi" => "العيدابي",
            "Al Jafr" => "الجفر",
            "Al Jouf" => "الجوف",
            "Al Hait" => "الحائط ",
            "Al Ruqi" => "الروقي",
            "Al Qaysumah" => "القيصومة",
            "Al Uwayqilah" => "العويقيلة",
            "Anak" => "عنك",
            "Aqiq" => "العقيق",
            "Arar" => "عرعر",
            "Artawiyah" => " الأرطوية ",
            "At Tuwal" => "الطوال",
            "Wadayne" => "الواديين",
            "Atawlah" => "الأطاولة",
            "Bad" => "البدع",
            "Badar Hunain" => "بدر حنين",
            "Badaya " => "البدائع",
            "Badr" => "بدر",
            "Baha" => "الباحة",
            "Bahrah" => "بحرة",
            "Bahrain Causeway" => "جسر الملك فهد",
            "Baljurashi" => "بلجرشي",
            "Bani Malek " => "بني مالك",
            "Baqaa" => "بقعاء",
            "Bariq" => "بارق",
            "Bashayer" => "البشائر",
            "Batha" => "بطحاء",
            "Baysh" => "بيش",
            "Bellasmar" => "بالسمر ",
            "Bijadiyah" => "بجادية",
            "Bishah" => "بيشة",
            "Birk" => "البرك",
            "Bukayriyah" => "البكيرية",
            "Buqaiq" => "بقيق",
            "Buraydah" => "بريدة",
            "Dammam Airport" => "مطار الدمام",
            "Dammam" => "الدمام",
            "Darb" => "الدرب",
            "Dawmat Al Jandal" => "دومة الجندل",
            "Dhahran Al Janoub" => "ظهران الجنوب",
            "Dhahran" => "الظهران",
            "Dhalim" => "ظلم",
            "Dhamad" => "ضمد",
            "Dhuba" => "ضباء",
            "Dhurma" => "ضرما",
            "Dilam" => "الدلم",
            "Diriyah" => "الدرعية",
            "Dukhnah" => "دخنة",
            "Dulay Rashid" => "ضليع رشيد",
            "Duwadimi" => "الدوادمي",
            "Farasan" => "فرسان",
            "Ghat" => "الغاط",
            "Haditha" => "الحديثة",
            "Hafar Al Baten" => "حفر الباطن",
            "Hail" => "حائل",
            "Haly" => "حلي",
            "Halit Ammar" => "حالة عمار",
            "Hanakiyah" => "الحناكية",
            "Haql" => "حقل",
            "Hareeq" => "الحريق",
            "Hawtat Bani Tamim" => "حوطة بني تميم",
            "Hawtat Sudayr " => "حوطة سدير",
            "Hayer" => "الحاير",
            "Hufuf" => "الهفوف",
            "Huraymila" => "حريملاء",
            "Jadidah Arar" => "جديدة عرعر",
            "Jamoum" => "الجموم",
            "Jash" => "جاش",
            "Jazan" => "جازان",
            "Jeddah Airport" => "مطار جدة",
            "Jeddah" => "جدة",
            "Jubail" => "الجبيل",
            "Kamil" => "الكامل",
            "Khabra" => "الخبراء",
            "Khafji" => "الخفجي",
            "Khamasin" => "الخماسين",
            "Khamis Mushayt" => "خميس مشيط",
            "Kharj" => "الخرج",
            "Khayber" => "خيبر",
            "Khubar" => "الخبر",
            "Khulais" => "خليص",
            "Al Khurmah" => "الخرمه",
            "King Khalid City" => "مدينة الملك خالد",
            "Lith" => "الليث",
            "Madinah" => "المدينة المنورة",
            "Mahd Ad Dhahab" => "مهد الذهب",
            "Majardah" => "المجاردة",
            "Majmaah" => "المجمعة",
            "Makkah" => "مكة المكرمة",
            "Mandaq" => "المندق",
            "Masturah" => "مستورة",
            "Midhnab" => "المذنب",
            "Mubarraz" => "المبرز",
            "Mudhaylif" => "المظيلف",
            "Muhayil" => "محايل عسير",
            "Mukhwah" => "المخواة",
            "Muneefa" => "منيفة",
            "Muwayh" => "المويه",
            "Muzahmiyah" => "المزاحمية",
            "Nabaniya" => "النبانية",
            "Nabhaniah" => "النبهانية",
            "Nairiyah" => "النعيرية",
            "Najran" => "نجران",
            "Namerah"=>"نمرة",
            "Nakeea" => "ناقيع",
            "Namas" => "النماص",
            "Nifi" => "نفي",
            "Qarya Al Uliya" => "قرية العليا",
            "Qaseem Airport" => "مطار القصيم",
            "Qaseem" => "القصيم",
            "Qatif" => "القطيف",
            "Qaysumah" => "القيصومة",
            "Qilwah" => "قلوة",
            "Qunfudhah" => "القنفذة",
            "Qurayyat" => "القريات",
            "Quwayiyah" => "القويعية",
            "Rabigh" => "رابغ",
            "Rafayaa Al Gimsh" => "رفايع الجمش",
            "Rafha" => "رفحاء",
            "Rahima" => "رحيمة",
            "Ranyah" => "رنية",
            "Ras Tannurah" => "رأس تنورة",
            "Rass" => "الرس",
            "Rayn" => "الرين",
            "Rijal Almaa" => "رجال ألمع",
            "Riyadh Airport" => "مطار الرياض",
            "Riyadh Al Khabra" => "رياض الخبراء",
            "Riyadh" => "الرياض",
            "Rumah" => "رماح",
            "Ruwaidah" => "رويدة",
            "Sabya" => "صبيا",
            "Safwa" => "صفوى",
            "Saira" => "سايرا",
            "Sajir" => "ساجر",
            "Salwa" => "سلوى",
            "Samtah" => "صامطة",
            "Sapt Al Alaya" => "سبت العلايا",
            "Sarat Abida" => "سراة عبيدة",
            "Sarrar" => "الصرار",
            "Sayhat" => "سيهات",
            "Sayirah" => "صيرة",
            "Sayl Al Kabir" => "السيل الكبير",
            "Shaibah" => "الشيبة",
            "Shaqra" => "شقراء",
            "Sharourah" => "شرورة",
            "Shedgum" => "شيدغوم",
            "Shuqayq" => "الشقيق",
            "Shumran" => "شمران",
            "Skakah" => "سكاكا",
            "Sulayyil" => "السليل",
            "Tabarjal" => "طبرجل",
            "Tabuk" => "تبوك",
            "Taif" => "الطائف",
            "Taima" => "تيماء",
            "Tanajib" => "تناجيب",
            "Tanumah" => "تنومة",
            "Tarib" => "تارب",
            "Tarut (Darin)" => "تاروت (دارين)",
            "Tathlith" => "تثليث",
            "Tereeb" => "طريب",
            "Thqbah" => "الثقبة",
            "Thuwal" => "ثول",
            "Tamir" => "تمير",
            "Turayf" => "طريف",
            "Turbah (Makkah)" => "تربة (مكة المكرمة)",
            "Turbah" => "تربة",
            "Udhayliyah" => "العضيلية",
            "Ula" => "العلا",
            "Ummlujj" => "أملج",
            "Unayzah" => "عنيزة",
            "Uqlat As Suqur" => "عقلة الصقور",
            "Uthmaniyah" => "العثمانية",
            "Uyun Al Jiwa" => "عيون الجواء",
            "Wadi Al-Dawasir" => "وادي الدواسر",
            "Wadi Bin Hashbal" => "وادي بن هشبل",
            "Wajh" => "الوجه",
            "Yanbu" => "ينبع",
            "Zulfi" => "الزلفي"
        ];
    }

    //added my ahmed-reda
    public function cancelAWB($awb){

        $soapClient = Http::withHeaders([
            'ApiKey' => 'be10b21f63b74ccda5d3dfdd1eab018b',
            'Host' => "app.gayah-express.com",
            "Content-Type: application/json",
            "Accept: application/json",
        ])->post("https://ecomapis.smsaexpress.com/api/c2b/cancel/".$awb)->json();

        return $soapClient;
    }

}
