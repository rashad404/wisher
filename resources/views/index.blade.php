@extends('layouts.app')

@section('content')
<div class="mx-auto">
  <div class="relative bg-white">
    <h1 class="text-center mt-8 mb-6 text-3xl font-semibold tracking-tight text-red-500 sm:text-4xl">TEZLIKLƏ!</h1>
      <div class="my-12 mx-auto max-w-7xl lg:flex lg:justify-between lg:px-8 xl:justify-end">

        <div class="lg:flex ">
            <img class="max-h-screen object-cover" src="{{ asset('images/wish-banner.jpg') }}" alt="Wisher.az">
        </div>

        <div class="pl-12">
          <div class="mx-auto ">
            <h1 class="mt-2 text-3xl font-semibold tracking-tight text-indigo-900 sm:text-4xl">Hədiyyə və Arzuların Ünvanı!</h1>
            

            <p class="mt-6 text-xl leading-8 text-gray-700">Wisher.az xüsusi günləri xatırlamaq və qeyd etmək üçün şəxsi köməkçinizdir. </p>
            <p class="mt-6 text-xl leading-8 text-gray-700">Siz onu ad günləri, yubileylər və ya hər hansı mühüm tarixlərdə avtomatik olaraq sms mesaj və ya elektron poçt göndərmək üçün istifadə edə bilərsiniz və hətta avtomatik hədiyyələr göndərə bilərsiniz. </p>
            <p class="mt-6 text-xl leading-8 text-gray-700">Hədiyyə və mesajlar hər bir şəxsə uyğun fərdiləşdirilə bilinir.</p>
            <p class="mt-6 text-xl leading-8 text-gray-700">Wisher.az -dan həm fərdi şəxslər, həm də şirkətlər istifadə edə bilər.</p>
            <p class="mt-6 text-xl leading-8 text-gray-700">Şirkətlər üçün hədiyyə / təbrik prosesini avtomatikləşdirmək və hər bir işçiyə və ya biznes partnyora dəyərli olduğunu hiss etdirmək daha asan olacaq.</p>
            <p class="mt-6 text-xl leading-8 text-gray-700">Artıq vacib tarixləri unutmaq və ya düzgün hədiyyələr seçməklə bağlı narahatlığınız olmayacaq - Wisher.az hər bir anı həm sizin, həm də sevdikləriniz üçün xüsusi edərək, bütün bunların qayğısına qalır.</p>
            
          </div>
        </div>
      </div>
    </div>
    
  </div>
@endsection
