<?php

namespace Modules\LandingPage\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Utility;

class LandingPageSetting extends Model
{
    use HasFactory;

    protected $table = 'landing_page_settings';
    private static $settings = null;

    protected $fillable = [
        'name',
        'value'
    ];

    protected static function newFactory()
    {
        return \Modules\LandingPage\Database\factories\LandingPageSettingFactory::new();
    }
    public static function settings()
    {
        if (self::$settings === null) {
            self::$settings = self::fetchSettings();
        }

        return self::$settings;
    }
    public static function fetchSettings()
    {
        $data = LandingPageSetting::get();

        $settings = [
            "topbar_status" => "on",
            "topbar_notification_msg" => "70% Special Offer. Don’t Miss it. The offer ends in 72 hours.",

            "menubar_status" => 'on',
            "menubar_page" => '"menubar_page_name": "About Us","template_name": "page_content","page_url": "","menubar_page_contant": "Welcome to the Salesy website. By accessing this website, you agree to comply with and be bound by the following terms and conditions of use. If you disagree with any part of these terms, please do not use our website. The content of the pages of this website is for your general information and use only. It is subject to change without notice. This website uses cookies to monitor browsing preferences. If you do allow cookies to be used, personal information may be stored by us for use by third parties. Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness, or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors, and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law. Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services, or information available through this website meet your specific requirements. This website contains material that is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance, and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions. Unauthorized use of this website may give rise to a claim for damages and/or be a criminal offense. From time to time, this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s","page_slug": "about_us","header": "on","footer": "on","login": "on","menubar_page_name": "Terms and Conditions","template_name": "page_content","page_url": "","menubar_page_contant": "Welcome to the Salesy website. By accessing this website, you agree to comply with and be bound by the following terms and conditions of use. If you disagree with any part of these terms, please do not use our website."',

            "site_logo" => 'site_logo.png',
            "site_description" => 'We build modern web tools to help you jump-start your daily business work.',
            "home_status" => 'on',
            "home_offer_text" => '70% Special Offer',
            "home_title" => 'Home',
            "home_heading" => 'Salesy SaaS Business Sales CRM',
            "home_description" => 'Use these awesome forms to login or create new account in your project for free.',
            "home_trusted_by" => '1000+ Customer',
            "home_live_demo_link" => 'https://demo.workdo.io/salesy-saas/login',
            "home_buy_now_link" => 'https://codecanyon.net/item/salesy-saas-business-sales-crm/30241292',
            "home_banner" => 'home_banner.png',
            "home_logo" => 'home_logo.png,home_logo.png,home_logo.png,home_logo.png,home_logo.png,home_logo.png,home_logo.png',

            "feature_status" => 'on',
            "feature_title" => 'Features',
            "feature_heading" => 'All In One Place CRM System',
            "feature_description" => 'Use these awesome forms to login or create new account in your project for free. Use these awesome forms to login or create new account in your project for free.',
            "feature_buy_now_link" => 'https://codecanyon.net/item/salesy-saas-business-sales-crm/30241292',
            "feature_of_features" => '[{"feature_logo":"1688098315-feature_logo.png","feature_heading":"Feature","feature_description":"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\/p>"},{"feature_logo":"1688098341-feature_logo.png","feature_heading":"Support","feature_description":"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\/p>"},{"feature_logo":"1688098361-feature_logo.png","feature_heading":"Integration","feature_description":"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\/p>"}]',

            "highlight_feature_heading" => 'Salesy SaaS Business Sales CRM',
            "highlight_feature_description" => 'Use these awesome forms to login or create new account in your project for free.',
            "highlight_feature_image" => 'highlight_feature_image.png',
            "other_features" => '[{"other_features_image":"1688099489-other_features_image.png","other_features_heading":"Salesy SaaS Business Sales CRM","other_featured_description":"<p>Use these awesome forms to login or create new account in your project for free.<\/p>","other_feature_buy_now_link":"https://codecanyon.net/item/salesy-saas-business-sales-crm/30241292"},{"other_features_image":"1688099498-other_features_image.png","other_features_heading":"Salesy SaaS Business Sales CRM","other_featured_description":"<p>Use these awesome forms to login or create new account in your project for free.<\/p>","other_feature_buy_now_link":"https://codecanyon.net/item/salesy-saas-business-sales-crm/30241292"},{"other_features_image":"1688099511-other_features_image.png","other_features_heading":"Salesy SaaS Business Sales CRM","other_featured_description":"<p>Use these awesome forms to login or create new account in your project for free.<\/p>","other_feature_buy_now_link":"https://codecanyon.net/item/salesy-saas-business-sales-crm/30241292"},{"other_features_image":"1688099560-other_features_image.png","other_features_heading":"Salesy SaaS Business Sales CRM","other_featured_description":"<p>Use these awesome forms to login or create new account in your project for free.<\/p>","other_feature_buy_now_link":"https://codecanyon.net/item/salesy-saas-business-sales-crm/30241292"}]',

            "discover_status" => 'on',
            "discover_heading" => 'Salesy SaaS Business Sales CRM',
            "discover_description" => 'Use these awesome forms to login or create new account in your project for free.',
            "discover_live_demo_link" => 'https://demo.workdo.io/salesy-saas/login',
            "discover_buy_now_link" => 'https://codecanyon.net/item/salesy-saas-business-sales-crm/30241292',
            "discover_of_features" => '[{"discover_logo":"1688098424-discover_logo.png","discover_heading":"Feature","discover_description":"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\/p>"},{"discover_logo":"1688098461-discover_logo.png","discover_heading":"Feature","discover_description":"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\/p>"},{"discover_logo":"1688098477-discover_logo.png","discover_heading":"Feature","discover_description":"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\/p>"},{"discover_logo":"1688098488-discover_logo.png","discover_heading":"Feature","discover_description":"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\/p>"},{"discover_logo":"1688098497-discover_logo.png","discover_heading":"Feature","discover_description":"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\/p>"},{"discover_logo":"1688098507-discover_logo.png","discover_heading":"Feature","discover_description":"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\/p>"},{"discover_logo":"1688098516-discover_logo.png","discover_heading":"Feature","discover_description":"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\/p>"},{"discover_logo":"1688098526-discover_logo.png","discover_heading":"Feature","discover_description":"<p>Use these awesome forms to login or create new account in your project for free.Use these awesome forms to login or create new account in your project for free.<\/p>"}]',

            "screenshots_status" => 'on',
            "screenshots_heading" => 'Salesy SaaS Business Sales CRM',
            "screenshots_description" => 'Use these awesome forms to login or create new account in your project for free.',
            "screenshots" => '[{"screenshots":"1688098566-screenshots.png","screenshots_heading":"Salesy Dashboard"},{"screenshots":"1688099065-screenshots.png","screenshots_heading":"Grid View Page"},{"screenshots":"1688098863-screenshots.png","screenshots_heading":"Profile Overview"},{"screenshots":"1688098948-screenshots.png","screenshots_heading":"Dashboard"},{"screenshots":"1688098996-screenshots.png","screenshots_heading":"Kanban Page"},{"screenshots":"1688099209-screenshots.png","screenshots_heading":"Product Overview"}]',

            "plan_status" => 'on',
            "plan_title" => 'Plan',
            "plan_heading" => 'Salesy SaaS Business Sales CRM',
            "plan_description" => 'Use these awesome forms to login or create new account in your project for free.',

            "faq_status" => 'on',
            "faq_title" => 'Faq',
            "faq_heading" => 'Salesy SaaS Business Sales CRM',
            "faq_description" => 'Use these awesome forms to login or create new account in your project for free.',
            "faqs" => '[{"faq_questions":"#What does \"Theme\/Package Installation\" mean?","faq_answer":"For an easy-to-install theme\/package, we have included step-by-step detailed documentation (in English). However, if it is not done perfectly, please feel free to contact the support team at support@workdo.io"},{"faq_questions":"#What does \"Theme\/Package Installation\" mean?","faq_answer":"For an easy-to-install theme\/package, we have included step-by-step detailed documentation (in English). However, if it is not done perfectly, please feel free to contact the support team at support@workdo.io"},{"faq_questions":"#What does \"Lifetime updates\" mean?","faq_answer":"For an easy-to-install theme\/package, we have included step-by-step detailed documentation (in English). However, if it is not done perfectly, please feel free to contact the support team at support@workdo.io"},{"faq_questions":"#What does \"Lifetime updates\" mean?","faq_answer":"For an easy-to-install theme\/package, we have included step-by-step detailed documentation (in English). However, if it is not done perfectly, please feel free to contact the support team at support@workdo.io"},{"faq_questions":"# What does \"6 months of support\" mean?","faq_answer":"Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa\r\n                                    nesciunt\r\n                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt\r\n                                    sapiente ea\r\n                                    proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven heard of them accusamus labore sustainable VHS."},{"faq_questions":"# What does \"6 months of support\" mean?","faq_answer":"Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa\r\n                                    nesciunt\r\n                                    laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt\r\n                                    sapiente ea\r\n                                    proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven heard of them accusamus labore sustainable VHS."}]',

            "testimonials_status" => 'on',
            "testimonials_heading" => 'From our Clients',
            "testimonials_description" => 'Use these awesome forms to login or create new account in your project for free.',
            "testimonials_long_description" => 'WorkDo seCommerce package offers you a “sales-ready.”secure online store.',
            "testimonials" => '[{"testimonials_user_avtar":"1688099358-testimonials_user_avtar.jpg","testimonials_title":"Tbistone","testimonials_description":"Very quick customer support, installing this application on my machine locally, within 5 minutes of creating a ticket, the developer was able to fix the issue I had within 10 minutes. EXCELLENT! Thank you very much","testimonials_user":"Chordsnstrings","testimonials_designation":"from codecanyon","testimonials_star":"4"},{"testimonials_user_avtar":"1688099364-testimonials_user_avtar.jpg","testimonials_title":"Tbistone","testimonials_description":"Very quick customer support, installing this application on my machine locally, within 5 minutes of creating a ticket, the developer was able to fix the issue I had within 10 minutes. EXCELLENT! Thank you very much","testimonials_user":"Chordsnstrings","testimonials_designation":"from codecanyon","testimonials_star":"4"},{"testimonials_user_avtar":"1688099371-testimonials_user_avtar.jpg","testimonials_title":"Tbistone","testimonials_description":"Very quick customer support, installing this application on my machine locally, within 5 minutes of creating a ticket, the developer was able to fix the issue I had within 10 minutes. EXCELLENT! Thank you very much","testimonials_user":"Chordsnstrings","testimonials_designation":"from codecanyon","testimonials_star":"4"}]',

            "footer_status" => 'on',
            "joinus_status" => 'on',
            "joinus_heading" => 'Join Our Community',
            "joinus_description" => 'We build modern web tools to help you jump-start your daily business work.'

        ];

        foreach ($data as $row) {
            $settings[$row->name] = $row->value;
        }

        return $settings;
    }


    public static function upload_file($request, $key_name, $name, $path, $custom_validation = [])
    {
        try {
            $settings = Utility::getStorageSetting();

            if (!empty($settings['storage_setting'])) {

                if ($settings['storage_setting'] == 'wasabi') {

                    config(
                        [
                            'filesystems.disks.wasabi.key' => $settings['wasabi_key'],
                            'filesystems.disks.wasabi.secret' => $settings['wasabi_secret'],
                            'filesystems.disks.wasabi.region' => $settings['wasabi_region'],
                            'filesystems.disks.wasabi.bucket' => $settings['wasabi_bucket'],
                            'filesystems.disks.wasabi.endpoint' => 'https://s3.' . $settings['wasabi_region'] . '.wasabisys.com'
                        ]
                    );

                    $max_size = !empty($settings['wasabi_max_upload_size']) ? $settings['wasabi_max_upload_size'] : '2048';
                    $mimes =  !empty($settings['wasabi_storage_validation']) ? $settings['wasabi_storage_validation'] : '';
                } else if ($settings['storage_setting'] == 's3') {
                    config(
                        [
                            'filesystems.disks.s3.key' => $settings['s3_key'],
                            'filesystems.disks.s3.secret' => $settings['s3_secret'],
                            'filesystems.disks.s3.region' => $settings['s3_region'],
                            'filesystems.disks.s3.bucket' => $settings['s3_bucket'],
                            'filesystems.disks.s3.use_path_style_endpoint' => false,
                        ]
                    );
                    $max_size = !empty($settings['s3_max_upload_size']) ? $settings['s3_max_upload_size'] : '2048';
                    $mimes =  !empty($settings['s3_storage_validation']) ? $settings['s3_storage_validation'] : '';
                } else {

                    $max_size = !empty($settings['local_storage_max_upload_size']) ? $settings['local_storage_max_upload_size'] : '20480000000';

                    $mimes =  !empty($settings['local_storage_validation']) ? $settings['local_storage_validation'] : '';
                }


                $file = $request->$key_name;

                if (count($custom_validation) > 0) {

                    $validation = $custom_validation;
                } else {

                    $validation = [
                        'mimes:' . $mimes,
                        'max:' . $max_size,
                    ];
                }

                $validator = \Validator::make($request->all(), [
                    $key_name => $validation
                ]);

                if ($validator->fails()) {

                    $res = [
                        'flag' => 0,
                        'msg' => $validator->messages()->first(),
                    ];

                    return $res;
                } else {

                    $name = $name;

                    if ($settings['storage_setting'] == 'local') {
                        $request->$key_name->move(storage_path($path), $name);
                        $path = $path . $name;
                    } else if ($settings['storage_setting'] == 'wasabi') {

                        $path = \Storage::disk('wasabi')->putFileAs(
                            $path,
                            $file,
                            $name
                        );
                    } else if ($settings['storage_setting'] == 's3') {

                        $path = \Storage::disk('s3')->putFileAs(
                            $path,
                            $file,
                            $name
                        );
                    }



                    $res = [
                        'flag' => 1,
                        'msg'  => 'success',
                        'url'  => $path
                    ];
                    return $res;
                }
            } else {
                $res = [
                    'flag' => 0,
                    'msg' => __('Please set proper configuration for storage.'),
                ];
                return $res;
            }
        } catch (\Exception $e) {

            $res = [
                'flag' => 0,
                'msg' => $e->getMessage(),
            ];
            return $res;
        }
    }

    public static function keyWiseUpload_file($request, $key_name, $name, $path, $data_key, $custom_validation = [])
    {

        $multifile = [
            $key_name => $request->file($key_name)[$data_key][$key_name],
        ];


        try {
            $settings = Utility::getStorageSetting();


            if (!empty($settings['storage_setting'])) {

                if ($settings['storage_setting'] == 'wasabi') {

                    config(
                        [
                            'filesystems.disks.wasabi.key' => $settings['wasabi_key'],
                            'filesystems.disks.wasabi.secret' => $settings['wasabi_secret'],
                            'filesystems.disks.wasabi.region' => $settings['wasabi_region'],
                            'filesystems.disks.wasabi.bucket' => $settings['wasabi_bucket'],
                            'filesystems.disks.wasabi.endpoint' => 'https://s3.' . $settings['wasabi_region'] . '.wasabisys.com'
                        ]
                    );

                    $max_size = !empty($settings['wasabi_max_upload_size']) ? $settings['wasabi_max_upload_size'] : '2048';
                    $mimes =  !empty($settings['wasabi_storage_validation']) ? $settings['wasabi_storage_validation'] : '';
                } else if ($settings['storage_setting'] == 's3') {
                    config(
                        [
                            'filesystems.disks.s3.key' => $settings['s3_key'],
                            'filesystems.disks.s3.secret' => $settings['s3_secret'],
                            'filesystems.disks.s3.region' => $settings['s3_region'],
                            'filesystems.disks.s3.bucket' => $settings['s3_bucket'],
                            'filesystems.disks.s3.use_path_style_endpoint' => false,
                        ]
                    );
                    $max_size = !empty($settings['s3_max_upload_size']) ? $settings['s3_max_upload_size'] : '2048';
                    $mimes =  !empty($settings['s3_storage_validation']) ? $settings['s3_storage_validation'] : '';
                } else {
                    $max_size = !empty($settings['local_storage_max_upload_size']) ? $settings['local_storage_max_upload_size'] : '2048';

                    $mimes =  !empty($settings['local_storage_validation']) ? $settings['local_storage_validation'] : '';
                }


                $file = $request->$key_name;


                if (count($custom_validation) > 0) {
                    $validation = $custom_validation;
                } else {

                    $validation = [
                        'mimes:' . $mimes,
                        'max:' . $max_size,
                    ];
                }

                $validator = \Validator::make($multifile, [
                    $key_name => $validation
                ]);


                if ($validator->fails()) {
                    $res = [
                        'flag' => 0,
                        'msg' => $validator->messages()->first(),
                    ];
                    return $res;
                } else {

                    $name = $name;

                    if ($settings['storage_setting'] == 'local') {

                        \Storage::disk()->putFileAs(
                            $path,
                            $request->file($key_name)[$data_key][$key_name],
                            $name
                        );


                        $path = $name;
                    } else if ($settings['storage_setting'] == 'wasabi') {

                        $path = \Storage::disk('wasabi')->putFileAs(
                            $path,
                            $file,
                            $name
                        );

                        // $path = $path.$name;

                    } else if ($settings['storage_setting'] == 's3') {

                        $path = \Storage::disk('s3')->putFileAs(
                            $path,
                            $file,
                            $name
                        );
                    }


                    $res = [
                        'flag' => 1,
                        'msg'  => 'success',
                        'url'  => $path
                    ];
                    return $res;
                }
            } else {
                $res = [
                    'flag' => 0,
                    'msg' => __('Please set proper configuration for storage.'),
                ];
                return $res;
            }
        } catch (\Exception $e) {
            $res = [
                'flag' => 0,
                'msg' => $e->getMessage(),
            ];
            return $res;
        }
    }
}
