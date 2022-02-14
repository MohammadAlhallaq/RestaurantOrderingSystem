@component('mail::message')

    Welcome to Allin1UAE family, the only platform that removes all hurdles in the process of buying and
    selling of goods and services by providing a wider and secured market for legitimate businesses in the
    UAE.

    To start Selling on Allin1UAE, please complete your registration by providing the required information
    through the link below

@component('mail::button', ['url' => route('verify', $account->verifyUser->token)])
        Complete Your Registration
@endcomponent

    For further Information or Assistance, please email us on support@allin1uae.com or call 06 550 0077

    Sincerely,
    The Allin1UAE Support Team.
@endcomponent
