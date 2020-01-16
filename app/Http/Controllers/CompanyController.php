<?php

namespace App\Http\Controllers;

use App\Company;
use Image;
use Illuminate\Http\Request;
use Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return $companies;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $rule = ['upload_file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',];
        $validator = Validator::make($input, $rule);
        if ($validator->fails()) {
            return $validator->fails();
        }
        if ($request->hasFile('company_logo')) {
            $image    = $request->file('company_logo');
            $filename = $request->company_id. '.' . $image->getClientOriginalExtension();
            $path     = 'company_logo/' . $filename;
            Image::make($image)->resize(300, 300)->save($path);
            $image_path = $filename;
        };
        $input['company_logo'] = $image_path;
        $new = Company::create($input);
        return $new;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company = Company::find($id);
        return $company;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $company = Company::where('company_id', $id)->update($request->all());
        return $company;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
