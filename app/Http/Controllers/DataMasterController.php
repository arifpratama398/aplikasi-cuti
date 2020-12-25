<?php

namespace App\Http\Controllers;

use App\Models\Role;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;

class DataMasterController extends Controller 
{
    public function list()
    {
        $tables = DB::select('SHOW TABLES like "ref_%"');
        $detail = [];

        foreach ($tables as $table) {
            foreach ($table as $name) {
                $detail['name'][]  = $name;
                $detail['count'][] = DB::table($name)->count();
            }
        }

        return view('admin.datamaster.list', [
            'records' => $detail
        ]);
    }

    public function detail($table_name)
    {
        $data['data']   = DB::table($table_name)->get();
        $data['fields'] = DB::getSchemaBuilder()->getColumnListing($table_name);

        return view('admin.datamaster.detail', [
            'records'    => $data,
            'table_name' => $table_name
        ]);
    }    

    public function store(Request $request, $table_name)
    {
        $data = $request->all();
        unset($data['_token']);

        $fields = DB::getSchemaBuilder()->getColumnListing($table_name);

        if (in_array('created_at', $fields)) {
            $data['created_at']  = Carbon::now()->toDateTimeString();
            $data['updated_at'] = Carbon::now()->toDateTimeString();
        }

        try {
            DB::table($table_name)->insert($data);

            $message = Auth::user()->name . ' telah menambah data pada table ' . $table_name;
            $link    = route('admin.datamaster.detail', $table_name);

            Session::flash('message', Lang::get('global.save_success'));
            Session::flash('alert-class', 'alert-success');
        } catch (QueryException $e) {
            Session::flash('message', Lang::get('global.save_error'));
            Session::flash('alert-class', 'alert-warning');

            return Redirect::back()->withErrors($e->errorInfo[2]);
        }

        return Redirect::back();
    }    

    public function update(Request $request, $table_name)
    {
        $data = $request->all();
        unset($data['_method']);
        unset($data['_token']);

        $id_array = array_splice($data, 0, 1);
        $id_name  = key($id_array);
        $id_value = reset($id_array);
        $fields   = DB::getSchemaBuilder()->getColumnListing($table_name);

        if (in_array('created_at', $fields)) {
            $data['modified_at'] = Carbon::now()->toDateTimeString();
        }

        try {
            $old_data = DB::table($table_name)
                ->where($id_name, $id_value)
                ->first();

            DB::table($table_name)
                ->where($id_name, $id_value)
                ->update($data);

            $message = Auth::user()->name . ' telah mengupdate data pada table ' . $table_name;
            $link    = route('admin.datamaster.detail', $table_name);

            $new_data = DB::table($table_name)
                ->where($id_name, $id_value)
                ->first();

            Session::flash('message', Lang::get('global.save_success'));
            Session::flash('alert-class', 'alert-success');
        } catch (QueryException $e) {
            Session::flash('message', Lang::get('global.save_error'));
            Session::flash('alert-class', 'alert-warning');

            return Redirect::back()->withErrors($e->errorInfo[2]);
        }

        return Redirect::back();
    }

    public function destroy(Request $request, $table_name)
    {
        $data = $request->all();
        unset($data['_method']);
        unset($data['_token']);

        $junction_tables = ['ref_tipe_jenis_anggaran'];
        $id_array        = array_splice($data, 0, 1);
        $id_name         = key($id_array);
        $id_value        = reset($id_array);

        if (in_array($table_name, $junction_tables)) {
            $second_id_array = array_splice($data, 0, 1);
            $second_id_name  = key($second_id_array);
            $second_id_value = reset($second_id_array);

            try {
                DB::table($table_name)->where($id_name, $id_value)->where($second_id_name, $second_id_value)->delete();

                $message = Auth::user()->name . ' telah menghapus data pada table ' . $table_name;
                $link    = route('admin.datamaster.detail', $table_name);

            } catch (QueryException $e) {
                Session::flash('message', Lang::get('global.save_error'));
                Session::flash('alert-class', 'alert-warning');

                return Redirect::back()->withErrors($e->errorInfo[2]);
            }
        } else {
            try {
                DB::table($table_name)->where($id_name, $id_value)->delete();

                $message = Auth::user()->name . ' telah menghapus data pada table ' . $table_name;
                $link    = route('admin.datamaster.detail', $table_name);

            } catch (QueryException $e) {
                Session::flash('message', Lang::get('global.save_error'));
                Session::flash('alert-class', 'alert-warning');

                return Redirect::back()->withErrors($e->errorInfo[2]);
            }
        }
        Session::flash('message', Lang::get('global.save_success'));
        Session::flash('alert-class', 'alert-success');

        return Redirect::back();
    }

    private function validateForm($request, $model)
    {
        return Validator::make($request->all(), $model->rules);
    }    
}