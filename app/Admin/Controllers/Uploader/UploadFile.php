<?php

namespace App\Admin\Controllers\Uploader;

use File;
use Storage;

class UploadFile extends Upload
{

    public function uploadNow()
    {
        $this->file = $this->request->file($this->config['fieldName']);

        if (!$this->file->isValid()) {
            $this->stateInfo = 'ERROR_UNVALIDATED_FILE';
            return false;
        }

        $this->fileSize = $this->file->getSize();

        if (!$this->checkSize()) {
            $this->stateInfo = 'ERROR_SIZE_EXCEED';
            return false;
        }

        if (!$this->checkType()) {
            $this->stateInfo = 'ERROR_TYPE_NOT_ALLOWED';
            return false;
        }

        $this->hash = File::hash($this->file->path());

        $this->oriName = $this->file->getClientOriginalName();

        // $this->fullName = $this->getFullName();

        $this->fileName = basename($this->getFullName());

        $path = Storage::putFileAs(
            'public/uploader' . date('/Y-m/d'), $this->file, $this->fileName
        );
        $this->fullName = Storage::url($path);
        // $this->file->move($this->pathName, $this->fileName);

        return true;
    }
}
