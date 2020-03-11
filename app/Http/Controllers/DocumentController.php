<?php

namespace App\Http\Controllers;

use App\Document;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DocumentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function add(){

        $users = User::all();
        return view('document.add',['users' => $users]);

    }

    public function index()
    {
        $documents = Document::all();
        return view('document.list',['documents' => $documents]);
    }


    public function store(Request $request){

        $request->validate([
            'titulo' => 'required|max:100',
            'usuario' => 'required',
            'archivo' => 'required|mimes:pdf'
        ]);

        $document = new Document();
        $document->tittle = $request->input('titulo');
        $document->user_id = $request->input('usuario');
        if($request->hasFile('archivo')){
            $path = $request->file('archivo')->store('public');
            $document->url = $path;
        }
        //$document->users()->associate(User::findOrFail($document->user_id));

        if($document->save()){
            return redirect()->back()->with('message', 'Documento actualizado correctamente !!');
        } 

    }


    public function show($id)
    {
        return view('document.edit',['document' => Document::with('users')->findOrFail($id),'users' => User::all()]);
    }



    public function update(Request $request)
    {

        $request->validate([
            'titulo' => 'required|max:100',
            'usuario' => 'required',
            'archivo' => 'mimes:pdf'
        ]);

        $document = Document::findOrFail($request->input('id'));
        $document->tittle = $request->input('titulo');
        $document->user_id = $request->input('usuario');
        if($request->hasFile('archivo')){
            $path = $request->file('archivo')->store('public');
            $document->url = $path;
        }
        //$document->users()->associate(User::findOrFail($document->user_id));

        if($document->save()){
            return redirect()->back()->with('message', 'Documento actualizado correctamente !!');
        } 

    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        if($document->delete()){
            return redirect()->back()->with('messageDelete', 'El documento ha sido Eliminado !!');
        }
    }

    public function userAddDocument(){
        return view ('user.normal.addDocument');
    }

    public function addDocument(Request $request){

        $request->validate([
            'titulo' => 'required|max:100',
            'archivo' => 'required|mimes:pdf'
        ]);

        $document = new Document();
        $document->tittle = $request->input('titulo');
        $document->user_id = auth()->user()->id;
        if($request->hasFile('archivo')){
            $path = $request->file('archivo')->store('public');
            $document->url = $path;
        }
        //$document->users()->associate(User::findOrFail($document->user_id));

        if($document->save()){
            return redirect()->back()->with('message', 'Documento creado correctamente !!');
        }
    }

    public function listMyDocuments(){

        $documentfromuser = User::with('documents')->findOrFail(auth()->user()->id);
        return view('user.normal.listDocument',['documents' => $documentfromuser]);
    }


    public function showDocument($id)
    {
        return view('user.normal.editDocument',['document' => Document::findOrFail($id)]);
    }

    public function updateDocument(Request $request){

        $request->validate([
            'titulo' => 'required|max:100',
            'archivo' => 'mimes:pdf'
        ]);

        $document = Document::findOrFail($request->input('id'));
        $document->tittle = $request->input('titulo');
        if($request->hasFile('archivo')){
            $path = $request->file('archivo')->store('public');
            $document->url = $path;
        }
        //$document->users()->associate(User::findOrFail($document->user_id));

        if($document->save()){
            return redirect()->back()->with('message', 'Documento actualizado correctamente !!');
        } 

    }


}
