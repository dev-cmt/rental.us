<?php

namespace App\Http\Controllers;

use ZipArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Response;
use App\Models\Application;
use App\Models\ApplicationSuccess;
use App\Exports\ApplicationExport;
use App\Helpers\ImageHelper;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = Application::query();

        if ($request->has('query') && $request->query != '') {
            $search = $request->query('query');
            $query->where('full_name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('phone', 'like', "%$search%");
        }

        $paginate = $request->input('paginate', 20);
        $applications = $query->latest()->paginate($paginate);

        return view('backEnd.admin.application.index', compact('applications'));
    }

    public function downloadImage($id, $type)
    {
        $user = User::find($id);

        if ($type == 'id_front_image') {
            $file_path = $user->id_front_image;
        } elseif ($type == 'id_back_image') {
            $file_path = $user->id_back_image;
        } elseif ($type == 'face_selfie_with_id') {
            $file_path = $user->face_selfie_with_id;
        } elseif ($type == 'face_selfie') {
            $file_path = $user->face_selfie;
        }

        $file = public_path($file_path);
        return Response::download($file);
    }

    public function bulkExport(Request $request)
    {
        $ids = explode(',', $request->id);
        $file_name = 'applications_' . date('d-m-Y') . '.xlsx';
        return Excel::download(new ApplicationExport($ids), $file_name);
    }

    public function zipImageDownload($id)
    {
        $user = User::find($id);

        $zip = new ZipArchive;

        $fileName = 'applications_' . $user->social_security_num . '.zip';
        if ($zip->open(public_path($fileName), \ZipArchive::CREATE) == TRUE) {
            $files = [];
            $id_front_image = public_path($user->id_front_image);
            $id_back_image = public_path($user->id_back_image);
            $face_selfie_with_id = public_path($user->face_selfie_with_id);
            $face_selfie = public_path($user->face_selfie);
            $files = [
                $id_front_image,
                $id_back_image,
                $face_selfie,
                $face_selfie_with_id,
            ];

            foreach ($files as $key => $value) {
                $relativeName = basename($value);
                $zip->addFile($value, $relativeName);
            }
            $zip->close();
        }

        return response()->download(public_path($fileName))->deleteFileAfterSend(true);
    }

    public function bulkDelete(Request $request)
    {
        foreach ($request->ids as $id) {
            $user = User::findOrFail($id);

            if ($user->id_front_image) {
                if (file_exists(public_path($user->id_front_image))) {
                    @unlink(public_path($user->id_front_image));
                }
            }

            if ($user->id_back_image) {
                if (file_exists(public_path($user->id_back_image))) {
                    @unlink(public_path($user->id_back_image));
                }
            }

            if ($user->face_selfie_with_id) {
                if (file_exists(public_path($user->face_selfie_with_id))) {
                    @unlink(public_path($user->face_selfie_with_id));
                }
            }

            if ($user->face_selfie) {
                if (file_exists(public_path($user->face_selfie))) {
                    @unlink(public_path($user->face_selfie));
                }
            }

            $user->delete();
        }

        return response()->json(['success']);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        if ($user->id_front_image) {
            if (file_exists(public_path($user->id_front_image))) {
                @unlink(public_path($user->id_front_image));
            }
        }

        if ($user->id_back_image) {
            if (file_exists(public_path($user->id_back_image))) {
                @unlink(public_path($user->id_back_image));
            }
        }

        if ($user->face_selfie_with_id) {
            if (file_exists(public_path($user->face_selfie_with_id))) {
                @unlink(public_path($user->face_selfie_with_id));
            }
        }

        if ($user->face_selfie) {
            if (file_exists(public_path($user->face_selfie))) {
                @unlink(public_path($user->face_selfie));
            }
        }

        $user->delete();
        return back()->with('success', 'Application deleted successfully.');
    }


    /**
     * -----------------------------------------------------------------------------
     *
     * -----------------------------------------------------------------------------
     */
    public function indexApplicationSuccesss()
    {
        $applicationSuccess = ApplicationSuccess::first();

        // Create a dummy contact if it doesn't exist
        if (!$applicationSuccess) {
            $applicationSuccess = ApplicationSuccess::create([
                'title' => '',
                'description' => '',
                'image' => '',
                'url' => '',
            ]);
        }

        return view('backEnd.admin.application.index_success', compact('applicationSuccess'));
    }

    public function updateApplicationSuccess(Request $request, $id)
    {
        $applicationSuccess = ApplicationSuccess::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'url' => 'required|url'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = ImageHelper::uploadImage($request->file('image'), 'uploads/application_success', $applicationSuccess->image);
        }

        $applicationSuccess->update($validated);

        return redirect()->back()->with('success', 'Application Success updated successfully.');
    }

}
