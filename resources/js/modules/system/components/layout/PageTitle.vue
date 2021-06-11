<template>
    <div class="text-gray-800 flex items-center">
        <div class="text-xl text-red-700 font-semibold">
            {{  title }}
        </div>
    </div>
</template>

<script>

export default {
    props: {
        propTitle: {
            type: String,
            default: 'Dashboard'
        }
    },
    data() {
        return {
            title: this.propTitle,
        }
    },
    mounted() {

        if (this.$route.meta.title) {
            this.title = this.$route.meta.title
        }

    }
}
</script>
