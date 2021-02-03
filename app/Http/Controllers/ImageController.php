<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Image;

use Storage;

class ImageController extends Controller
{
     public function input()
    {
        return view('images.input');
    }

    public function upload(Request $request)
    {        
        $this->validate($request, [
            'file' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png',
            ]
        ]);

        if ($request->file('file')->isValid([])) {
            //バリデーションを正常に通過した時の処理
            //S3へのファイルアップロード処理の時の情報を変数$upload_infoに格納する
            $upload_info = Storage::disk('s3')->putFile('/test', $request->file('file'), 'public');
            //S3へのファイルアップロード処理の時の情報が格納された変数$upload_infoを用いてアップロードされた画像へのリンクURLを変数$pathに格納する
            $path = Storage::disk('s3')->url($upload_info);
            //現在ログイン中のユーザIDを変数$user_idに格納する
            $user_id = \Auth::id();
            //モデルファイルのクラスからインスタンスを作成し、オブジェクト変数$new_image_dataに格納する
            $new_image_data = new Image();
            //プロパティ(静的メソッド)user_idに変数$user_idに格納されている内容を格納する
            $new_image_data->user_id = $user_id;
            //プロパティ(静的メソッド)に変数$pathに格納されている内容を格納する
            $new_image_data->path = $path;
            //インスタンスの内容をDBのテーブルに格納する
            $new_image_data->save();

            return redirect('/');
        }else{
            //バリデーションではじかれた時の処理
            return redirect('/upload/image');
        }
    }

    public function output()
    {
        //現在ログイン中のユーザIDを変数$user_idに格納する
        $user_id = \Auth::id();
        //imagesテーブルからuser_idカラムが変数$user_idと一致するレコード情報を取得し変数$user_imagesに格納する
        $user_images = Image::whereUser_id($user_id)->get();
        return view('images.output', ['user_images' => $user_images]);
    }
    //上記までを追記

}
