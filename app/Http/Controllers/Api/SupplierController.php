<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Http\Requests\StoreSupplierRequest;
use Error;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::all();

        return $suppliers;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $request)
    {

        $supplier = new Supplier();
        $supplier->document = $request->document;
        $supplier->names = $request->names;
        $supplier->email = $request->email;
        $supplier->date_birth = $request->date_birth;
        $supplier->direction = $request->direction;

        $supplier->save();

        return response()->json([
            "status" => 1,
            "msg" => "Supplier created successfully!",
            "supplier" => $supplier,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);

        if(!$supplier){
            // throw new Error("Supplier not found", 404);
            return response()->json([
                "status" => 0,
                "msg" => "Supplier not found!",
            ], 404);
        }else{
            return response()->json([
                "status" => 1,
                "supplier" => $supplier,
            ], 200);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        if(!$supplier){
            // throw new Error("Supplier not found", 404);
            return response()->json([
                "status" => 0,
                "msg" => "Supplier not found!",
            ], 400);
        }else{

            $supplier->document = $request->document;
            $supplier->names = $request->names;
            $supplier->email = $request->email;
            $supplier->date_birth = $request->date_birth;
            $supplier->status = $request->status;
            $supplier->direction = $request->direction;

            $supplier->save();

            return response()->json([
                "status" => 1,
                "msg" => "Supplier updated successfully!",
                "supplier" => $supplier,
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);

        if(!$supplier){
            // throw new Error("Supplier not found", 404);
            return response()->json([
                "status" => 0,
                "msg" => "Supplier not found!",
            ], 400);
        }else{

            $supplier->delete();

            return response()->json([
                "status" => 1,
                "msg" => "Supplier deleted successfully!",
                "supplier" => $supplier,
            ], 200);
        }


    }
}
