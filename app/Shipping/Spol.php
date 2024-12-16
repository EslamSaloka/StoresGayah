<?php

namespace App\Shipping;

use Illuminate\Support\Facades\Http;

class Spol
{

    protected $TOKEN        = '';
    protected $TOKEN_TYPE   = '';
    // ======================================== //
    protected $pathURI      = '';
    protected $userName     = '';
    protected $CRMAccountId = '';
    protected $password     = '';
    // ======================================== //
    protected $Sender        = [];
    protected $Customer      = [];

    public function __construct()
    {
        $this->pathURI      = env('SPOL_URL');
        $this->userName     = env('SPOL_USERNAME');
        $this->password     = env('SPOL_PASSWORD');
        $this->CRMAccountId = env('SPOL_CRM_ACCOUNT_ID');
        $this->generateToken();
    }

    private function generateToken() {
        $response = Http::asForm()->post($this->pathURI."/token",[
            "grant_type"    => "password",
            "UserName"      => $this->userName,
            "Password"      => $this->password
        ])->json();
        $this->TOKEN        = $response['access_token'];
        $this->TOKEN_TYPE   = $response['token_type'];
    }

    public function setSender($store) {
        $this->Sender = [
            "SenderName"            => $store['name'],
            "SenderMobileNumber"    => $store['phone'],
            "LocationID"            => $store['city'],
            "AddressLine1"          => $store['address_name'],
            "AddressLine2"          => $store['address_name'],
        ];
        return $this;
    }

    public function setCustomer($customer) {
        $this->Customer = [
            "CustomerName"          => $customer['name'] ?? '',
            "CustomerMobileNumber"  => $customer['phone'] ?? '',
            "LocationID"            => $customer['city'],
            "AddressLine1"          => $customer['address_name'] ?? '',
            "AddressLine2"          => $customer['address_name'] ?? '',
        ];
        return $this;
    }

    private function fields($shipping) {
        $data =  [
            "CRMAccountId"=>$this->CRMAccountId,
            "BranchId"=> 0,
            "PickupType"=> 1,
            "RequestTypeId"=> 1,
            "CustomerName"=> $this->Customer['CustomerName'],
            "CustomerMobileNumber"=> $this->Customer['CustomerMobileNumber'],
            "SenderName"=> $this->Sender['SenderName'],
            "SenderMobileNumber"=> $this->Sender['SenderMobileNumber'],
            "Items"=> [
                [
                    "ReferenceId"=> time()."-".$shipping->id,
                    "Barcode"=> null,
                    "PaymentType"=> ($shipping->cod_price != -1) ? 2 : 1,
                    "ContentPrice"=> 0,
                    "ContentDescription"=> $shipping->description,
                    "Weight"=> $shipping->weight,
                    "BoxLength"=> 0,
                    "BoxWidth"=> 0,
                    "BoxHeight"=> 0,
                    "ContentPriceVAT"=> 0,
                    "DeliveryCost"=> 0,
                    "DeliveryCostVAT"=> 0,
                    "TotalAmount"=> ($shipping->cod_price != -1) ? $shipping->cod_price : 0,
                    "CustomerVAT"=> 0,
                    "SaudiPostVAT"=> 0,
                    "PiecesCount"=> $shipping->pcs ?? 1,
                    "SenderAddressDetail"=> [
                        "AddressTypeID"=> "6",
                        "AddressLine1"=> $this->Sender['AddressLine1'],
                        "AddressLine2"=> $this->Sender['AddressLine2'],
                        "LocationID"=> $this->Sender['LocationID']
                    ],
                    "ReceiverAddressDetail"=> [
                        "AddressTypeID"=> "6",
                        "AddressLine1"=> $this->Customer['AddressLine1'],
                        "AddressLine2"=> $this->Customer['AddressLine2'],
                        "LocationID"=> $this->Customer['LocationID']
                    ],
                ]
            ]
        ];

        if($shipping->pcs > 1) {
            $X = $shipping->weight / $shipping->pcs;
            for($i=1;$i <= ($shipping->pcs - 1) ;$i++) {
                $data["Items"][0]['ItemPieces'][] = [
                    "PieceWeight"=> $X,
                    "PiecePrice"=> 0,
                    "PieceDescription"=> $shipping->description
                ];
            }
        }
        return $data;
    }


    public function addShip($shipping) {
        return Http::withToken($this->TOKEN)->post($this->pathURI."/api/CreditSale/AddUPDSPickupDelivery",$this->fields($shipping))->json();
    }

    public function getCities() {
        // $lists = Http::withToken($this->TOKEN)->post($this->pathURI."/api/GIS/GetCitiesByRegion",[])->json();
        // $cities  = [];
        // foreach($lists['Cities'] as $list) {
        //     $cities[$list["Id"]] = $list['Name'];
        // }
        // return $cities;
        return json_decode(file_get_contents(public_path("/cities_list.json")),true);
    }


    public function GetItemEvents($item) {
        return Http::withToken($this->TOKEN)->post($this->pathURI."/api/Tracking/GetItemEvents",[
            "ItemBarCode"   => $item
        ])->json();
    }
}
