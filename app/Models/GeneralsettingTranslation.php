<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Contracts\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class GeneralsettingTranslation extends CachedModel
{
    use LogsActivity;

    protected static $logName = 'generalsetting';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;
    
    public $timestamps = false;
    protected $fillable = [
        'title',
        'footer',
        'copyright',
        'cod_text',
        'popup_title',
        'popup_text',
        'maintain_text',
        'bancard_text',
        'mercadopago_text',
        'cielo_text',
        'pagseguro_text',
        'pagopar_text',
        'bank_text',
        'pagarme_text',
        'rede_text',
        'page_not_found_text',
        'policy',
        'crow_policy',
        'privacy_policy',
        'vendor_policy'
    ];

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->properties = $activity->properties->put('generalsetting_id', $this->generalsetting_id);
        $activity->properties = $activity->properties->put('locale', $this->locale);
    }
}
