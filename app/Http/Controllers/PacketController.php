<?php

namespace App\Http\Controllers;

use App\Packet;
use Illuminate\Http\Response;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;

use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Redirect;


class PacketController extends Controller
{

    public function index(){
        $packets = Packet::all();
        return view('admin.packets',['packets' => $packets]);
    }

    public function destroy($id){

        Packet::destroy($id);
        return redirect('/admin/packets');
    }

    public function newPacket(){
        return view('admin.new');
    }

    public function add() {

        $file = Request::file('file');
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename().'.'.$extension,  File::get($file));

        $entry = new \App\File();
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getFilename().'.'.$extension;

        $entry->save();

        $packet  = new Packet();
        $packet->file_id=$entry->id;
        $packet->name =Request::input('name');
        $packet->description =Request::input('description');
        $packet->price =Request::input('price');
        $packet->imageurl =Request::input('imageurl');

        $packet->save();

        return redirect('/admin/packets');
    }

    public function search(Request $request){
        $cari = Request::input('search');
               
        $packetss = Packet::where('name', 'LIKE', '%'.$cari.'%')->get();
        if(!empty($packetss)){
            return view('main.index',compact('packetss'));
        }
        else{
            return redirect()->back();
}
        
        
        
    }


    

    
    
}
