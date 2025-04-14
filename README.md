LIST BELUM DIKERJAKAN table
- Riwayat Kelas
- Kehadiran
- Jadwal Kehadiran

LIST BELUM DIKERJAKAN fitur

-- Visualisasi Data


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
public function __construct()
{
    $this->middleware('cek_hari_libur')->only(['create', 'store']);
}


