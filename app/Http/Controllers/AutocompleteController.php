<?php

namespace App\Http\Controllers;

use App\Models\RefAgama;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AutocompleteController extends Controller 
{   

    private function makeResponse($query, $count = 10)
    {
        $records  = $query->take($count)->get();
        $response = array();

        foreach ($records as $index => $record) {
            $response[$index]        = new \stdClass();
            $response[$index]->id    = (string)$record->id;
            $response[$index]->name  = $record->name;
        }

        return json_encode($response);

    }    
    public function agama(Request $request)
    {
        $term  = $request->get('term', '');
        $query = RefAgama::select('id', 'name')
            ->where('name', 'like', '%' . $term . '%');

        return $this->makeResponse($query);
    }

}
