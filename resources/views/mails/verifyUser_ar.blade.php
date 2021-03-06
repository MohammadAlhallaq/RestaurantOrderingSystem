@component('mail::message')

    نرحب بك في عائلة  ، All in 1 UAEالمنصة الوحيدة التي تسهل عملية الشراء والبيع للسلع والخدمات من
    خلال توفير سوق آمن وأوسع للأعمال التجارية في الإمارات العربية المتحدة.

    لكي تتمكن من البيع عبر All in 1 UAE يرجى إتمام عملية التسجيل عن طريق توفير المعلومات
    المطلوبة من خلال الرابط أدناه.

@component('mail::button', ['url' => route('verify', $account->verifyUser->token)])
    إتمام عملية التسجيل
@endcomponent

    للمزيد من المعلومات أو إذا كان لديكم أي استفسارات يمكنكم التواصل معنا عبر البريد الالكتروني
    06 550 0077 أو يمكنكم الاتصال على support@allin1uae.com

    مع تحيات،
    All in 1 UAE فريق
@endcomponent
