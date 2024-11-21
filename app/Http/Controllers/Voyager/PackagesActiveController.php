<?php

namespace App\Http\Controllers\Voyager;

use App\Models\Package;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PackagesActiveController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $is_active = filter_var($request->is_active, FILTER_VALIDATE_BOOLEAN);

        $tool = Package::find($id);
        $tool->is_active = $is_active;
        $tool->save();

        return back();
    }
}
