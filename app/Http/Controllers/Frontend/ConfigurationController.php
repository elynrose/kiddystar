<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyConfigurationRequest;
use App\Http\Requests\StoreConfigurationRequest;
use App\Http\Requests\UpdateConfigurationRequest;
use App\Models\Configuration;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class ConfigurationController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('configuration_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $configurations = Configuration::with(['created_by', 'media'])->where('created_by_id', Auth::user()->id)->orderby('start_date', 'asc')->get();

        return view('frontend.pages.all-configs', compact('configurations'));
    }

    public function create()
    {
        abort_if(Gate::denies('configuration_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.pages.add-config');
    }

    public function store(StoreConfigurationRequest $request)
    {
        $configuration = Configuration::create($request->all());

        if ($request->input('banner', false)) {
            $configuration->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner'))))->toMediaCollection('banner');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $configuration->id]);
        }

        return redirect()->route('frontend.pages.add-config');
    }

    public function edit(Configuration $configuration)
    {
        abort_if(Gate::denies('configuration_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $configuration->load('created_by');

        return view('frontend.pages.edit-config', compact('configuration'));
    }

    public function update(UpdateConfigurationRequest $request, Configuration $configuration)
    {
        $configuration->update($request->all());

        if ($request->input('banner', false)) {
            if (! $configuration->banner || $request->input('banner') !== $configuration->banner->file_name) {
                if ($configuration->banner) {
                    $configuration->banner->delete();
                }
                $configuration->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner'))))->toMediaCollection('banner');
            }
        } elseif ($configuration->banner) {
            $configuration->banner->delete();
        }

        $configurations = Configuration::with(['created_by', 'media'])->where('created_by_id', Auth::user()->id)->get();

        return view('frontend.pages.all-configs', compact('configurations'));
    }

    public function show(Configuration $configuration)
    {
        abort_if(Gate::denies('configuration_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $configuration->load('created_by');

        return view('frontend.configurations.show', compact('configuration'));
    }

    public function destroy(Configuration $configuration)
    {
        abort_if(Gate::denies('configuration_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $configuration->delete();

        return back();
    }

    public function massDestroy(MassDestroyConfigurationRequest $request)
    {
        $configurations = Configuration::find(request('ids'));

        foreach ($configurations as $configuration) {
            $configuration->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('configuration_create') && Gate::denies('configuration_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Configuration();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
