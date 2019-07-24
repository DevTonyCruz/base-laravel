<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sepomex;

class SepomexController extends Controller
{

    public function get_states(Request $request)
    {
        $sepomex = Sepomex::select('state')->groupBy('state')->get();

        if ($sepomex->count() > 0) {

            $response_data["code"] = 200;
            $response_data["msg"] = 'Success';

            return response()->json(["data" => $sepomex])->setStatusCode($response_data["code"], $response_data["msg"]);
        } else {
            $response_data["code"] = 400;
            $response_data["msg"] = 'No existe información';
        }

        return response()->setStatusCode($response_data["code"], $response_data["msg"]);
    }

    public function get_location_by_state(Request $request)
    {
        if ($request->has('state')) {
            $state = $request->state;

            $sepomex = Sepomex::select('location')->where('state', $state)->groupBy('location')->get();

            if ($sepomex->count() > 0) {

                $response_data["code"] = 200;
                $response_data["msg"] = 'Success';

                return response()
                    ->json(["data" => $sepomex])
                    ->setStatusCode($response_data["code"], $response_data["msg"]);
            } else {
                $response_data["code"] = 400;
                $response_data["msg"] = 'No existe información';
            }
        } else {
            $response_data["code"] = 400;
            $response_data["msg"] = 'El estado enviado no es válido';
        }

        return response()
            ->setStatusCode($response_data["code"], $response_data["msg"]);
    }

    public function get_colonies_by_location_state(Request $request)
    {
        if ($request->has('state') && $request->has('location')) {

            $state = $request->state;
            $location = $request->location;

            $sepomex = Sepomex::where('state', $state)->where('location', $location)->select('id', 'name', 'zip_code')->orderBy('name')->get();

            if ($sepomex->count() > 0) {

                $response_data["code"] = 200;
                $response_data["msg"] = 'Success';

                return response()
                    ->json(["data" => $sepomex])
                    ->setStatusCode($response_data["code"], $response_data["msg"]);
            } else {
                $response_data["code"] = 400;
                $response_data["msg"] = 'No existe información';
            }
        } else {
            $response_data["code"] = 400;
            $response_data["msg"] = 'El estado o el municipio enviado no son válidos';
        }

        return response()
            ->setStatusCode($response_data["code"], $response_data["msg"]);
    }

    public function get_zip_code(Request $request)
    {
        if ($request->has('sepomex_id')) {
            $id = $request->sepomex_id;

            $sepomex = Sepomex::where('id', $id)->first();

            if ($sepomex->count() > 0) {

                $response_data["code"] = 200;
                $response_data["msg"] = 'Success';

                return response()
                    ->json(["data" => $sepomex])
                    ->setStatusCode($response_data["code"], $response_data["msg"]);
            } else {
                $response_data["code"] = 400;
                $response_data["msg"] = 'No existe información';
            }
        } else {
            $response_data["code"] = 400;
            $response_data["msg"] = 'El ID del Servicio Postal Mexicano no es válido';
        }

        return response()
            ->setStatusCode($response_data["code"], $response_data["msg"]);
    }

    public function get_search_zip_code(Request $request)
    {
        if ($request->has('zip_code')) {
            $zip_code = $request->zip_code;

            if (is_numeric($zip_code)) {

                $sepomex = Sepomex::where('zip_code', $zip_code)->get();

                if ($sepomex->count() > 0) {

                    $response_data["code"] = 200;
                    $response_data["msg"] = 'Success';

                    return response()
                        ->json(["data" => $sepomex])
                        ->setStatusCode($response_data["code"], $response_data["msg"]);
                } else {
                    $response_data["code"] = 400;
                    $response_data["msg"] = 'No existe información';
                }
            } else {
                $response_data["code"] = 400;
                $response_data["msg"] = 'El código postal debe ser numérico';
            }
        }else{
            $response_data["code"] = 400;
            $response_data["msg"] = 'El código postal enviado no es válido';
        }

        return response()
            ->setStatusCode($response_data["code"], $response_data["msg"]);
    }
}
