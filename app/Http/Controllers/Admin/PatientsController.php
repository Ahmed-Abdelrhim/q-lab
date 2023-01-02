<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Requests\Admin\PatientRequest;
use App\Http\Requests\Admin\ExcelImportRequest;
use App\Exports\PatientExport;
use App\Imports\PatientImport;

//use Excel;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class PatientsController extends Controller
{
    /**
     * assign roles
     */
    public function __construct()
    {
        $this->middleware('can:view_patient', ['only' => ['index', 'show', 'ajax']]);
        $this->middleware('can:create_patient', ['only' => ['create', 'store']]);
        $this->middleware('can:edit_patient', ['only' => ['edit', 'update']]);
        $this->middleware('can:delete_patient', ['only' => ['destroy']]);
    }


    public function index(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $patients = Patient::all();
        return view('admin.patients.index', compact('patients'));
    }

    public function ajax(Request $request)
    {
        $model = Patient::query()->get();

//        $data = DataTables::eloquent($model)
//            ->editColumn('total', function ($patient) {
//                return formated_price($patient['total']);
//            })
//            ->editColumn('paid', function ($patient) {
//                return formated_price($patient['paid']);
//            })
//            ->editColumn('due', function ($patient) {
//                return view('admin.patients._due', compact('patient'));
//            })
//            ->addColumn('action', function ($patient) {
//                return view('admin.patients._action', compact('patient'));
//            });

        return DataTables::of($model)->addIndexColumn()
            ->addColumn('total', function ($patient) {
                return formated_price($patient['total']);
            })
            ->addColumn('paid', function ($patient) {
                return formated_price($patient['paid']);
            })
            ->addColumn('due', function ($patient) {
                return view('admin.patients._due', compact('patient'));
            })
            ->addColumn('action', function ($patient) {
                return view('admin.patients._action', compact('patient'));
            })
            ->toJson();
    }

    public function aaa(): string
    {
        return 'aaa';
    }


    public function create(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('admin.patients.create');
    }


    public function store(PatientRequest $request): \Illuminate\Http\RedirectResponse
    {
        $patient = Patient::query()->create([
            'code' => patient_code(),
            'name' => $request->get('name'),
            'gender' => $request->get('gender'),
            'dob' => $request->get('dob'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'address' => $request->get('address'),
        ]);

        // Send notification with the patient code
        send_notification('patient_code', $patient);

        session()->flash('success', 'Patient created successfully');

        return redirect()->route('admin.patients.index');
    }


    public function show($id)
    {
        //
    }


    public function edit($id): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $patient = Patient::query()->findOrFail($id);
        return view('admin.patients.edit', compact('patient'));
    }

    public function update(PatientRequest $request, $id): \Illuminate\Http\RedirectResponse
    {
        $patient = Patient::query()->findOrFail($id);
        $patient->update([
            'name' => $request->name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        //send notification with the patient code
        $patient = Patient::find($id);
        send_notification('patient_code', $patient);

        session()->flash('success', 'Patient data updated successfully');

        return redirect()->route('admin.patients.index');
    }


    public function destroy($id)
    {
        $patient = Patient::query()->findOrFail($id); // get patient
        $patient->groups()->delete(); // delete groups
        $patient->delete();//delete patient
        session()->flash('success', __('Patient deleted successfully'));
        return redirect()->route('admin.patients.index');
    }


    public function export(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        ob_end_clean(); // this
        ob_start(); // and this
        return Excel::download(new PatientExport, 'patients.xlsx');
    }


    public function import(ExcelImportRequest $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->hasFile('import')) {
            ob_end_clean(); // this
            ob_start(); // and this
            Excel::import(new PatientImport, $request->file('import'));
        }

        session()->flash('success', __('Patients imported successfully'));

        return redirect()->back();
    }


    public function download_template(): \Symfony\Component\HttpFoundation\BinaryFileResponse
    {
        ob_end_clean(); // this
        ob_start(); // and this
        return response()->download(storage_path('app/public/patients_template.xlsx'), 'patients_template.xlsx');
    }
}
