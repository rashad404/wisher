<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PricingPlan;
use App\Models\PricingPlanFeature;

class PricingPlanFeatureSeeder extends Seeder
{
    public function run()
    {
        $freePlan = PricingPlan::whereJsonContains('name->en', 'Free Plan')->first();
        $standardPlan = PricingPlan::whereJsonContains('name->en', 'Standard Plan')->first();
        $premiumPlan = PricingPlan::whereJsonContains('name->en', 'Premium Plan')->first();
        $enterprisePlan = PricingPlan::whereJsonContains('name->en', 'Enterprise Plan')->first();
        
        // Free Plan Features
        PricingPlanFeature::firstOrCreate([
            'pricing_plan_id' => $freePlan->id,
            'feature_key' => [
                'en' => 'Access to Gift Catalog: Limited selection of gifts',
                'az' => 'Hədiyyə kataloquna giriş: Məhdud seçimlər'
            ]
        ]);
        PricingPlanFeature::firstOrCreate([
            'pricing_plan_id' => $freePlan->id,
            'feature_key' => [
                'en' => 'Contact Management: Manage up to 10 contacts',
                'az' => 'Əlaqələrin idarə edilməsi: 10 əlaqə idarə et'
            ]
        ]);
        PricingPlanFeature::firstOrCreate([
            'pricing_plan_id' => $freePlan->id,
            'feature_key' => [
                'en' => 'Custom Wishes: Use basic wish templates for SMS/email',
                'az' => 'Fərdi istəklər: SMS/email üçün əsas şablonlardan istifadə edin'
            ]
        ]);
        PricingPlanFeature::firstOrCreate([
            'pricing_plan_id' => $freePlan->id,
            'feature_key' => [
                'en' => 'Event Reminders: Set reminders for up to 5 events',
                'az' => 'Hadisə xatırlatmaları: 5 hadisə üçün xatırlatma qur'
            ]
        ]);
        PricingPlanFeature::firstOrCreate([
            'pricing_plan_id' => $freePlan->id,
            'feature_key' => [
                'en' => 'Gift Tracking: Basic tracking for gifts',
                'az' => 'Hədiyyə izləmə: Hədiyyələr üçün əsas izləmə'
            ]
        ]);
        PricingPlanFeature::firstOrCreate([
            'pricing_plan_id' => $freePlan->id,
            'feature_key' => [
                'en' => 'Wedding Gifts: Limited to 1 wedding event per year',
                'az' => 'Toy hədiyyələri: İldə 1 toy üçün məhdudlaşır'
            ]
        ]);
        PricingPlanFeature::firstOrCreate([
            'pricing_plan_id' => $freePlan->id,
            'feature_key' => [
                'en' => 'Santa Claus: 1 Santa wish per year',
                'az' => 'Santa Klaus: İldə 1 Santa arzusu'
            ]
        ]);

        // Standard Plan Features with translations
        $standardFeatures = [
            [
                'en' => 'Access to Gift Catalog: Expanded selection of gifts',
                'az' => 'Hədiyyə kataloquna giriş: Genişləndirilmiş seçimlər'
            ],
            [
                'en' => 'Contact Management: Manage up to 100 contacts',
                'az' => 'Əlaqələrin idarə edilməsi: 100-ə qədər əlaqəni idarə et'
            ],
            [
                'en' => 'Custom Wishes: Create personalized wishes and access premium templates',
                'az' => 'Fərdi istəklər: Şəxsi istəklər yarat və premium şablonlara daxil ol'
            ],
            [
                'en' => 'Event Reminders: Unlimited event reminders',
                'az' => 'Hadisə xatırlatmaları: Limitsiz hadisə xatırlatmaları'
            ],
            [
                'en' => 'Gift Tracking: Advanced tracking features, including notifications',
                'az' => 'Hədiyyə izləmə: Bildirişlər daxil olmaqla inkişaf etmiş izləmə xüsusiyyətləri'
            ],
            [
                'en' => 'Wedding Gifts: Unlimited wedding events with advanced registry options',
                'az' => 'Toy hədiyyələri: İnkişaf etmiş qeydiyyat seçimləri ilə limitsiz toy tədbirləri'
            ],
            [
                'en' => 'Santa Claus: 3 Santa wishes per year',
                'az' => 'Santa Klaus: İldə 3 Santa arzusu'
            ],
            [
                'en' => 'Support: Priority customer support',
                'az' => 'Dəstək: Prioritet müştəri dəstəyi'
            ],
        ];

        foreach ($standardFeatures as $feature) {
            PricingPlanFeature::firstOrCreate(['pricing_plan_id' => $standardPlan->id, 'feature_key' => $feature]);
        }

        // Premium Plan Features with translations
        $premiumFeatures = [
            [
                'en' => 'Access to Gift Catalog: Full access to premium gifts',
                'az' => 'Hədiyyə kataloquna giriş: Premium hədiyyələrə tam giriş'
            ],
            [
                'en' => 'Contact Management: Unlimited contacts',
                'az' => 'Əlaqələrin idarə edilməsi: Limitsiz əlaqələr'
            ],
            [
                'en' => 'Custom Wishes: Full customization including multimedia attachments',
                'az' => 'Fərdi istəklər: Multimedia əlavələri daxil olmaqla tam fərdiləşdirmə'
            ],
            [
                'en' => 'Event Reminders: Unlimited reminders with advanced customization',
                'az' => 'Hadisə xatırlatmaları: İnkişaf etmiş fərdiləşdirmə ilə limitsiz xatırlatmalar'
            ],
            [
                'en' => 'Gift Tracking: Real-time tracking with delivery guarantees',
                'az' => 'Hədiyyə izləmə: Çatdırılma zəmanəti ilə real vaxt izləmə'
            ],
            [
                'en' => 'Wedding Gifts: Unlimited wedding events with full customization',
                'az' => 'Toy hədiyyələri: Tam fərdiləşdirmə ilə limitsiz toy tədbirləri'
            ],
            [
                'en' => 'Santa Claus: Unlimited Santa wishes with premium gift options',
                'az' => 'Santa Klaus: Premium hədiyyə seçimləri ilə limitsiz Santa arzuları'
            ],
            [
                'en' => 'Auto-Gifting: Automatic gift selection based on preferences and budget',
                'az' => 'Avtomatik hədiyyə seçimi: Seçimlər və büdcəyə əsaslanaraq avtomatik hədiyyə seçimi'
            ],
            [
                'en' => 'Support: 24/7 priority support with a dedicated account manager',
                'az' => 'Dəstək: Müəyyən edilmiş hesab meneceri ilə 24/7 prioritet dəstək'
            ],
            [
                'en' => 'Multi-Language Support: Personalized support in multiple languages',
                'az' => 'Çoxdilli dəstək: Bir neçə dildə fərdi dəstək'
            ],
            [
                'en' => 'Analytics & Reports: Detailed reports on gifting trends and contact engagement',
                'az' => 'Analitik və hesabatlar: Hədiyyə meylləri və əlaqə cəlbediciliyi haqqında ətraflı hesabatlar'
            ],
        ];

        foreach ($premiumFeatures as $feature) {
            PricingPlanFeature::firstOrCreate(['pricing_plan_id' => $premiumPlan->id, 'feature_key' => $feature]);
        }

        // Enterprise Plan Features with translations
        $enterpriseFeatures = [
            [
                'en' => 'Tailored Solutions: Customized features and integrations',
                'az' => 'Uyğunlaşdırılmış həllər: Fərdiləşdirilmiş xüsusiyyətlər və inteqrasiyalar'
            ],
            [
                'en' => 'Dedicated Account Manager: Full support with a dedicated account manager',
                'az' => 'Xüsusi hesab meneceri: Müəyyən edilmiş hesab meneceri ilə tam dəstək'
            ],
            [
                'en' => 'API Access: For integrating with corporate systems or third-party applications',
                'az' => 'API Girişi: Korporativ sistemlər və ya üçüncü tərəf tətbiqləri ilə inteqrasiya üçün'
            ],
            [
                'en' => 'White-Labeling: Custom branding options for large organizations',
                'az' => 'Ağ Etiket: Böyük təşkilatlar üçün xüsusi marka seçimləri'
            ],
            [
                'en' => 'Custom Analytics: Advanced reporting tailored to business needs',
                'az' => 'Xüsusi Analitika: Biznes ehtiyaclarına uyğun inkişaf etmiş hesabat'
            ],
            [
                'en' => 'Custom Santa Claus Experience: For large events or corporate gifting',
                'az' => 'Xüsusi Santa Klaus Təcrübəsi: Böyük tədbirlər və ya korporativ hədiyyələr üçün'
            ],
        ];

        foreach ($enterpriseFeatures as $feature) {
            PricingPlanFeature::firstOrCreate(['pricing_plan_id' => $enterprisePlan->id, 'feature_key' => $feature]);
        }
    }
}
