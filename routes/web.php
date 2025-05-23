<?php

use App\Exports\UsersExport;
use App\Exports\UsersImportTemplate;
use App\Models\Alumni;
use App\Models\Form;
use App\Models\InformasiBeasiswa;
use App\Models\InformasiLoker;
use App\Models\Response;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    if (auth()->user()) {
        return redirect()->route('kuesioner');
    }
    return view('login');
})->name('login');

Route::post('/authenticate', function (Request $request) {
    $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->route('kuesioner')->with('success', 'Login berhasil!');
    }

    return back()->with('error', 'Email atau password salah!');
})->name('authenticate');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

Route::get('/loker', function (Request $request) {
    $query = InformasiLoker::query();

    // Filter berdasarkan jenis pekerjaan (bisa lebih dari satu)
    if ($request->has('filter') && is_array($request->filter)) {
        $query->whereIn('jenis', $request->filter);
    }

    // Sorting berdasarkan created_at
    $sort = $request->input('sortir', 'asc');
    $query->orderBy('created_at', $sort);

    // Ambil data dengan pagination
    $loker = $query->paginate(10);
    return view('loker', ['loker' => $loker]);
});

Route::get('/loker/{loker}', function (InformasiLoker $loker) {
    return view('detail-loker', ['loker' => $loker]);
});

Route::get('/beasiswa', function () {
    $beasiswa  = InformasiBeasiswa::orderBy('created_at', 'DESC')->paginate(10);
    return view('beasiswa', ['beasiswa' => $beasiswa]);
});

Route::get('/prestasi', function () {
    $prestasi  = User::orderBy('ipk', 'DESC')->role('alumni')->get()->take(10);
    return view('prestasi', ['prestasi' => $prestasi]);
});

Route::get('/beasiswa/{beasiswa}', function (InformasiBeasiswa $beasiswa) {
    return view('detail-beasiswa', ['beasiswa' => $beasiswa]);
});


Route::get('/kuesioner', function () {
    $form = Form::with('questions')->orderBy('created_at', 'DESC')->get();
    return view('kuesioner', ["form" => $form]);
})->name('kuesioner')->middleware('auth');

Route::get('/kuesioner/{form}', function (Form $form) {
    return view('detail-kuesioner', ["form" => $form]);
})->name('detail-kuesioner')->middleware('auth');
Route::get('/download-users-template', function () {
    return Excel::download(new UsersImportTemplate, 'users_import_template.xlsx');
})->name('download.users.template');
Route::get('/report/{form}', function (Form $form) {
    $questions = $form->questions()->with('responses')->get();

    $report = $questions->map(function ($question) {
        $answers = $question->responses->where('question_id', $question->id);

        // Jika pertanyaan memiliki pilihan ganda (checkbox), maka jawabannya berupa array JSON
        $answerCounts = $answers->groupBy('answer')->map(fn($group) => $group->count());
        return [
            'question' => $question->question_text,
            'type' => $question->question_type,
            'responses' => $answerCounts,
        ];
    });

    return view('report', compact('report'));
})->name('report');

Route::get('/alumni/report', function () {
    $data = User::role('alumni')->get();
    $pdf = Pdf::loadView('pdf.alumni', compact('data'));
    return $pdf->stream();
});

Route::get('/alumni/report/excel', function () {
    $data = User::role('alumni')->with('responses.question')->whereHas('responses')->get()->map(function ($data) {
        $dataResponse = [];
        foreach ($data->responses as $respon) {
            $dataResponse[] = [
                "question_text" => $respon->question->question_text,
                "answer" => $respon->answer,
            ];
        }
        return [
            "user_id" => $data->id,
            "response" => $dataResponse
        ];
    });

    return Excel::download(new UsersExport($data), 'users.xlsx');
});

Route::post('/response/{form}', function (Request $request, Form $form) {
    Response::where('user_id', auth()->id())->where('form_id', $form->id)->delete();

    $request->validate([
        'answers' => 'required|array',
    ]);

    foreach ($request->answers as $question_id => $answer) {
        Response::create([
            'user_id' => auth()->id(),
            'form_id' => $form->id,
            'question_id' => $question_id,
            'answer' => is_array($answer) ? json_encode($answer) : $answer,
        ]);
    }

    return redirect()->route('hasil-kuesioner', $form->id)->with('success', 'Kuesioner berhasil diisi!');
})->name('responses.store');

Route::get('/hasil-kuesioner/{form}', function (Form $form) {
    $responses = Response::where('form_id', $form->id)->where('user_id', auth()->id())->get();

    return view('hasil-kuesioner', ["form" => $form, "responses" => $responses]);
})->name('hasil-kuesioner')->middleware('auth');
