<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage; 
use Illuminate\Support\Facades\File; 

// use Image;

use App\Message;

class MessageController extends Controller
{
    public function create(Request $request) {
        $message = new Message();

        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $message->title = $request->title;
        $message->content = $request->content;

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('uploads', $filename); // this will upload file in /storage/app/uploads 
            $image->move('images', $filename); // this will upload files in /public/images folder
    
            $message->image = $filename;
        }else{
            $message->image = 'placeholder.png';
        }
        $message->save();
        // die;

        // return back()->with('success','User Created Successfully');

        return redirect('/')->with('success','Post Created Successfully');

    }

    public function delete($id) {
        $message = Message::findOrFail($id);
        $imageName = public_path().'/images/'.$message->image;
        $message->delete();
        File::delete($imageName);
        return redirect('/');
    }

    public function deleteImage($id) {
        $message = Message::findOrFail($id);
        $imageName = public_path().'/images/'.$message->image;
        $storateImageName = public_path().'/storage/'.$message->image;
        File::delete( [$imageName, $storateImageName]);
        $message->image = '';
        $message->update();
        return redirect('/message/'.$id);

    }

    public function addImage( Request $request ) {
        $message = Message::findOrFail($request->id);

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public', $filename);
            $image->move('images', $filename);
            $message->image = $filename;
        }
        $message->update();
        return redirect('/message/'.$request->id);
    }

    public function update(Request $request) {
        // $message = Message::findOrFail($request->id);
        // $message->title = $request->title;
        // $message->content = $request->content;
        // $message->save();
        // echo $request->meta_key; die;

        $message = Message::updateOrCreate(
            ['id' => $request->id ],
            [
                'title' => $request->title,
                'content' => $request->content 
            ]
        );
        /*$message->messagemeta()->create(
            [
                'meta_key' => $request->meta_key,
                'meta_value' => $request->meta_value 
            ]
        );*/

        $message->messagemeta()->updateOrCreate(
            ['message_id' => $request->id ],
            [
                'meta_key' => $request->meta_key,
                'meta_value' => $request->meta_value 
            ]
        );
        // $$message

        return redirect('/');
    }

    public function view($id) {
        // $message = Message::with('messagemeta')->find($id);
        $message = Message::find($id);
        // $messageMeta = $message->messagemeta;
        if( !$message ) return redirect('/');
        return view('message',
            [
                'message' => $message
            ]
        );
    }

}
