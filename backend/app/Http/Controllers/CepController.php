<?php

namespace App\Http\Controllers;

use App\Http\Resources\CepsResource;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Http;

class CepController extends Controller
{

    use HttpResponses;

    /**
     * Display the specified resource.
     */
    public function show($cep)
    {
        try {
            $cep = Http::get('https://sandbox.asaas.com/postalCode/validate?postalCode=' . $cep)->json();
            if($cep == null){
                return $this->error('', 'User not found.', 404);
            }
            return new CepsResource($cep['postalCode']);

        } catch (\Throwable $th) {
            return $this->error('', 'Oops! Error. Try again.', 500);
        }
    }

}
