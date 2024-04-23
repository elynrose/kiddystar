<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyChildRequest;
use App\Http\Requests\StoreChildRequest;
use App\Http\Requests\UpdateChildRequest;
use App\Models\Child;
use App\Models\UserCard;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Auth;

class ChildrenController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('child_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $children = Child::with(['created_by', 'media'])->where('created_by_id', Auth::user()->id)->get();

        return view('frontend.children.index', compact('children'));
    }

    public function create()
    {
        abort_if(Gate::denies('child_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.children.create');
    }

    public function store(StoreChildRequest $request)
    {

          // Validate the request data
          $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'unique' => 'required|string|max:255',
            'card_id' => 'required|int',
            'dob' => 'required|date',
            'card_id' => 'exists:cards,id', // Assuming 'cards' is your table name and 'id' is the primary key
            'created_by_id' => 'sometimes|nullable|exists:users,id', // Validate 'created_by_id' exists in 'users' table
        ]);


        $child = Child::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'dob' => $validated['dob'],
            'card_id' => $validated['card_id'],
            'unique' => $validated['unique'],
        ]
        );

        if ($request->input('photo', false)) {
            $child->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $child->id]);
        }

        if($child){
          
                // Create a user card if card_id and created_by_id are provided
                if (!empty($validated['card_id'])) {
                    $userCard = UserCard::create([
                        'card_id' => $validated['card_id'],
                        'children_id' => $child->id,
                        'created_by_id' => $validated['created_by_id'] ?? Auth::id(), // Default to current user's ID if not provided
                    ]);
                }
        }

        return redirect()->route('frontend.user-cards.index');
    }

    public function edit(Child $child)
    {
        abort_if(Gate::denies('child_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $child->load('created_by');

        return view('frontend.pages.edit-child', compact('child'));
    }

    public function update(UpdateChildRequest $request, Child $child)
    {
        $child->update($request->all());

        if ($request->input('photo', false)) {
            if (! $child->photo || $request->input('photo') !== $child->photo->file_name) {
                if ($child->photo) {
                    $child->photo->delete();
                }
                $child->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($child->photo) {
            $child->photo->delete();
        }

        return redirect()->route('frontend.user-cards.index');
    }

    public function show(Child $child)
    {
        abort_if(Gate::denies('child_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $child->load('created_by');

        return view('frontend.children.show', compact('child'));
    }

    public function destroy(Child $child)
    {
        abort_if(Gate::denies('child_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $child->delete();

        return back();
    }

    public function massDestroy(MassDestroyChildRequest $request)
    {
        $children = Child::find(request('ids'));

        foreach ($children as $child) {
            $child->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('child_create') && Gate::denies('child_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Child();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
