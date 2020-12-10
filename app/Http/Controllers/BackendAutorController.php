<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use Illuminate\Http\Request;
use App\Http\Requests\EnterpriseCreateRequestChild;
use App\Http\Requests\EnterpriseEditRequest;

class BackendAutorController extends Controller
{
    public function index(Request $request)
    {
        $autores = Autor::all();
        return view('backend.autor.index', ['autores' => $autores]);
    }

    public function paginate(Request $request) 
    {
        $order = ['name'];
        $autores = new Autor();
        $search = $request->Input('search');
        if($search !== null){
            $autores = $autores->where('name', 'like', '%' . $search . '%');
        }
        $orderby = $request->Input('orderby');
        $sort = 'asc';
        if($orderby !== null){
            if(isset($order[$orderby])) {
                $orderby = $order[$orderby];
            } else {
                $orderby = $order[0];
            }
            if($request->input('sort') != null) {
                $sort = $request->Input('sort');
            }
            $autores = $autores->orderby($orderby, $sort);
        }
        $paginationParameters = ['search' => $search, 'orderby' => $orderby, 'sort' => $sort];
        $autores = $autores->orderBy('name', 'asc')->paginate(3)->appends($paginationParameters);
        return view('backend.autores.paginate', array_merge(['autores' => $autores], $paginationParameters));
    }

    public function create()
    {
        return view('backend.autor.create');
    }

    public function createNoticia()
    {
        return view('backend.autor.createnoticia');
    }

    public function store(Request $request)
    {
        $object = new Autor($request->all());
        try {
            $result = $object->save();
        } catch(\Exception $e) {
            $result = 0;
        }
        if($object->id > 0) {
            $response = ['op' => 'create', 'r' => $result, 'id' => $object->id];
            return redirect('backend/autor')->with($response);
        } else {
            return back()->withInput()->with(['error' => 'algo ha fallado']);
        }
    }

    public function show(Autor $autor)
    {
        //$enterprise = Enterprise::find($id);
        return view('backend.autor.show', ['autor' => $autor]);
    }
    
    public function edit(Autor $autor)
    {
        return view('backend.autor.edit', ['autor' => $autor]);
    }

    public function update(Request $request, Autor $autor)
    {
        try {
            $result = $autor->update($request->validated());
        } catch (\Exception $e) {
            $result = 0;
        }
        if($result) {
            $response = ['op'         => 'update',
                            'r'       => $result,
                            'id'      => $autor->id];
            return redirect('backend/autor')->with($response);
        } else {
            return back()->withInput()->withErrors(['name' => 'El nombre del autor ya existe.']);
        }
    }

    public function destroy(Autor $autor)
    {
        $id = $autor->id;
        try {
            $result = $autor->delete();
        } catch(\Exception $e) {
            $result = 0;
        }
        $response = ['op' => 'destroy', 'r' => $result, 'id' => $id];
        return redirect('backend/autor')->with($response);
    }
}
