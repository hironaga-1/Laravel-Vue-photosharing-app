<template>
    <div class="message" v-show="message">
        {{ message }}
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { mapState } from 'vuex'

export default defineComponent({
    computed: {
        ...mapState({
            message: state => state.message.content
        })
    }
})
</script>
