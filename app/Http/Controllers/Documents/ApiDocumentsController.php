<?php

namespace App\Http\Controllers\Documents;

use App\Document;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDocument;
use Illuminate\Support\Facades\Storage;

class ApiDocumentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StoreDocument $request)
    {
        if($request->hasFile('file')) {
            $path = $request->file('file')->store('documents'); 
        } else {
            $path = null;
        }
        
        $document = new Document();
        
        $document->name = $request->input('name');
        $document->type = $request->input('type');
        $document->status = $request->input('status');
        $document->sales_order_id = $request->input('salesOrderId');
        $document->path = $path;

        $document->save();

        return response()->json([
            'document' => $document
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $document = Document::findOrFail($id);

        $document->name = $request->input('name');
        $document->type = $request->input('type');
        $document->status = $request->input('status');
        $document->sales_order_id = $request->input('salesOrderId');

        $document->save();

        return response()->json([
            'document' => $document
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doc = Document::findOrFail($id);

        if($doc->path !== null) {
            Storage::delete($doc->path);
        }
        
        $doc->delete();
    }
}
