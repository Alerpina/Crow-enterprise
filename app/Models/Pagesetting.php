<?php

namespace App\Models;

use Spatie\Activitylog\Traits\LogsActivity;

class Pagesetting extends LocalizedModel
{
    use LogsActivity;
    
    protected static $logName = 'page_settings';
    protected static $logFillable = true;
    protected static $logOnlyDirty = true;

    protected $with = ['translations'];
    
    public $translatedAttributes = ['contact_success', 'contact_title', 'contact_text', 'side_title', 'side_text'];
    protected $fillable = [
        'contact_email',
        'street',
        'phone',
        'fax',
        'email',
        'site',
        'slider',
        'service',
        'featured',
        'small_banner',
        'best',
        'top_rated',
        'large_banner',
        'big',
        'hot_sale',
        'best_seller_banner',
        'best_seller_banner_link',
        'big_save_banner',
        'big_save_banner_link',
        'best_seller_banner1',
        'best_seller_banner_link1',
        'big_save_banner1',
        'big_save_banner_link1',
        'partners',
        'bottom_small',
        'flash_deal',
        'featured_category',
        'random_banners',
        'random_products',
        'store_id',
        'blog_posts',
        'reviews_store'
    ];

    public $timestamps = false;

    public function upload($name, $file, $oldname)
    {
        $file->move('assets/images', $name);
        if ($oldname != null) {
            if (file_exists(public_path() . '/assets/images/' . $oldname)) {
                unlink(public_path() . '/assets/images/' . $oldname);
            }
        }
    }
}
