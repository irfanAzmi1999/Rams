<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Scopes\ActiveScope;
use OwenIt\Auditing\Contracts\Auditable;

class Accident extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected array $auditInclude = [
        'id', 'export_id', 'negeri_id', 'daerah_id', 'balai_id', 'no_laporan', 'tarikh_kejadian', 'hari_id',
        'bil_ken_terlibat', 'bil_ken_rosak', 'bil_pemandu_mati', 'bil_pemandu_cedera', 'bil_penumpang_mati',
        'bil_penumpang_cedera', 'bil_penumpang_mati', 'bil_penumpang_cedera', 'bil_pejalan_mati', 'bil_pejalan_cedera',
        'jenis_kemalangan_id', 'jenis_permukaan_id', 'sistem_laluan_id', 'bentuk_jalan_id', 'kualiti_permukaan_id',
        'keadaan_jalan_id', 'jenis_garis_id', 'langgar_lari_id', 'jenis_kawalan_id', 'lebar_jalan', 'lebar_bahu_jalan',
        'jenis_bahu_jalan_id', 'sebab_cacat_jalan_id', 'had_laju_id', 'muka_jalan_id', 'jenis_langgar_pertama_id',
        'cuaca_id', 'cahaya_id', 'jenis_jalan_id', 'no_laluan', 'tempat_kejadian', 'jenis_tempat_id', 'jenis_kawasan_id',
        'pos_kilometer', '100_meter_hampir', 'sebab_binatang_id', 'anggar_rosak_kenderaan', 'anggar_rosak_semua',
        'siri_peta', 'kod_peta', 'latitude', 'logitude', 'lebar_bahu_jalan_kiri', 'lebar_bahu_jalan_kanan', 'pos_dari1',
        'pos_dari2', 'pos_km1', 'pos_km2', 'pos_no_sek1', 'pos_jarak', 'pos_arah', 'pos_jarak3', 'pos_dari3', 'pos_arah3',
        'nod_1', 'nod_2', 'arah_id', 'nombor_seksyen', 'poskm_hampir', 'lakaran_kejadian', 'lakaran_lokasi', 'tarikh_pengaduan',
        'tahun', 'bulan_id', 'created_by', 'updated_by', 'disable', 'punca_kemalangan_id', 'bentuk_jalan_penerangan',
        'keadaan_jalan_penerangan', 'punca_kemalangan_penerangan', 'url', 'status_la', 'jalan_id'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }

    public function getId()
    {
        return $this->id;
    }

    public function arah()
    {
        return $this->belongsTo(Arah::class);
    }

    public function balai()
    {
        return $this->belongsTo(Balai::class);
    }

    public function bentukJalan()
    {
        return $this->belongsTo(BentukJalan::class);
    }

    public function bulan()
    {
        return $this->belongsTo(Bulan::class);
    }

    public function cahaya()
    {
        return $this->belongsTo(Cahaya::class);
    }

    public function cuaca()
    {
        return $this->belongsTo(Cuaca::class);
    }

    public function daerah()
    {
        return $this->belongsTo(Daerah::class);
    }

    public function export()
    {
        return $this->belongsTo(Export::class);
    }

    public function hadLaju()
    {
        return $this->belongsTo(HadLaju::class);
    }

    public function hari()
    {
        return $this->belongsTo(Hari::class);
    }

    public function jenisBahuJalan()
    {
        return $this->belongsTo(JenisBahuJalan::class);
    }

    public function jenisGaris()
    {
        return $this->belongsTo(JenisGaris::class);
    }

    public function jenisJalan()
    {
        return $this->belongsTo(JenisJalan::class);
    }

    public function jenisKawalan()
    {
        return $this->belongsTo(JenisKawalan::class);
    }

    public function jenisKawasan()
    {
        return $this->belongsTo(JenisKawasan::class);
    }

    public function jenisKemalangan()
    {
        return $this->belongsTo(JenisKemalangan::class);
    }

    public function jenisLanggarPertama()
    {
        return $this->belongsTo(JenisLanggarPertama::class);
    }

    public function jenisPermukaan()
    {
        return $this->belongsTo(JenisPermukaan::class);
    }

    public function jenisTempat()
    {
        return $this->belongsTo(JenisTempat::class);
    }

    public function keadaanJalan()
    {
        return $this->belongsTo(KeadaanJalan::class);
    }

    public function puncaKemalangan()
    {
        return $this->belongsTo(KategoriKesilapan::class, 'punca_kemalangan_id', 'id');
    }

    public function kategoriKesilapan()
    {
        return $this->belongsTo(KategoriKesilapan::class, 'punca_kemalangan_id', 'id');
    }

    public function kualitiPermukaan()
    {
        return $this->belongsTo(KualitiPermukaan::class);
    }

    public function langgarLari()
    {
        return $this->belongsTo(LanggarLari::class);
    }

    public function mukaJalan()
    {
        return $this->belongsTo(MukaJalan::class);
    }

    public function negeri()
    {
        return $this->belongsTo(Negeri::class);
    }

    public function sebabBinatang()
    {
        return $this->belongsTo(SebabBinatang::class);
    }

    public function sebabCacatJalan()
    {
        return $this->belongsTo(SebabCacatJalan::class);
    }

    public function sistemLaluan()
    {
        return $this->belongsTo(SistemLaluan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function usercreated()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function kenderaans()
    {
        return $this->hasMany(Kenderaan::class, 'accident_id');
    }

    public function jalan()
    {
        return $this->belongsTo(Jalan::class, 'jalan_id', 'id');
    }
}
