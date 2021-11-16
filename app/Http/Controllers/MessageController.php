<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage; 

// use Image;

use App\Message;

class MessageController extends Controller
{
    public function create(Request $request) {
        $message = new Message();

        $message->title = $request->title;
        $message->content = $request->content;

        if ($request->hasfile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            // $location = storage_path('app/public/images/') . $filename;
            $image->storeAs('uploads', $filename); // this will upload file in /storage/app/uploads 
            // $image->storeAs('uploads');
            // $image->store('uploads');
            $image->move('images', $filename); // this will upload files in /public/images folder
    
        //    Image::make($image)->save($location);
        //     Storage::disk('uploads')->put($filename);
        //     Storage::disk('local',$filename, 'local');
    
            $message->image = $filename;
        }
        $message->save();
        // die;

        return redirect('/');

    }

    public function delete($id) {
        $message = Message::findOrFail($id);
        $message->delete();
        return redirect('/');
    }

    public function update(Request $request) {
        // $message = Message::findOrFail($request->id);
        // $message->title = $request->title;
        // $message->content = $request->content;
        // $message->save();
        Message::updateOrCreate(
            ['id' => $request->id ],
            [
                'title' => $request->title,
                'content' => $request->content 
            ]
        );

        return redirect('/');
    }

    public function view($id) {
        $message = Message::find($id);
        $messageMeta = Message::find($id)->messagemeta;
        
        if( !$message ) return redirect('/');
        return view('message',
            [
                'message' => $message,
                'messagemeta' => $messageMeta
            ]
        );
    }

}
