<template>
    <onclick-outside-component :do="handleClickOutside">
        <div class="relative">
            <a v-if="label" href="#" @click.prevent="isOpen = !isOpen" class="flex items-center text-sm sm:text-base font-mono text-white rounded px-2 py-2">
                {{ label }}
                <svg class="fill-current w-2 ml-2 mt-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path></svg>
            </a>
            <a v-else href="#" @click.prevent="isOpen = !isOpen" class="flex items-center text-sm sm:text-base font-mono text-white rounded px-2 py-2">
                <slot name="label" />
                <svg class="fill-current w-2 ml-2 mt-1" aria-hidden="true" focusable="false" data-prefix="fas" data-icon="caret-down" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"></path></svg>
            </a>
            <div :class="isOpen ? 'block' : 'hidden'" class="origin-top-right mt-2 absolute right-0 w-48 rounded-md shadow-lg z-10">
                <div class="py-1 rounded-md bg-white shadow-xs" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                    <slot name="links" />
                </div>
            </div>
        </div>
    </onclick-outside-component>
</template>

<script>
    export default {
        props: {
            label: {
                required: false,
                type: String,
            },
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
            },
        }
    };
</script>
