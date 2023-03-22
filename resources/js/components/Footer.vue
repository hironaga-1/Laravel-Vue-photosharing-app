<template>
  <footer class="footer">
    <button v-if="isLogin" class="button button--link" @click="logout">Logout</button>
    <RouterLink v-else class="button button--link" to="/login">
      Login / Register
    </RouterLink>
  </footer>
</template>
<script>
import { defineComponent } from 'vue'
import { mapState, mapGetters } from 'vuex'

export default defineComponent({
  methods: {
    async logout () {
      await this.$store.dispatch('auth/logout')
      
      if (this.apiStatus) {
        this.$router.push('/login')
      }
    }
  }, 
  computed: {
    ...mapState({
      apiStatus: state => state.auth.apiStatus
    }), 
    ...mapGetters({
      isLogin: 'auth/check'
    })
  }
})
</script>