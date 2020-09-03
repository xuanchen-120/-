<?php

namespace App\Admin\Controllers;

use App\Models\Storage as StorageModel;
use File;
use Illuminate\Http\Request;
use Storage;

class StoragesController extends Controller
{
    public function index()
    {
        $storages = StorageModel::paginate();
        return view('Admin::storages.index', compact('storages'));
    }

    public function picture(Request $request)
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
                    'public' . date('/Y-m/d'), $File, $hash . '.' . $File->getClientOriginalExtension()
                );
                if (!$path) {
                    return [
                        'code'    => 0,
                        'message' => '图片上传失败',
                    ];
                }
                $path = Storage::url($path);

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
