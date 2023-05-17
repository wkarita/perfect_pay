<?php

namespace App\Http\Controllers;

use App\Facades\ApiBilling;
use App\Http\Requests\StoreBillingRequest;
use App\Http\Resources\BillingsResource;
use App\Models\Billing;
use App\Traits\HttpResponses;
use PDO;

class BillingController extends Controller
{

    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = ApiBilling::get('v3/payments')->json();
        return BillingsResource::collection($clients['data']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBillingRequest $request)
    {
        $request->validated($request->all());

        try {
            
            if($request->billingType <> 'CREDIT_CARD'){
                $formData = [
                    'customer' => $request->customer,
                    'billingType' => $request->billingType,
                    'dueDate' => $request->dueDate,
                    'value' => $request->value,
                ];
            } else{

                $cardExpiry = explode("/",$request->expiryDate);
                $formData = [
                    'customer' => $request->customer,
                    'billingType' => $request->billingType,
                    'dueDate' => $request->dueDate,
                    'value' => $request->value,
                    'creditCard' => [
                        'holderName' => $request->holderName,
                        'number' => $request->number,
                        'expiryMonth' => $cardExpiry[0],
                        'expiryYear' => $cardExpiry[1],
                        'ccv' => $request->ccv,
                    ],
                    'creditCardHolderInfo' => [
                        'name' => $request->cardName,
                        'email' => $request->cardEmail, 
                        'cpfCnpj' => $request->cardCpfCnpj,
                        'postalCode' => $request->cardPostalCode,
                        'addressNumber' => $request->cardAddressNumber,
                        'phone' => $request->cardPhone,
                        'remoteIp' => $request->cardIp,
                    ]
                ];
            }

            $client = ApiBilling::post('v3/payments', [
                $formData
            ])->json();
                        
            return new BillingsResource($client);

        } catch (\Throwable $th) {
            return $this->error('', 'Oops! Error. Try again.', 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show($idCustomers)
    {
        try {
            $billings = ApiBilling::get('v3/payments?customer=' . $idCustomers)->json();
            if($billings == null){
                return $this->error('', 'User not found.', 404);
            }
            return BillingsResource::collection($billings['data']);

        } catch (\Throwable $th) {
            return $this->error('', 'Oops! Error. Try again.', 500);
        }
    }

}
