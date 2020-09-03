<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;

class UeditorController extends Controller
{
    public function index(Request $request)
    {
        $action = $request->action;
        $config = config('ueditor');
        switch ($action) {
            case 'config':
                $result = $config;
                break;
            case 'uploadImage':
                $upConfig = [
                    "pathFormat" => $config['imagePathFormat'],
                    "maxSize"    => $config['imageMaxSize'],
                    "allowFiles" => $config['imageAllowFiles'],
                    'fieldName'  => $config['imageFieldName'],
                ];
                $result = with(new Uploader\UploadFile($upConfig, $request))->upload();
                break;
            case 'uploadScrawl':
                $upConfig = [
                    "pathFormat" => $config['scrawlPathFormat'],
                    "maxSize"    => $config['scrawlMaxSize'],
                    "oriName"    => "scrawl.png",
                    'fieldName'  => $config['scrawlFieldName'],
                ];
                $result = with(new Uploader\UploadScrawl($upConfig, $request))->upload();
                break;
            case 'uploadVideo':
                $upConfig = [
                    "pathFormat" => $config['videoPathFormat'],
                    "maxSize"    => $config['videoMaxSize'],
                    "allowFiles" => $config['videoAllowFiles'],
                    'fieldName'  => $config['videoFieldName'],
                ];
                $result = with(new Uploader\UploadFile($upConfig, $request))->upload();
                break;
            case 'uploadFile':
                $upConfig = [
                    "pathFormat" => $config['filePathFormat'],
                    "maxSize"    => $config['fileMaxSize'],
                    "allowFiles" => $config['fileAllowFiles'],
                    'fieldName'  => $config['fileFieldName'],
                ];
                $result = with(new Uploader\UploadFile($upConfig, $request))->upload();
                break;
            case 'catchImage':
                $upConfig = [
                    "pathFormat" => $config['catcherPathFormat'],
                    "maxSize"    => $config['catcherMaxSize'],
                    "allowFiles" => $config['catcherAllowFiles'],
                    "oriName"    => "remote.png",
                    'fieldName'  => $config['catcherFieldName'],
                ];
                $sources = $request->post($config['catcherFieldName']);

                $list = [];
                foreach ($sources as $imgUrl) {
                    $upConfig['imgUrl'] = $imgUrl;

                    $info = with(new Uploader\UploadCatch($upConfig, $request))->upload();

                    array_push($list, [
                        "state"    => $info["state"],
                        "url"      => $info["url"],
                        "size"     => $info["size"],
                        "title"    => htmlspecialchars($info["title"]),
                        "original" => htmlspecialchars($info["original"]),
                        "source"   => htmlspecialchars($imgUrl),
                    ]);
                }
                $result = [
                    'state' => count($list) ? 'SUCCESS' : 'ERROR',
                    'list'  => $list,
                ];
                break;
            case 'listImage':
                $result = with(new Uploader\Lists(
                    $config['imageManagerAllowFiles'],
                    $config['imageManagerListSize'],
                    $config['imageManagerListPath'],
                    $request))->getList();
                break;
            case 'listFile':
                $result = with(new Uploader\Lists(
                    $config['fileManagerAllowFiles'],
                    $config['fileManagerListSize'],
                    $config['fileManagerListPath'],
                    $request))->getList();
                break;
            default:
                $result = [];
                break;
        }
        return response()->json($result, 200, [], JSON_UNESCAPED_UNICODE);
    }

}
