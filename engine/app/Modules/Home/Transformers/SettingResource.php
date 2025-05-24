<?php

namespace App\Transformers;

use App\Entities\Section;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'app_name' => [
                'en' => $this['app_name_ar'],
                'ar' => $this['app_name_en'],
            ],
            'app_description' => [
                'en' => $this['app_desc_ar'],
                'ar' => $this['app_desc_en'],
            ],
            'address' => [
                'en' => $this['location'],
                'ar' => $this['location'],
            ],
            'social' => [
                'facebook' => array_column($this['socials'], null, 'key')['facebook']['value'] ?? '',
                'twitter' => array_column($this['socials'], null, 'key')['twitter']['value'] ?? '',
                'instagram' => array_column($this['socials'], null, 'key')['instagram']['value'] ?? '',
                'linkedin' => array_column($this['socials'], null, 'key')['linkedin']['value'] ?? '',
                'youtube' => array_column($this['socials'], null, 'key')['youtube']['value'] ?? '',
                'snapchat' => array_column($this['socials'], null, 'key')['snapchat']['value'] ?? '',
            ],
            'other' => [
                // "limitted_size" => $this['limitted_size'] ." MB",
                'pagination' => $this['pagination'],
                'supported_payments' => [
                    'cash','online'
                ],
                'supported_countries' => [
                    'KW'
                ],
                'privacy_policy' => "0",
                'terms' => Section::wherePageId(1)->first()->description,
                'about_us' => Section::wherePageId(2)->first()->description,
            ],
            'contact_us' => [
                'email' => $this['email'],
                'whatsapp' => $this['whatsapp'],
                'mobile' => $this['phone'],
                'technical_support' => [
                    'email' => $this['sender_email'],
                    'name' => $this['sender_name'],
                ],
            ],
            'logo' => config('app.BASE_URL').$this['app_logo'],
            'white_logo' => config('app.BASE_URL').$this['default_upload_img'],
            'favicon' => config('app.BASE_URL').$this['app_favicon'],
        ];
    }
}
