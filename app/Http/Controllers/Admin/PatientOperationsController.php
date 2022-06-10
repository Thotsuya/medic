<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocumentRequest;
use App\Models\Document;
use App\Models\Patient;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PatientOperationsController extends Controller
{
    public function storeDocument(DocumentRequest $request)
    {
        $patient = Patient::find($request->patient_id);
        try {

            $currentDate = Carbon::now()->toDateString();
            $imageName = Str::slug($request->validated()['name']) . '-' . $currentDate . '-' . uniqid() . '.' . $request->file('file')->getClientOriginalExtension();

            if (!Storage::exists('documents/' . $request->patient_id)) {
                Storage::makeDirectory('documents/' . $request->patient_id);
            }

            if (!Storage::exists('documents/' . $request->patient_id . '/thumbnails')) {
                Storage::makeDirectory('documents/' . $request->patient_id . '/thumbnails');
            }

            if ($this->isImage($imageName)) {

                $realimage = Image::make($request->file('file'))->save($imageName);
                $thumbnail = Image::make($request->file('file'))->resize(320, 320)->save($imageName);

                Storage::put('documents/' . $request->patient_id . '/thumbnails/' . $imageName, $thumbnail);
                Storage::put('documents/' . $request->patient_id . '/' . $imageName, $realimage);

            } else {
                $request->file('file')->storeAs('documents/' . $this->patient->id . '/', $imageName);
            }

            $patient->documents()->create([
                'title' => $request->validated()['name'],
                'url' => $imageName,
                'filetype' => $this->isImage($imageName) ? Document::IMAGE : Document::DOCUMENT
            ]);


        } catch (\Exception $e) {
            ray($e->getMessage());
            return redirect()->back()->withMessage('Error al guardar el documento');
        }

        return redirect()->route('patients.show',$patient)->withMessage('Archivo guardado correctamente');


    }

    private function isImage($imageName)
    {
        $imageExtensions = ['jpg', 'jpeg', 'gif', 'png', 'bmp', 'svg'];
        $explodeImage = explode('.', $imageName);
        $extension = end($explodeImage);

        return in_array($extension, $imageExtensions);
    }
}
