<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Blackspot extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $auditInclude = [
        'id', 'mid_latitude', 'mid_logitude', 'tahun', 'negeri_id', 'no_laluan',
        'pos_km1', 'pos_km2', 'nombor_seksyen', 'jenis_langgar_pertama_id',
    ];

    protected $fillable = [
        'mid_latitude', 'mid_logitude', 'tahun', 'negeri_id', 'no_laluan',
        'pos_km1', 'pos_km2', 'nombor_seksyen', 'jenis_langgar_pertama_id',
        'bil_maut', 'bil_parah', 'bil_ringan', 'bil_rosak', 'id_accident',
    ];

    /**
     * Relationships
     */
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

    /**
     * Retrieve accident details by ID.
     *
     * @param int $id
     * @return \App\Models\Accident|null
     */
    public function get_id_detail($id)
    {
        return \App\Models\Accident::find($id);
    }

    /**
     * Retrieve accident details and build an array of spots.
     *
     * @return array
     */
    public function get_id_accident(): array
    {
        // Use value from database attributes and split into an array of primary keys
        $pks = explode(",", $this->attributes['id_accident']);
        $spot = [];

        foreach ($pks as $b) {
            $accident = $this->get_id_detail($b);
            $spot[$b] = [
                'latitude' => $accident->latitude ?? null,
                'longitude' => $accident->logitude ?? null,
                'jenis_kemalangan' => $accident->jenisKemalangan->name ?? null,
                'negeri' => $accident->negeri->name ?? null,
            ];
        }

        return $spot;
    }
}
