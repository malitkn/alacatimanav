<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Http\Requests\MediaUpdateRequest;
use App\Models\Media;
use App\Models\Setting;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    protected Setting $setting;
    protected Collection $media;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting->first();
        $this->media = Media::all();
    }

    public function update(MediaUpdateRequest $request)
    {
        if (!$request->has('section')) {
            return redirect()->back();
        }
        $this->uploadAndSave($request->only('section')['section']);
        $request->session()->now('status', ['isSuccess' => true, 'message' => __('Ayarlar başarıyla güncellendi.')]);
        return view('back.settings.index')
            ->with('setting', $this->setting)
            ->with('media', $this->media);
    }

    public function uploadAndSave($sections)
    {
        foreach ($sections as $section => $file) {
            $path = $file->storeAs('images', $section . '-logo.' . $file->extension());
            $media = $this->media->where('section', $section)->first();
            $media->fill([
                'path' => 'storage/' . $path
            ]);
            $media->save();
        }
        $this->media = $this->media->fresh();
    }
}
