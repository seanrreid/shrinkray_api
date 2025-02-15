<?php

namespace App\Http\Controllers;



use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UrlController extends Controller
{
    public function index()
    {
        $urls = Url::all();
        return response()->json($urls);
    }

    public function single_url($id)
    {
        $url = Url::find($id);
        return response()->json($url);
    }

    public function add(Request $request)
    {
        $url = new Url();
        $url->long_url = $request->long_url;
        $url->short_url = $request->short_url;
        $url->title = $request->title;
        $url->user_id = $request->user_id;
        $url->save();
        return response()->json($url);
    }

    public function update(Request $request, $id)
    {
        $url = Url::find($id);
        $url->url = $request->url;
        $url->save();
        return response()->json($url);
    }

    public function delete($id)
    {
        $url = Url::find($id);
        $url->delete();
        return response()->json(['status' => 'ok']);
    }
}
