<template>
    <onclick-outside-component :do="handleClickOutside">
        <div class="relative mx-2">
            <a href="#" @click.prevent="isOpen = !isOpen" class="font-mono text-white rounded px-4 py-2">
                {{ label }}
            </a>
            <div :class="isOpen ? 'block' : 'hidden'" class="origin-top-right mt-2 absolute right-0 w-48 rounded-md shadow-lg z-10">
                <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                    <a href="#" class="block px-4 py-2 font-mono text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">Profile</a>
                </div>
            </div>
        </div>
    </onclick-outside-component>
</template>

<script>
export default {
    props: {
        label: {
            required: true,
            type: String,
        }
    },
    data() {
        return {
            isOpen: false
        };
    },
    methods: {
        handleClickOutside() {
            if (this.isOpen) {
                this.isOpen = false;
            }
        }
    }
};
</script>
