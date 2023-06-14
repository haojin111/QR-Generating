<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Interis\Response;
use Validator;
use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\Fill;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use App\Models\QrRequest;
/* 
    POST      | qr_request                  | qr_request.store
    GET|HEAD  | qr_request                  | qr_request.index
    GET|HEAD  | qr_request/create           | qr_request.create
    DELETE    | qr_request/{tag}            | qr_request.destroy
    PUT|PATCH | qr_request/{tag}            | qr_request.update
    GET|HEAD  | qr_request/{tag}            | qr_request.show
    GET|HEAD  | qr_request/{tag}/edit       | qr_request.edit 
*/

class QrRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){  
        $qr_requests = QrRequest::get(); 
        return Inertia::render('QrRequest/List', ['qr_requests' => $qr_requests, 'canLogin' => true, 'canRegister' => true]); 
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(){ 
        return Inertia::render('QrRequest/Create');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){ 
        $validator  =   Validator::make($request->all(), array(
                            'title'        => 'required | max:256',
                            'resource'     => 'required | max:256',
                            'type'         => 'required | in:Dynamic,Resource,Remote', 
                            'is_locked'    => 'required | boolean', 
                            'owner'        => 'required | in:User,Pincode,Email', 
                        ));
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        } 

        $qr_request = QrRequest::create($request->all()); 
        return redirect()->Intended('qr_request');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){        
     
        $qr_request = QrRequest::find($id);
        if(!isset($qr_request)){
            abort(404);
        }

        $svg = (new Writer(
            new ImageRenderer(
                new RendererStyle(192, 0, null, null, Fill::uniformColor(new Rgb(255, 255, 255), new Rgb(45, 55, 72))),
                new SvgImageBackEnd
            )
        ))->writeString(route('qrs.edit', $qr_request->id));

        return Inertia::render('QrRequest/Show', ['svg' => trim(substr($svg, strpos($svg, "\n") + 1))]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $qr_request = QrRequest::find($id);
        if(!isset($qr_request)){
            abort(404);
        }
        return Inertia::render('QrRequest/Create', compact('qr_request'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id){
        $validator  =   Validator::make($request->all(), array(
            'title'        => 'required | max:256',
            'resource'     => 'required | max:256',
            'type'         => 'required |in:Dynamic,Resource,remote', 
            'is_locked'    => 'required |in:0:1', 
            'owner'        => 'required |in:User,Pincode,Email address', 
        ));
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator);
        } 
        QrRequest::createOrUpdate([
            'id'    =>   $id
        ], $request->all());
        return redirect()->route('qr_request');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id){
        $qr_request = QrRequest::find($id);
        if(!isset($qr_request)){
            return redirect()->with('error', 'Invalid request');
        }
        $qr_request->delete();
        return redirect()->route('qr_request.index')->with('message', "success");
    }
}
