<?php

namespace App\Http\Controllers\Back;

use App\Enums\SettingMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\SettingUpdateRequest;
use App\Models\Media;
use App\Models\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class SettingController extends Controller
{
    protected Setting $setting;
    protected Collection $media;

    public function __construct(Setting $setting, Media $media)
    {
        $this->setting = $setting->first();
        $this->media = $media->all();
    }

    public function index()
    {
        return view('back.settings.index')
            ->with('setting', $this->setting)
            ->with('media', $this->media);
    }

    public function update(SettingUpdateRequest $request)
    {
        $this->setting->fill($request->all());
        $this->setting->save();
        $request->session()->now('status', ['isSuccess' => true, 'message' => __(SettingMessage::SUCCESS)]);

        return $this->index();
    }
}
