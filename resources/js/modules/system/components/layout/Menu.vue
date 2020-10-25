<template>
    <div class="relative menu-item">
        <button
            @click="isVisible = !isVisible"
            class="w-full menu-item flex justify-between items-center py-3 px-6 text-gray-600 cursor-pointer hover:bg-gray-100 hover:text-gray-700 focus:outline-none"
        >
            <span class="flex items-center">
                <zondicon
                    class="menu-icon fill-current h-4 w-4"
                    :icon="menu.icon"
                ></zondicon>
                <span v-if="$te(menu.name)" class="ml-6 menu-label font-medium">
                    {{ $t(menu.name) }}
                </span>
                <span v-else class="ml-6 menu-label font-medium">
                    {{ menu.name }}
                </span>
            </span>

            <span class="menu-chevron-icon">
                <svg
                    class="h-4 w-4"
                    viewBox="0 0 24 24"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        v-if="!isVisible"
                        d="M9 5L16 12L9 19"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    ></path>
                    <path
                        v-if="isVisible"
                        d="M19 9L12 16L5 9"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    ></path>
                </svg>
            </span>
        </button>

        <div
            v-if="sidebar || isVisible"
            :class="sidebar ? 'sub-menu absolute' : ''"
        >
            <div
                :key="index"
                v-for="(submenu, index) in menu.submenus"
                :class="sidebar ? 'bg-white' : ''"
            >
                <a
                    class="py-2 cursor-pointer pl-16 pr-3 block text-sm text-gray-600 hover:bg-red-500 hover:text-white"
                    :href="submenu.url"
                >
                    {{ $t(submenu.name) }}
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "avored-menu",
    props: {
        menu: {
            type: [Object],
            default: () => {}
        },
        sidebar: {
            type: [Boolean],
            default: false
        }
    },
    data() {
        return {
            isVisible: false
        };
    }
};
</script>
<style>
.sidebar-collapsed .menu-item .menu-label,
.sidebar-collapsed .menu-item .menu-chevron-icon,
.sidebar-collapsed .menu-item .sub-menu {
    display: none;
    opacity: 0;
}
.sidebar-collapsed .menu-item:hover .sub-menu {
    left: 4rem;
    top: 0px;
    display: block;
    opacity: 1;
    width: 16rem;
}
</style>
