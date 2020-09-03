<?php

namespace App\Http\Controllers;

use App\Models\Storage as StorageModel;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Storage;

class StorageController extends Controller
{

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __call($method, $args)
    {
        return call_user_func_array([$this, 'upload'], [$this->request, Str::plural($method)]);
    }

    public function upload(Request $request, $uploadRootPath)
    {
        if ($request->isMethod('get')) {
            $result = StorageModel::where('hash', $request->md5)->first();
            if ($result) {
                return [
                    'code' => 1,
                    'data' => $result,
                ];
            } else {
                return [
                    'code' => 0,
                ];
            }
        } elseif ($request->isMethod('post') && $request->hasFile('image') && $request->file('image')->isValid()) {
            $File   = $request->file('image');
            $hash   = File::hash($File->path());
            $upload = StorageModel::where('hash', $hash)->first();

            if (!$upload) {
                $path = Storage::putFileAs(
                    'public/' . $uploadRootPath . date('/Y-m/d'), $File, $hash . '.' . $File->getClientOriginalExtension()
                );
                if (!$path) {
                    return [
                        'code'    => 0,
                        'message' => '文件上传失败',
                    ];
                }
                $path   = Storage::url($path);
                $upload = StorageModel::create([
                    'path' => $path,
                    'hash' => $hash,
                    'size' => $File->getSize(),
                ]);
            }

            return [
                'code'    => 1,
                'message' => '文件上传成功',
                'path'    => $upload->path,
                'id'      => $upload->id,
            ];
        } else {
            return [
                'code'    => 0,
                'message' => $request->file('image')->getErrorMessage(),
            ];
        }
    }
}
