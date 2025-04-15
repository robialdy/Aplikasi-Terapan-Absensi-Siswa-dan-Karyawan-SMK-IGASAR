LIST BELUM DIKERJAKAN table

LIST BELUM DIKERJAKAN fitur

-- Visualisasi Data
-- KEBUTUHAN FUNGSIONAL PARA AKTOR ('Walikelas (hampir selesai))
-- ABSENSI GURU/KARYAWAN TIDAK HADIR
-- GENERATE LAPORAN ALL AKTOR

DOKUMENTASI

contoh untuk visualisasi data jumlah
'kondisi' => [
'baik' => Asset::where('condition_asset', 'Baik')->count(),
'rusak_ringan' => Asset::where('condition_asset', 'Rusak Ringan')->count(),
'rusak_sedang' => Asset::where('condition_asset', 'Rusak Sedang')->count(),
'rusak_berat' => Asset::where('condition_asset', 'Rusak Berat')->count(),
'rusak_total' => Asset::where('condition_asset', 'Rusak Total')->count(),
]

SELECT BOX INSERT

<form method="post" action="/simpan">
  <input type="checkbox" name="printer_id[]" value="1"> Printer A<br>
  <input type="checkbox" name="printer_id[]" value="2"> Printer B<br>
  <input type="checkbox" name="printer_id[]" value="3"> Printer C<br>
  <button type="submit">Simpan</button>
</form>

$printerIds = $request->printer_id;
$dataToInsert = [];

foreach ($printerIds as $id) {
$dataToInsert[] = [
'printer_id' => $id,
'created_at' => now(),
// tambahkan field lain kalau perlu
];
}

DB::table('nama_tabel')->insert($dataToInsert);

REDIRECT HARI LIBUR

1. php artisan make:middleware CekHariLibur

2. namespace App\Http\Middleware;
   use Closure;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\DB;
   use Carbon\Carbon;

class CekHariLibur
{
public function handle(Request $request, Closure $next)
{
$hariIni = Carbon::today();

        $adaLibur = DB::table('hari_libur')
            ->whereDate('tgl_mulai', '<=', $hariIni)
            ->whereDate('tgl_selesai', '>=', $hariIni)
            ->exists();

        if ($adaLibur) {
            return redirect()->back()->with('error', 'Hari ini adalah hari libur!');
        }

        return $next($request);
    }

}
atau
use App\Models\HariLibur;
...
HariLibur::whereDate('tgl_mulai', '<=', $hariIni)->whereDate('tgl_selesai', '>=', $hariIni)->exists();

3. Route::get('/formulir', [FormulirController::class, 'index'])->middleware('cek_hari_libur');
   atau
   public function \_\_construct()
   {
   $this->middleware('cek_hari_libur')->only(['create', 'store']);
   }

<!-- PROSES ABSENSI KELAS -->

HTML:

<form action="{{ route('absensi.store') }}" method="POST">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Masuk</th>
                <th>Sakit</th>
                <th>Izin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($siswa as $s)
            <tr>
                <td>{{ $s->nama_lengkap }}</td>
                <!-- Input hidden untuk id siswa -->
                <input type="hidden" name="siswa_id[]" value="{{ $s->id }}">

                <td><input type="radio" name="status[{{ $s->id }}]" value="Masuk" required></td>
                <td><input type="radio" name="status[{{ $s->id }}]" value="Sakit"></td>
                <td><input type="radio" name="status[{{ $s->id }}]" value="Izin"></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Kirim Absensi</button>
    </div>

</form>

CARA KERJA:
[
1 => "Masuk",
2 => "Sakit",
3 => "Izin",
...
]

CONTROLLER:
public function store(Request $request)
{
$status = $request->input('status'); // array: [id_siswa => status]

    foreach ($status as $siswa_id => $st) {
        Absensi::create([
            'siswa_id' => $siswa_id,
            'status' => $st,
            'tanggal' => now()->toDateString(),
            'waktu' => now()->format('H:i:s'),
        ]);
    }

    return redirect()->back()->with('success', 'Absensi berhasil disimpan!');

}

<!-- PROSES GENERATE LAPORAN EXCEL -->

INSTALL:
composer require maatwebsite/excel

BUAT EXPORT KELAS:
php artisan make:export KehadiranExport --model=JadwalKehadiran

EDIT:
namespace App\Exports;

use App\Models\JadwalKehadiran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KehadiranExport implements FromCollection, WithHeadings
{
protected $jadwalId;

    public function __construct($jadwalId)
    {
        $this->jadwalId = $jadwalId;
    }

    public function collection()
    {
        return JadwalKehadiran::with('siswa') // jika ada relasi siswa
            ->where('jadwal_id', $this->jadwalId)
            ->get()
            ->map(function ($item) {
                return [
                    'Nama Siswa' => $item->siswa->nama_lengkap ?? '-',
                    'Status' => $item->status,
                    'Waktu Datang' => $item->datang_pukul,
                    'Tanggal' => $item->tanggal,
                ];
            });
    }

    public function headings(): array
    {
        return ['Nama Siswa', 'Status', 'Waktu Datang', 'Tanggal'];
    }

}

ROUTE:
use App\Exports\KehadiranExport;
use Maatwebsite\Excel\Facades\Excel;

Route::get('/export-kehadiran/{jadwalId}', function ($jadwalId) {
    return Excel::download(new KehadiranExport($jadwalId), 'laporan-kehadiran.xlsx');
});

BUTTON:
<a href="{{ url('/export-kehadiran/' . $jadwal->id) }}" class="btn btn-success mb-3">
Export Excel
</a>
