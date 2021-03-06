<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Requests\TaskPictureStoreRequest;

class TmpPictureController extends Controller
{
    /**
     * store the picture temporarily.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeTmpPicture(TaskPictureStoreRequest $request, Project $project)
    {
        if($tmp_files_array = $request->session()->get('tmp_files')){
            $tmp_files_count = count($tmp_files_array);
        } else {
            $tmp_files_count = 0;
        };

        //投稿予定画像は5枚まで。
        if($tmp_files_count >= 5){
            $flash = ['error' => __('Please limit the number of attached picture to 5 or less.')];
        } else {
            //投稿予定画像がある場合、tmpディレクトリに画像を保存し、セッション情報を一時的に保持する
            if($file = $request->file('file')){
                $tmp_file_name = Str::random(20);
                $tmp_file_path = basename($file->store('public/tmp'));
                $request->session()->put('tmp_files.'.$tmp_file_name, $tmp_file_path);

                $flash = ['success' => __('Picture added successfully.')];
            } else {
                $flash = ['error' => __('Failed to add the picture.')];
            }
        }
        return redirect()
            ->route('tasks.create', ['project' => $project->id])
            ->with($flash);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TaskPicture  $taskPicture
     * @return \Illuminate\Http\Response
     */
    public function destroyTmpPicture(Request $request, Project $project)
    {
        $tmp_file_name = $request->input('tmp_file_name');
        if (session()->has('tmp_files.'.$tmp_file_name)) {
            $tmp_file_path = $request->session()->pull('tmp_files.'.$tmp_file_name);
            Storage::disk('public')->delete('tmp/'.$tmp_file_path);

            $flash = ['success' => __('Picture deleted successfully.')];
        } else {
            $flash = ['error' => __('Failed to delete the picture.')];
        }
        return redirect()
            ->route('tasks.create', ['project' => $project->id])
            ->with($flash);
    }
}
