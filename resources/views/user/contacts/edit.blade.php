@extends('layouts.user.app')

@section('content')

<form>
    <div class="space-y-12 sm:space-y-16">
      <div>
        <h2 class="text-base font-semibold leading-7 text-gray-900">Dəyiş</h2>
        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-600">Lorem İpsum...</p>

        <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">



          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
            <label for="photo" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Photo</label>
            <div class="mt-2 sm:col-span-2 sm:mt-0">
              <div class="flex max-w-2xl justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                <div class="text-center">
                  <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                  </svg>
                  <div class="mt-4 flex text-sm leading-6 text-gray-600">
                    <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                      <span>Upload a file</span>
                      <input id="file-upload" name="file-upload" type="file" class="sr-only">
                    </label>
                    <p class="pl-1">or drag and drop</p>
                  </div>
                  <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div>
        <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-600">Use a permanent address where you can receive mail.</p>

        <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">
          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
            <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Name</label>
            <div class="mt-2 sm:col-span-2 sm:mt-0">
              <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
            </div>
          </div>


          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Email address</label>
            <div class="mt-2 sm:col-span-2 sm:mt-0">
              <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-md sm:text-sm sm:leading-6">
            </div>
          </div>


          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
            <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Street address</label>
            <div class="mt-2 sm:col-span-2 sm:mt-0">
              <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xl sm:text-sm sm:leading-6">
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
            <label for="city" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">City</label>
            <div class="mt-2 sm:col-span-2 sm:mt-0">
              <input type="text" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
            <label for="region" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">State / Province</label>
            <div class="mt-2 sm:col-span-2 sm:mt-0">
              <input type="text" name="region" id="region" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
            </div>
          </div>

          <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
            <label for="postal-code" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">ZIP / Postal code</label>
            <div class="mt-2 sm:col-span-2 sm:mt-0">
              <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6">
            </div>
          </div>
        </div>
      </div>

      <div>
        <h2 class="text-base font-semibold leading-7 text-gray-900">Notifications</h2>
        <p class="mt-1 max-w-2xl text-sm leading-6 text-gray-600">We'll always let you know about important changes, but you pick what else you want to hear about.</p>

        <div class="mt-10 space-y-10 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">
          <fieldset>
            <legend class="sr-only">By Email</legend>
            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:py-6">
              <div class="text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">By Email</div>
              <div class="mt-4 sm:col-span-2 sm:mt-0">
                <div class="max-w-lg space-y-6">
                  <div class="relative flex gap-x-3">
                    <div class="flex h-6 items-center">
                      <input id="comments" name="comments" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    </div>
                    <div class="text-sm leading-6">
                      <label for="comments" class="font-medium text-gray-900">Comments</label>
                      <p class="mt-1 text-gray-600">Get notified when someones posts a comment on a posting.</p>
                    </div>
                  </div>
                  <div class="relative flex gap-x-3">
                    <div class="flex h-6 items-center">
                      <input id="candidates" name="candidates" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    </div>
                    <div class="text-sm leading-6">
                      <label for="candidates" class="font-medium text-gray-900">Candidates</label>
                      <p class="mt-1 text-gray-600">Get notified when a candidate applies for a job.</p>
                    </div>
                  </div>
                  <div class="relative flex gap-x-3">
                    <div class="flex h-6 items-center">
                      <input id="offers" name="offers" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    </div>
                    <div class="text-sm leading-6">
                      <label for="offers" class="font-medium text-gray-900">Offers</label>
                      <p class="mt-1 text-gray-600">Get notified when a candidate accepts or rejects an offer.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
          <!--
          <fieldset>
            <legend class="sr-only">Push Notifications</legend>
            <div class="sm:grid sm:grid-cols-3 sm:items-baseline sm:gap-4 sm:py-6">
              <div class="text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">Push Notifications</div>
              <div class="mt-1 sm:col-span-2 sm:mt-0">
                <div class="max-w-lg">
                  <p class="text-sm leading-6 text-gray-600">These are delivered via SMS to your mobile phone.</p>
                  <div class="mt-6 space-y-6">
                    <div class="flex items-center gap-x-3">
                      <input id="push-everything" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                      <label for="push-everything" class="block text-sm font-medium leading-6 text-gray-900">Everything</label>
                    </div>
                    <div class="flex items-center gap-x-3">
                      <input id="push-email" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                      <label for="push-email" class="block text-sm font-medium leading-6 text-gray-900">Same as email</label>
                    </div>
                    <div class="flex items-center gap-x-3">
                      <input id="push-nothing" name="push-notifications" type="radio" class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                      <label for="push-nothing" class="block text-sm font-medium leading-6 text-gray-900">No push notifications</label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
          <!-->
        </div>
      </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="button" class="text-sm font-semibold leading-6 text-gray-900">Cancel</button>
      <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
  </form>


    <div class="container">
    <form method="POST" action="{{ route('user.contacts.update', $contact->id) }}">
    @csrf
    @method('PUT') <!-- Use PUT method for updating -->

    <div class="mt-10 space-y-8 border-b border-gray-900/10 pb-12 sm:space-y-0 sm:divide-y sm:divide-gray-900/10 sm:border-t sm:pb-0">

        <!-- Name Field -->
        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
            <label for="name" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Name:</label>
            <div class="mt-2 sm:col-span-2 sm:mt-0">
                <input type="text" name="name" id="name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" value="{{ $contact->name }}">
            </div>
        </div>

        <!-- Email Field -->
        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
            <label for="email" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Email:</label>
            <div class="mt-2 sm:col-span-2 sm:mt-0">
                <input type="email" name="email" id="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" value="{{ $contact->email }}">
            </div>
        </div>

        <!-- Phone Number Field -->
        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
            <label for="phone_number" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Phone Number:</label>
            <div class="mt-2 sm:col-span-2 sm:mt-0">
                <input type="text" name="phone_number" id="phone_number" autocomplete="tel" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" value="{{ $contact->phone_number }}">
            </div>
        </div>

        <!-- Birthdate Field -->
        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
            <label for="birthdate" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Birthdate:</label>
            <div class="mt-2 sm:col-span-2 sm:mt-0">
                <input type="date" name="birthdate" id="birthdate" autocomplete="bday" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" value="{{ $contact->birthdate }}">
            </div>
        </div>

        <!-- Interests Field
        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
            <label for="interests" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Interests:</label>
            <div class="mt-2 sm:col-span-2 sm:mt-0">
                <input type="text" name="interests" id="interests" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" value="{{ $contact->interests }}">
            </div>
        </div>
        -->
        <!-- Likes Field
        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
            <label for="likes" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Likes:</label>
            <div class="mt-2 sm:col-span-2 sm:mt-0">
                <input type="text" name="likes" id="likes" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" value="{{ $contact->likes }}">
            </div>
        </div>
        -->
        <!-- Dislikes Field
        <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:py-6">
            <label for="dislikes" class="block text-sm font-medium leading-6 text-gray-900 sm:pt-1.5">Dislikes:</label>
            <div class="mt-2 sm:col-span-2 sm:mt-0">
                <input type="text" name="dislikes" id="dislikes" autocomplete="off" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:max-w-xs sm:text-sm sm:leading-6" value="{{ $contact->dislikes }}">
            </div>
        </div>
        -->
    </div>

    <button type="submit" class="inline-flex justify-center rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 mt-4">Update Contact</button>
    </form>
    </div>
@endsection
