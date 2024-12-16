<?php

namespace App\Support;

class Image {

    public function FileUpload($image,$path,$base = false) {
        $destinationPath = (is_null($path))? public_path('uploads'):public_path('uploads/'.$path);
        $mm = (is_null($path))?'uploads' :'uploads/'.$path;
        if(!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        if($image->getClientOriginalExtension() == "mp4") {
            $filename = time() . rand(10000, 99999) .'.'.$image->getClientOriginalExtension();
            $image->move($destinationPath, $filename);
            return $mm . '/' .$filename;
        }
        $imageName = rand(1,5000).'_'.time().'.'.$image->extension();
        $image->move($destinationPath, $imageName);
        return $mm.'/'.$imageName;
    }

    public function BaseImage($img) {
        $img = str_replace(['data:image/png;base64,', 'data:image/jpeg;base64,', 'data:image/jpg;base64,'], '', $img);
        $data = base64_decode($img);
        return $data;
    }

    public function displayImage($image) {
        if(!is_null($image)) {
            if(is_file(public_path($image))) {
                return url($image);
            }
            return "https://www.gravatar.com/avatar/".md5('info@info.info');
        }
        return "https://www.gravatar.com/avatar/".md5('info@info.info');
    }

    public function displayImageByModel($model,$key,$default = false,$m_d = false) {
        if(is_null($model)) {
            if($default == false) {
                if($m_d == false) {
                    return "https://eu.ui-avatars.com/api/?uppercase=true&name=ABC&background=random";
                } else {
                    return null;
                }
            } else {
                return url($default);
            }
        }
        if(is_null($model->$key)) {
            $name = '';
            if(is_null($model->name)) {
                $name = explode(" ",$model->name);
            } elseif(!is_null($model->name) && is_null($model->title)) {
                $name = explode(" ",$model->title);
            } elseif(!is_null($model->name) && !is_null($model->title) && is_null($model->account_name)) {
                $name = explode(" ",$model->account_name);
            }
            if(count($name) > 1) {
                $getName = $name[0].' '.$name[1];
            } else {
                $getName = $name;
            }
            if($default == false) {
                if($m_d == false) {
                    return "https://www.gravatar.com/avatar/".md5('info@info.info');
                } else {
                    return "https://www.gravatar.com/avatar/".md5('info@info.info');
                }
            } else {
                return url($default);
            }
        }
        return url($model->$key);
    }

}
