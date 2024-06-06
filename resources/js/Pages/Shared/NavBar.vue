<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <nav
        class="bg-white border-b border-gray-200 px-4 py-2.5 flex flex-wrap justify-between items-center dark:bg-gray-800 dark:border-gray-700 fixed left-0 right-0 top-0 z-50"
    >
        <div class="flex justify-start items-center">
            <button
                data-drawer-target="drawer-navigation"
                data-drawer-toggle="drawer-navigation"
                aria-controls="drawer-navigation"
                class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
            >
                <svg
                    aria-hidden="true"
                    class="w-6 h-6"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        fill-rule="evenodd"
                        d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
                <span class="sr-only">Toggle sidebar</span>
            </button>
            <Link :href="route('admin.dashboard')">
                <span
                    class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white"
                    >E - Shop</span
                >
            </Link>
        </div>
        <div>
            <button
                type="button"
                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150"
                id="user-menu-button"
                aria-expanded="false"
                data-dropdown-toggle="dropdown"
            >
                {{ $page.props.auth.user.name }}

                <svg
                    class="ms-2 -me-0.5 h-4 w-4"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    />
                </svg>
            </button>
            <!-- Dropdown menu -->
            <div
                class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600 rounded-xl"
                id="dropdown"
            >
                <div class="py-3 px-4">
                    <span
                        class="block text-sm font-semibold text-gray-900 dark:text-white"
                    >
                        {{ $page.props.auth.user.name }}
                    </span>
                    <span
                        class="block text-sm text-gray-900 truncate dark:text-white"
                    >
                        {{ $page.props.auth.user.email }}
                    </span>
                </div>
                <ul
                    class="py-1 text-gray-700 dark:text-gray-300"
                    aria-labelledby="dropdown"
                >
                    <li>
                        <Link
                            :href="route('profile.edit')"
                            class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            >My profile</Link
                        >
                    </li>
                    <li>
                        <Link
                            :href="route('logout')"
                            method="post"
                            role="button"
                            as="link"
                            class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white"
                            >Sign out</Link
                        >
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>
