<script setup>
import { Head, Link, router } from '@inertiajs/vue3';
import QrCard from '@/Components/QrCard.vue';
import moment from 'moment'

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
  qr_requests: Array,
});

const switchToCreate = () => {
    router.get(route('qrs.create'));
};

const deleteRow = (id) => {
  router.delete(route('qrs.destroy', id));
}

</script>

<template>
    <Head title="QR Requests" />

    <QrCard>
      <div class="relative sm:flex sm:justify-center sm:items-center bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</Link>

            <template v-else>
                <Link :href="route('login')" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</Link>
            </template>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8 w-full">
            <div class="mt-0">
              <div class="align-middle left-0">
                <button @click="switchToCreate()" type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                  Create
                </button>
              </div>
              <ul class="divide-y divide-gray-200">
                <li :key="header" class="py-4 flex justify-between">
                  <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">No</p>
                  </div>
                  <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">Title</p>
                  </div>
                  <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">Created At</p>
                  </div>
                  <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">Actions</p>
                  </div>
                </li>
                <li v-for="(req, index) in qr_requests" :key="req.id" class="py-4 flex justify-between">
                  <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">{{index + 1}}</p>
                  </div>
                  <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">{{ req.title }}</p>
                  </div>
                  <div class="ml-3">
                    <p class="text-sm font-medium text-gray-900">{{ moment(req.created_at).format('MM/DD/YYYY') }}</p>
                  </div>
                  <div class="ml-3 flex gap-1">
                    <a :href="route('qrs.show', req.id)">
                      <svg class="hover:fill-red-400" fill="#000000" width="16px" height="16px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                        viewBox="0 0 64 64" xml:space="preserve">
                        <g>
                          <rect x="38" y="23" width="2" height="5"/>
                          <rect x="42" y="23" width="2" height="5"/>
                          <rect x="38" y="30" width="2" height="2"/>
                          <rect x="42" y="30" width="2" height="2"/>
                          <rect x="31" y="34" width="2" height="2"/>
                          <rect x="26" y="54" width="2" height="2"/>
                          <rect x="42" y="34" width="2" height="2"/>
                          <rect x="38" y="38" width="2" height="2"/>
                          <rect x="42" y="38" width="2" height="2"/>
                          <path d="M2,2h3V0H1C0.448,0,0,0.448,0,1v4h2V2z"/>
                          <path d="M63,0h-4v2h3v3h2V1C64,0.448,63.552,0,63,0z"/>
                          <path d="M2,59H0v4c0,0.552,0.448,1,1,1h4v-2H2V59z"/>
                          <path d="M62,62h-3v2h4c0.552,0,1-0.448,1-1v-4h-2V62z"/>
                          <path d="M4,5v12c0,0.552,0.448,1,1,1h12c0.552,0,1-0.448,1-1V5c0-0.552-0.448-1-1-1H5C4.448,4,4,4.448,4,5z M6,6h10v10H6V6z"/>
                          <path d="M13,8H9C8.448,8,8,8.448,8,9v4c0,0.552,0.448,1,1,1h4c0.552,0,1-0.448,1-1V9C14,8.448,13.552,8,13,8z M12,12h-2v-2h2V12z"
                            />
                          <path d="M47,18h12c0.552,0,1-0.448,1-1V5c0-0.552-0.448-1-1-1H47c-0.552,0-1,0.448-1,1v12C46,17.552,46.448,18,47,18z M48,6h10v10
                            H48V6z"/>
                          <path d="M55,8h-4c-0.552,0-1,0.448-1,1v4c0,0.552,0.448,1,1,1h4c0.552,0,1-0.448,1-1V9C56,8.448,55.552,8,55,8z M54,12h-2v-2h2V12z
                            "/>
                          <path d="M17,46H5c-0.552,0-1,0.448-1,1v12c0,0.552,0.448,1,1,1h12c0.552,0,1-0.448,1-1V47C18,46.448,17.552,46,17,46z M16,58H6V48
                            h10V58z"/>
                          <path d="M9,56h4c0.552,0,1-0.448,1-1v-4c0-0.552-0.448-1-1-1H9c-0.552,0-1,0.448-1,1v4C8,55.552,8.448,56,9,56z M10,52h2v2h-2V52z"
                            />
                          <path d="M44,19h-7V7h-2v13c0,0.552,0.448,1,1,1h8V19z"/>
                          <rect x="22" y="12" width="7" height="2"/>
                          <rect x="26" y="8" width="7" height="2"/>
                          <rect x="4" y="19" width="2" height="9"/>
                          <path d="M18,25H8v2h9v4h2v-5C19,25.448,18.552,25,18,25z"/>
                          <rect x="9" y="20" width="2" height="2"/>
                          <rect x="21" y="18" width="2" height="8"/>
                          <rect x="21" y="28" width="9" height="2"/>
                          <path d="M61,29h-2v10h-3v2h4c0.552,0,1-0.448,1-1V29z"/>
                          <rect x="26" y="18" width="2" height="2"/>
                          <rect x="4" y="33" width="2" height="8"/>
                          <rect x="4" y="42" width="9" height="2"/>
                          <path d="M50,28h2v-4c0-0.552-0.448-1-1-1h-5v2h4V28z"/>
                          <rect x="9" y="33" width="2" height="2"/>
                          <rect x="20" y="32" width="2" height="8"/>
                          <rect x="20" y="42" width="9" height="2"/>
                          <rect x="8" y="38" width="9" height="2"/>
                          <rect x="21" y="52" width="2" height="4"/>
                          <rect x="20" y="48" width="9" height="2"/>
                          <path d="M36,44v-5c0-0.552-0.448-1-1-1H25v2h9v4H36z"/>
                          <rect x="26" y="32" width="2" height="2"/>
                          <rect x="15" y="34" width="2" height="2"/>
                          <rect x="59" y="53" width="2" height="7"/>
                          <rect x="54" y="58" width="3" height="2"/>
                          <rect x="54" y="52" width="2" height="4"/>
                          <path d="M61,44c0-0.552-0.448-1-1-1H49v2h10v6h2V44z"/>
                          <path d="M48,56v-5c0-0.552-0.448-1-1-1H36v2h10v4H48z"/>
                          <rect x="50" y="47" width="7" height="2"/>
                          <rect x="20" y="58" width="7" height="2"/>
                          <rect x="30" y="51" width="2" height="9"/>
                          <rect x="32" y="46" width="4" height="2"/>
                          <path d="M47,36h5v-2h-4v-6h-2v7C46,35.552,46.448,36,47,36z"/>
                          <rect x="50" y="30" width="5" height="2"/>
                          <rect x="54" y="20" width="3" height="2"/>
                          <rect x="59" y="20" width="2" height="5"/>
                          <rect x="54" y="25" width="2" height="2"/>
                          <path d="M39,17h4c0.552,0,1-0.448,1-1V3h-2v12h-3V17z"/>
                          <path d="M24,5h15V3H23c-0.552,0-1,0.448-1,1v5h2V5z"/>
                          <path d="M25,24h7c0.552,0,1-0.448,1-1v-8h-2v7h-6V24z"/>
                          <rect x="34" y="23" width="2" height="4"/>
                          <rect x="36" y="54" width="7" height="2"/>
                          <rect x="36" y="58" width="9" height="2"/>
                          <path d="M50,58h-2v2h3c0.552,0,1-0.448,1-1v-8h-2V58z"/>
                          <rect x="16" y="42" width="2" height="2"/>
                          <rect x="39" y="42" width="4" height="2"/>
                          <rect x="46" y="38" width="2" height="3"/>
                          <rect x="45" y="43" width="2" height="2"/>
                          <rect x="39" y="46" width="3" height="2"/>
                          <rect x="50" y="38" width="2" height="2"/>
                          <rect x="54" y="34" width="3" height="2"/>
                          <rect x="35" y="34" width="5" height="2"/>
                          <rect x="34" y="29" width="2" height="3"/>
                        </g>
                      </svg>
                    </a>
                    <a :href="route('qrs.edit', req.id)">
                      <svg xmlns="http://www.w3.org/2000/svg" class="hover:fill-red-400"  viewBox="0 0 64 64" width="16px" height="16px">
                        <path d="M 48.097656 3.453125 C 47.0625 3.453125 46.027344 3.828125 45.269531 4.585938 L 41.03125 8.828125 C 40.25 8.046875 38.980469 8.046875 38.203125 8.828125 L 32.546875 14.484375 C 32.167969 14.863281 31.957031 15.367188 31.957031 15.902344 C 31.957031 16.433594 32.167969 16.9375 32.546875 17.3125 L 32.59375 17.363281 L 5.515625 44.398438 C 5.011719 44.902344 4.707031 45.570313 4.648438 46.28125 L 3.972656 54.675781 L 3.269531 59.597656 C 3.222656 59.910156 3.328125 60.222656 3.554688 60.449219 C 3.742188 60.636719 3.996094 60.738281 4.257813 60.738281 C 4.308594 60.738281 4.355469 60.738281 4.402344 60.730469 L 9.320313 60.03125 L 17.765625 59.40625 C 18.484375 59.355469 19.15625 59.046875 19.664063 58.539063 L 46.742188 31.5 C 47.113281 31.847656 47.589844 32.042969 48.101563 32.042969 C 48.636719 32.042969 49.136719 31.835938 49.515625 31.457031 L 55.171875 25.800781 C 55.953125 25.019531 55.953125 23.753906 55.171875 22.972656 L 59.417969 18.730469 C 60.171875 17.972656 60.585938 16.96875 60.585938 15.898438 C 60.585938 14.832031 60.171875 13.824219 59.414063 13.070313 L 50.929688 4.585938 C 50.175781 3.828125 49.136719 3.453125 48.097656 3.453125 Z M 48.097656 5.433594 C 48.617188 5.433594 49.136719 5.621094 49.515625 6 L 58 14.484375 C 58.378906 14.863281 58.585938 15.363281 58.585938 15.898438 C 58.585938 16.433594 58.378906 16.9375 58 17.3125 L 53.757813 21.558594 L 42.441406 10.242188 L 46.6875 6 C 47.0625 5.621094 47.582031 5.433594 48.097656 5.433594 Z M 39.613281 10.242188 L 40.324219 10.949219 L 53.050781 23.675781 L 53.757813 24.386719 L 52.34375 25.796875 C 51.953125 25.40625 51.320313 25.40625 50.929688 25.796875 L 49.515625 27.214844 C 49.125 27.605469 49.125 28.238281 49.515625 28.628906 L 48.101563 30.042969 L 33.957031 15.898438 L 35.371094 14.484375 C 35.566406 14.679688 35.820313 14.777344 36.078125 14.777344 C 36.335938 14.777344 36.589844 14.679688 36.785156 14.484375 L 38.203125 13.070313 C 38.59375 12.679688 38.59375 12.046875 38.203125 11.65625 Z M 41.03125 14.898438 C 40.773438 14.898438 40.519531 14.996094 40.324219 15.191406 L 38.90625 16.605469 C 38.515625 16.996094 38.515625 17.628906 38.90625 18.019531 C 39.101563 18.214844 39.359375 18.3125 39.613281 18.3125 C 39.871094 18.3125 40.128906 18.214844 40.324219 18.019531 L 41.734375 16.605469 C 42.128906 16.214844 42.128906 15.582031 41.734375 15.191406 C 41.539063 14.996094 41.285156 14.898438 41.03125 14.898438 Z M 44.5625 18.4375 C 44.308594 18.4375 44.054688 18.53125 43.859375 18.730469 L 42.441406 20.140625 C 42.050781 20.535156 42.050781 21.164063 42.441406 21.558594 C 42.636719 21.75 42.894531 21.847656 43.152344 21.847656 C 43.40625 21.847656 43.664063 21.75 43.859375 21.558594 L 45.269531 20.140625 C 45.664063 19.75 45.664063 19.121094 45.269531 18.730469 C 45.074219 18.53125 44.820313 18.4375 44.5625 18.4375 Z M 34.011719 18.777344 L 45.324219 30.09375 L 19.027344 56.347656 L 18.074219 51.582031 L 34.664063 34.992188 C 35.054688 34.601563 35.054688 33.96875 34.664063 33.578125 C 34.273438 33.1875 33.644531 33.1875 33.25 33.578125 L 16.65625 50.171875 L 14.300781 49.699219 L 13.828125 47.339844 L 27.59375 33.578125 C 27.988281 33.183594 27.988281 32.554688 27.59375 32.160156 C 27.203125 31.769531 26.574219 31.769531 26.183594 32.160156 L 12.417969 45.925781 L 7.753906 44.996094 Z M 48.101563 21.96875 C 47.84375 21.96875 47.589844 22.066406 47.394531 22.265625 L 45.980469 23.675781 C 45.589844 24.070313 45.589844 24.699219 45.980469 25.09375 C 46.175781 25.285156 46.429688 25.386719 46.6875 25.386719 C 46.945313 25.386719 47.199219 25.285156 47.394531 25.09375 L 48.808594 23.675781 C 49.199219 23.285156 49.199219 22.65625 48.808594 22.265625 C 48.613281 22.066406 48.359375 21.96875 48.101563 21.96875 Z M 32.546875 26.214844 C 32.289063 26.214844 32.035156 26.3125 31.839844 26.503906 L 29.011719 29.332031 C 28.617188 29.726563 28.617188 30.355469 29.011719 30.75 C 29.203125 30.941406 29.460938 31.042969 29.71875 31.042969 C 29.972656 31.042969 30.230469 30.941406 30.421875 30.75 L 33.25 27.921875 C 33.644531 27.527344 33.644531 26.898438 33.25 26.503906 C 33.054688 26.308594 32.800781 26.210938 32.546875 26.214844 Z M 6.609375 46.804688 L 11.894531 47.859375 L 12.46875 50.746094 C 12.550781 51.140625 12.859375 51.449219 13.253906 51.527344 L 16.136719 52.105469 L 17.203125 57.441406 L 9.59375 58 L 6 54.410156 Z"/>
                      </svg>
                    </a>

                    <a @click="deleteRow(req.id)">
                      <svg xmlns="http://www.w3.org/2000/svg" class="hover:fill-red-400" viewBox="0 0 128 128" width="16px" height="16px">
                        <path d="M 49 1 C 47.34 1 46 2.34 46 4 C 46 5.66 47.34 7 49 7 L 79 7 C 80.66 7 82 5.66 82 4 C 82 2.34 80.66 1 79 1 L 49 1 z M 24 15 C 16.83 15 11 20.83 11 28 C 11 35.17 16.83 41 24 41 L 101 41 L 101 104 C 101 113.37 93.37 121 84 121 L 44 121 C 34.63 121 27 113.37 27 104 L 27 52 C 27 50.34 25.66 49 24 49 C 22.34 49 21 50.34 21 52 L 21 104 C 21 116.68 31.32 127 44 127 L 84 127 C 96.68 127 107 116.68 107 104 L 107 40.640625 C 112.72 39.280625 117 34.14 117 28 C 117 20.83 111.17 15 104 15 L 24 15 z M 24 21 L 104 21 C 107.86 21 111 24.14 111 28 C 111 31.86 107.86 35 104 35 L 24 35 C 20.14 35 17 31.86 17 28 C 17 24.14 20.14 21 24 21 z M 50 55 C 48.34 55 47 56.34 47 58 L 47 104 C 47 105.66 48.34 107 50 107 C 51.66 107 53 105.66 53 104 L 53 58 C 53 56.34 51.66 55 50 55 z M 78 55 C 76.34 55 75 56.34 75 58 L 75 104 C 75 105.66 76.34 107 78 107 C 79.66 107 81 105.66 81 104 L 81 58 C 81 56.34 79.66 55 78 55 z"/>
                      </svg>
                    </a>
                  </div>
                </li>
                <li v-if="qr_requests.length < 1">
                  <div class="ml-3">
                    <p class="text-sm font-medium text-red-900">Not QR Requests</p>
                  </div>
                </li>
              </ul>
            </div>
        </div>
      </div>
    </QrCard>

    
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
