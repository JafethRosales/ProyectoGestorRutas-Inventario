<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div x-data="{ mobileNavOpen: false }">
    <button x-on:click="mobileNavOpen = !mobileNavOpen" class="flex items-center rounded focus:outline-none absolute top-0 right-0 p-4">
        <svg class="text-white bg-indigo-500 hover:bg-indigo-600 block h-8 w-8 p-2 rounded" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
            <title>Mobile menu</title>
            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
        </svg>
    </button>

    <div :class="{'block': mobileNavOpen, 'hidden': !mobileNavOpen}">
        <div x-on:click="mobileNavOpen = !mobileNavOpen" class="fixed lg:show inset-0 bg-gray-800 opacity-10"></div>
        <nav class="fixed z-10 top-0 left-0 bottom-0 flex flex-col w-2/5 lg:w-60 sm:max-w-xs pt-0 pb-8 bg-gray-800 overflow-y-auto">
            <div class="flex w-full pt-5 h-20 items-center justify-center px-6 pb-6 mb-6 lg:border-b border-gray-700 bg-gray-900">
                <a class="text-xl text-white font-semibold">
                    <img class="h-14" src="{{ asset('images/Logo3.png') }}" width="auto">
                </a>
            </div>
            <div class="px-4 pb-6">
                <h3 class="mb-2 text-xs uppercase text-gray-500 font-medium">Menú</h3>
                <ul class="mb-8 text-sm font-medium">
                    <li>
                        <a class="flex items-center pl-3 py-3 pr-4 text-gray-50 hover:bg-indigo-500 rounded" 
                           href="{{ route('dashboard') }}" 
                           wire:navigate>
                            <span class="inline-block mr-3">
                                <svg class="text-indigo-100 w-5 h-5" viewbox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.9066 3.12873C14.9005 3.12223 14.8987 3.11358 14.8923 3.10722C14.8859 3.10086 14.8771 3.09893 14.8706 3.09278C13.3119 1.53907 11.2008 0.666626 8.99996 0.666626C6.79914 0.666626 4.68807 1.53907 3.12935 3.09278C3.12279 3.09893 3.11404 3.10081 3.10763 3.10722C3.10122 3.11363 3.09944 3.12222 3.09334 3.12873C1.93189 4.29575 1.14217 5.78067 0.823851 7.39609C0.505534 9.01151 0.672885 10.685 1.30478 12.2054C1.93668 13.7258 3.00481 15.025 4.37435 15.9389C5.7439 16.8528 7.35348 17.3405 8.99996 17.3405C10.6464 17.3405 12.256 16.8528 13.6256 15.9389C14.9951 15.025 16.0632 13.7258 16.6951 12.2054C17.327 10.685 17.4944 9.01151 17.1761 7.39609C16.8578 5.78067 16.068 4.29575 14.9066 3.12873Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center pl-3 py-3 pr-4 text-gray-50 hover:bg-gray-900 rounded" 
                           href="{{ route('clientes') }}" 
                           wire:navigate>
                            <span class="inline-block mr-3">
                                <svg class="text-gray-600 w-5 h-5" viewbox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.3414 9.23329C11.8689 8.66683 12.166 7.92394 12.1747 7.14996C12.1747 6.31453 11.8428 5.51331 11.2521 4.92257C10.6614 4.33183 9.86015 3.99996 9.02472 3.99996C8.18928 3.99996 7.38807 4.33183 6.79733 4.92257C6.20659 5.51331 5.87472 6.31453 5.87472 7.14996C5.88341 7.92394 6.18057 8.66683 6.70805 9.23329C5.97359 9.59902 5.34157 10.1416 4.86881 10.8122C4.39606 11.4827 4.0974 12.2603 3.99972 13.075C3.9754 13.296 4.03989 13.5176 4.17897 13.6911C4.31806 13.8645 4.52037 13.9756 4.74138 14C4.9624 14.0243 5.18401 13.9598 5.35749 13.8207C5.53096 13.6816 5.64207 13.4793 5.66638 13.2583C5.76583 12.4509 6.15709 11.7078 6.76645 11.1688C7.37582 10.6299 8.16123 10.3324 8.97472 10.3324C9.7882 10.3324 10.5736 10.6299 11.183 11.1688C11.7923 11.7078 12.1836 12.4509 12.283 13.2583C12.3062 13.472 12.4111 13.6684 12.5757 13.8066C12.7403 13.9448 12.9519 14.0141 13.1664 14H13.258C13.4765 13.9748 13.6762 13.8644 13.8135 13.6927C13.9509 13.521 14.0148 13.3019 13.9914 13.0833C13.9009 12.2729 13.6117 11.4975 13.1494 10.8258C12.6871 10.1542 12.066 9.60713 11.3414 9.23329Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <span>Clientes</span>
                            <span class="inline-block ml-auto">
                                <svg class="text-gray-400 w-4 h-4" style="color: rgb(123, 123, 111);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM358.6 278.6l-112 112c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25L290.8 256L201.4 166.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l112 112C364.9 239.6 368 247.8 368 256S364.9 272.4 358.6 278.6z" fill="#7b7b6f"></path>
                                </svg>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center pl-3 py-3 pr-4 text-gray-50 hover:bg-gray-900 rounded" 
                           href="{{ route('ventas') }}" 
                           wire:navigate>
                            <span class="inline-block mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-600 w-5 h-5" fill="currentColor" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5Z"/>
                                </svg>
                            </span>
                            <span>Ventas</span>
                            <span class="inline-block ml-auto">
                                <svg class="text-gray-400 w-4 h-4" style="color: rgb(123, 123, 111);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM358.6 278.6l-112 112c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25L290.8 256L201.4 166.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l112 112C364.9 239.6 368 247.8 368 256S364.9 272.4 358.6 278.6z" fill="#7b7b6f"></path>
                                </svg>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center pl-3 py-3 pr-4 text-gray-50 hover:bg-gray-900 rounded" 
                           href="{{ route('inventario') }}" 
                           wire:navigate>
                            <span class="inline-block mr-3">
                                <svg class="text-gray-600 w-5 h-5" viewbox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.33329 9.83329H1.49996C1.27895 9.83329 1.06698 9.92109 0.910704 10.0774C0.754423 10.2337 0.666626 10.4456 0.666626 10.6666V16.5C0.666626 16.721 0.754423 16.9329 0.910704 17.0892C1.06698 17.2455 1.27895 17.3333 1.49996 17.3333H7.33329C7.55431 17.3333 7.76627 17.2455 7.92255 17.0892C8.07883 16.9329 8.16663 16.721 8.16663 16.5V10.6666C8.16663 10.4456 8.07883 10.2337 7.92255 10.0774C7.76627 9.92109 7.55431 9.83329 7.33329 9.83329Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <span>Inventario</span>
                            <span class="inline-block ml-auto">
                                <svg class="text-gray-400 w-4 h-4" style="color: rgb(123, 123, 111);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM358.6 278.6l-112 112c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25L290.8 256L201.4 166.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l112 112C364.9 239.6 368 247.8 368 256S364.9 272.4 358.6 278.6z" fill="#7b7b6f"></path>
                                </svg>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center pl-3 py-3 pr-4 text-gray-50 hover:bg-gray-900 rounded" 
                           href="{{ route('vehiculo') }}" 
                           wire:navigate>
                            <span class="inline-block mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="text-gray-600 w-5 h-5" fill="currentColor" viewBox="0 0 16 16">
                                    <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5v-7z"/>
                                </svg>
                            </span>
                            <span>Vehículo</span>
                            <span class="inline-block ml-auto">
                                <svg class="text-gray-400 w-4 h-4" style="color: rgb(123, 123, 111);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM358.6 278.6l-112 112c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25L290.8 256L201.4 166.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l112 112C364.9 239.6 368 247.8 368 256S364.9 272.4 358.6 278.6z" fill="#7b7b6f"></path>
                                </svg>
                            </span>
                        </a>
                    </li>
                </ul>

                <h3 class="mb-2 text-xs uppercase text-gray-500 font-medium">Historial</h3>
                <ul class="text-sm font-medium">
                    <li>
                        <a class="flex items-center pl-3 py-3 pr-2 text-gray-50 hover:bg-gray-900 rounded" 
                           href="{{ route('historial.rutas') }}" 
                           wire:navigate>
                            <span class="inline-block mr-3">
                                <svg class="text-gray-600 w-5 h-5" viewbox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.0002 0.666626C4.41687 0.666626 0.66687 4.41663 0.66687 8.99996C0.66687 13.5833 4.41687 17.3333 9.0002 17.3333C13.5835 17.3333 17.3335 13.5833 17.3335 8.99996C17.3335 4.41663 13.5835 0.666626 9.0002 0.666626Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <span>Rutas</span>
                            <span class="inline-block ml-auto">
                                <svg class="text-gray-400 w-4 h-4" style="color: rgb(123, 123, 111);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM358.6 278.6l-112 112c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25L290.8 256L201.4 166.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l112 112C364.9 239.6 368 247.8 368 256S364.9 272.4 358.6 278.6z" fill="#7b7b6f"></path>
                                </svg>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center pl-3 py-3 pr-2 text-gray-50 hover:bg-gray-900 rounded" 
                           href="{{ route('historial.pagos') }}" 
                           wire:navigate>
                            <span class="inline-block mr-2">
                                <svg class="text-gray-600 w-6 h-5" viewbox="0 0 20 16" xmlns="http://www.w3.org/2000/svg" fill="currentColor">
                                    <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8zm5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0z"/>
                                    <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1h-.003zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195l.054.012z"/>
                                </svg>
                            </span>
                            <span>Pagos</span>
                            <span class="inline-block ml-auto">
                                <svg class="text-gray-400 w-4 h-4" style="color: rgb(123, 123, 111);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM358.6 278.6l-112 112c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25L290.8 256L201.4 166.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l112 112C364.9 239.6 368 247.8 368 256S364.9 272.4 358.6 278.6z" fill="#7b7b6f"></path>
                                </svg>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a class="flex items-center pl-3 py-3 pr-2 text-gray-50 hover:bg-gray-900 rounded" 
                           href="{{ route('historial.creditos') }}" 
                           wire:navigate>
                            <span class="inline-block mr-3">
                                <svg class="text-gray-600 w-5 h-5" viewbox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M13.6665 6.44996C13.6578 6.3734 13.641 6.29799 13.6165 6.22496V6.14996C13.5764 6.06428 13.5229 5.98551 13.4581 5.91663L8.45813 0.916626C8.38924 0.851806 8.31048 0.79836 8.2248 0.758293H8.1498C8.06514 0.709744 7.97165 0.678579 7.8748 0.666626H2.83313C2.17009 0.666626 1.5342 0.930018 1.06536 1.39886C0.596522 1.8677 0.33313 2.50358 0.33313 3.16663V14.8333C0.33313 15.4963 0.596522 16.1322 1.06536 16.6011C1.5342 17.0699 2.17009 17.3333 2.83313 17.3333H11.1665C11.8295 17.3333 12.4654 17.0699 12.9342 16.6011C13.4031 16.1322 13.6665 15.4963 13.6665 14.8333V6.49996C13.6665 6.49996 13.6665 6.49996 13.6665 6.44996Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <span>Créditos</span>
                            <span class="inline-block ml-auto">
                                <svg class="text-gray-400 w-4 h-4" style="color: rgb(123, 123, 111);" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                    <path d="M256 0C114.6 0 0 114.6 0 256c0 141.4 114.6 256 256 256s256-114.6 256-256C512 114.6 397.4 0 256 0zM358.6 278.6l-112 112c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25L290.8 256L201.4 166.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0l112 112C364.9 239.6 368 247.8 368 256S364.9 272.4 358.6 278.6z" fill="#7b7b6f"></path>
                                </svg>
                            </span>
                        </a>
                    </li>
                </ul>

                <div class="pt-8">
                    <h3 class="mb-2 text-xs uppercase text-gray-500 font-medium">Perfil</h3>
                    <a class="flex items-center pl-3 py-3 pr-2 text-gray-50 hover:bg-indigo-700 rounded" 
                       href="{{ route('profile') }}" 
                       wire:navigate>
                        <span class="inline-block mr-4">
                            <svg class="text-gray-600 w-5 h-5" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.7666 7.9583L16.1916 7.4333L16.9333 5.94996C17.0085 5.7947 17.0336 5.61993 17.0053 5.44977C16.9769 5.27961 16.8964 5.12245 16.775 4.99996L15 3.22496C14.8768 3.1017 14.7182 3.02013 14.5463 2.99173C14.3743 2.96333 14.1979 2.98953 14.0416 3.06663L12.5583 3.8083L12.0333 2.2333C11.9778 2.06912 11.8726 1.92632 11.7322 1.82475C11.5918 1.72319 11.4232 1.66792 11.25 1.66663H8.74996C8.57526 1.66618 8.40483 1.72064 8.26277 1.82233C8.12071 1.92402 8.0142 2.06778 7.9583 2.2333L7.4333 3.8083L5.94996 3.06663C5.7947 2.99145 5.61993 2.9663 5.44977 2.99466C5.27961 3.02302 5.12245 3.10349 4.99996 3.22496L3.22496 4.99996C3.1017 5.1231 3.02013 5.28177 2.99173 5.45368C2.96333 5.62558 2.98953 5.80205 3.06663 5.9583L3.8083 7.44163L2.2333 7.96663C2.06912 8.02208 1.92632 8.12732 1.82475 8.26772C1.72319 8.40812 1.66792 8.57668 1.66663 8.74996V11.25C1.66618 11.4247 1.72064 11.5951 1.82233 11.7372C1.92402 11.8792 2.06778 11.9857 2.2333 12.0416L3.8083 12.5666L3.06663 14.05C2.99145 14.2052 2.9663 14.38 2.99466 14.5502C3.02302 14.7203 3.10349 14.8775 3.22496 15L4.99996 16.775C5.1231 16.8982 5.28177 16.9798 5.45368 17.0082C5.62558 17.0366 5.80205 17.0104 5.9583 16.9333L7.44163 16.1916L7.96663 17.7666C8.02253 17.9321 8.12904 18.0759 8.2711 18.1776C8.41317 18.2793 8.58359 18.3337 8.7583 18.3333H11.2583C11.433 18.3337 11.6034 18.2793 11.7455 18.1776C11.8875 18.0759 11.9941 17.9321 12.05 17.7666L12.575 16.1916L14.0583 16.9333C14.2126 17.0066 14.3856 17.0307 14.5541 17.0024C14.7225 16.9741 14.8781 16.8947 15 16.775L16.775 15C16.8982 14.8768 16.9798 14.7182 17.0082 14.5463C17.0366 14.3743 17.0104 14.1979 16.9333 14.0416L16.1916 12.5583L17.7666 12.0333C17.9308 11.9778 18.0736 11.8726 18.1752 11.7322C18.2767 11.5918 18.332 11.4232 18.3333 11.25V8.74996C18.3337 8.57526 18.2793 8.40483 18.1776 8.26277C18.0759 8.12071 17.9321 8.0142 17.7666 7.9583Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <span>Configuración</span>
                    </a>
                    <a wire:click='logout' class="flex items-center pl-3 py-3 pr-2 text-gray-50 hover:bg-indigo-700 rounded cursor-pointer">
                        <span class="inline-block mr-4">
                            <svg class="text-gray-600 w-5 h-5" viewbox="0 0 14 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.333618 8.99996C0.333618 9.22097 0.421416 9.43293 0.577696 9.58922C0.733976 9.7455 0.945938 9.83329 1.16695 9.83329H7.49195L5.57528 11.7416C5.49718 11.8191 5.43518 11.9113 5.39287 12.0128C5.35057 12.1144 5.32879 12.2233 5.32879 12.3333C5.32879 12.4433 5.35057 12.5522 5.39287 12.6538C5.43518 12.7553 5.49718 12.8475 5.57528 12.925C5.65275 13.0031 5.74492 13.0651 5.84647 13.1074C5.94802 13.1497 6.05694 13.1715 6.16695 13.1715C6.27696 13.1715 6.38588 13.1497 6.48743 13.1074C6.58898 13.0651 6.68115 13.0031 6.75862 12.925L10.0919 9.59163C10.1678 9.51237 10.2273 9.41892 10.2669 9.31663C10.3503 9.11374 10.3503 8.88618 10.2669 8.68329C10.2273 8.581 10.1678 8.48755 10.0919 8.40829L6.75862 5.07496C6.68092 4.99726 6.58868 4.93563 6.48716 4.89358C6.38564 4.85153 6.27683 4.82988 6.16695 4.82988C6.05707 4.82988 5.94826 4.85153 5.84674 4.89358C5.74522 4.93563 5.65298 4.99726 5.57528 5.07496C5.49759 5.15266 5.43595 5.2449 5.3939 5.34642C5.35185 5.44794 5.33021 5.55674 5.33021 5.66663C5.33021 5.77651 5.35185 5.88532 5.3939 5.98683C5.43595 6.08835 5.49759 6.18059 5.57528 6.25829L7.49195 8.16663H1.16695C0.945938 8.16663 0.733976 8.25442 0.577696 8.4107C0.421416 8.56698 0.333618 8.77895 0.333618 8.99996Z" fill="currentColor"></path>
                            </svg>
                        </span>
                        <span>Cerrar sesión</span>
                    </a>
                </div>
            </div>
        </nav>
    </div>
    
    <div class="mx-auto lg:ml-80"></div>
</div>
