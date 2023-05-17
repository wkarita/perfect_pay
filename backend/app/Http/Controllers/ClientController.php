<?php

namespace App\Http\Controllers;

use App\Facades\ApiBilling;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Http\Resources\ClientsResource;
use App\Traits\HttpResponses;

class ClientController extends Controller
{

    use HttpResponses;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = ApiBilling::get('v3/customers')->json();
        return ClientsResource::collection($clients['data']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $request->validated($request->all());

        try {
            $clientExistent = ApiBilling::get('v3/customers', [
                'cpfCnpj' => $request->cpfCnpj,
            ])->json();
        } catch (\Throwable $th) {
            return $this->error('', 'Oops! Error. Try again.', 500);
        }
        if(count($clientExistent['data']) === 0){
            try {
               
                $client = ApiBilling::post('v3/customers', [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'mobilePhone' => $request->mobilePhone,
                    'cpfCnpj' => $request->cpfCnpj,
                    'postalCode' => $request->postalCode,
                    'address' => $request->address,
                    'addressNumber' => $request->addressNumber,
                    'complement' => $request->complement,
                    'province' => $request->province,
                    'notificationDisabled' => $request->notificationDisabled,
                    'additionalEmails' => $request->additionalEmails,
                    'municipalInscription' => $request->municipalInscription,
                    'stateInscription' => $request->stateInscription,
                    'observations' => $request->observations,
                ])->json();
                
                return new ClientsResource($client);

            } catch (\Throwable $th) {
                return $this->error('', 'Oops! Error. Try again.', 500);
            }
        }else {
            return $this->error('', 'User already registered', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            if(substr($id, 0, 4) === 'cus_' && strlen($id) === 16){

                $client = ApiBilling::get('v3/customers/' . $id)->json();
                if($client == null){
                    return $this->error('', 'User not found.', 404);
                }
                return new ClientsResource($client);

            }else if(strlen($id) === 14 || strlen($id) === 10 || strlen($id) === 18){
                $id = preg_replace("/[.-]/", "", $id);

                $client = ApiBilling::get('v3/customers?cpfCnpj=' . $id)->json();
                if($client == null){
                    return $this->error('', 'User not found.', 404);
                }
                return ClientsResource::collection($client['data']);

            }else{
                return $this->error('', 'Oops! Error. Try again.', 500);
            }

        } catch (\Throwable $th) {
            return $this->error('', 'Oops! Error. Try again.', 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, UpdateClientRequest $request)
    {

        $request->validated($request->all());

        try {

            $client = ApiBilling::post('v3/customers/'. $id, [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'mobilePhone' => $request->mobilePhone,
                'cpfCnpj' => $request->cpfCnpj,
                'postalCode' => $request->postalCode,
                'address' => $request->address,
                'addressNumber' => $request->addressNumber,
                'complement' => $request->complement,
                'province' => $request->province,
                'notificationDisabled' => $request->notificationDisabled,
                'additionalEmails' => $request->additionalEmails,
                'municipalInscription' => $request->municipalInscription,
                'stateInscription' => $request->stateInscription,
                'observations' => $request->observations,
            ])->json();

            if($client == null){
                return $this->error('', 'User not found.', 404);
            }
            
            return new ClientsResource($client);

        } catch (\Throwable $th) {
            return $this->error('', 'Oops! Error. Try again.', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $client = ApiBilling::delete('v3/customers/' . $id)->json();
            
            if($client == null){
                return $this->error('', 'User not found.', 404);
            }

        } catch (\Throwable $th) {
            return $this->error('', 'Oops! Error. Try again.', 500);
        }
    }
}
