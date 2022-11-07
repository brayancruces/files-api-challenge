<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\File;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFileRequest;
use App\Http\Requests\DeleteFileRequest;
use App\Http\Resources\FileResource;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Gate; 


class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $files = File::whereUserId(Auth::id())->paginate(10);;

        return FileResource::collection($files);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(StoreFileRequest $request)
    {    
        
        $file = $request->file('file');
        $name = $file->hashName();


        $name = $request->file('file')->store(config('fileapi.folder'));
        $name = explode('/', $name);


        $file = File::create(['filename' => $name[1], 'mimetype' => $file->getClientMimeType(),'user_id' => auth()->id()]);


        return response()->json(new FileResource($file), 201); 
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   

        $file = File::find($id);

        if (is_null($file)) {

            return response()->json([
                'status' => false,
                'message' => 'El archivo solicitado no existe o ha sido eliminado'
            ], 404);
        }
        
        if (!Gate::allows('view-file', $file)) {
            return response()->json([
                'status' => false,
                'message' => 'No estas autorizado a ver el detalle de este archivo'
            ], 401);
        }

        
        return response()->json(new FileResource($file), 200); 
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy( DeleteFileRequest $request, $id)
    {   
        $file = File::find($id);

        if (is_null($file)) {
            return response()->json([
                'status' => false,
                'message' => 'El archivo solicitado no existe o ha sido eliminado'
            ], 404);
        }

        if (!Gate::allows('delete-file', $file)) {
            return response()->json([
                'status' => false,
                'message' => 'No estas autorizado para esta accion'
            ], 401);
        }

        if (!$request->boolean('preserve_file')) {
            $findFile = config('fileapi.folder') . '\\' . $file->filename;
            Storage::delete($findFile);
        } 

        $file->delete(); 

        return response()->json(null, 204);
    }
}
