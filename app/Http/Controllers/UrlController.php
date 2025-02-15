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

    public function single_url($shortCode)
    {
        $url = Url::where('short_url', $shortCode)->firstOrFail();
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
        if ($request->has('long_url')) {
            $url->long_url = $request->long_url;
        }
        if ($request->has('short_url')) {
            $url->short_url = $request->short_url;
        }
        if ($request->has('title')) {
            $url->title = $request->title;
        }
        if ($request->has('user_id')) {
            $url->user_id = $request->user_id;
        }
        $url->save();
        return response()->json($url);
    }

    public function delete($id)
    {
        $url = Url::find($id);
        $url->delete();
        return response()->json(['status' => 'ok']);
    }

    public static function sendit($shortCode)
    {
        $url = Url::where('short_url', $shortCode)->firstOrFail();

        if (!$url) {
            return abort(404);
        }

        $scheme = request()->getHost() == 'localhost' ? 'http' : 'https';
        $url->long_url = $scheme . '://' . $url->long_url;
        return redirect($url->long_url);
    }
}
