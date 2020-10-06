<?php
#app/Admin/Models/AdminStore.php
namespace App\Admin\Models;

use App\Models\ShopStore;
use App\Models\ShopStoreDescription;

class AdminStore extends ShopStore
{
    
    /**
     * Get all template used
     *
     * @return  [type]  [return description]
     */
    public static function getAllTemplateUsed() {
        return self::pluck('template')->all();
    }

    public static function insertDescription(array $data) {
        return ShopStoreDescription::insert($data);
    }

    /**
     * Update store description
     *
     * @param   array  $data  [$data description]
     *
     * @return  [type]        [return description]
     */
    public static function updateDescription(array $data) {
        $checkDes = ShopStoreDescription::where('store_id', $data['storeId'])
        ->where('lang', $data['lang'])
        ->first();
        if($checkDes) {
            return ShopStoreDescription::where('store_id', $data['storeId'])
            ->where('lang', $data['lang'])
            ->update([$data['name'] => $data['value']]);
        } else {
            return ShopStoreDescription::insert(
                [
                    'store_id' => $data['storeId'],
                    'lang' => $data['lang'],
                    $data['name'] => $data['value'],
                ]
            );
        }

    }
}
