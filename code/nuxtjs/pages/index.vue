<template>
  <div class="container">
    <div class="text-center">
      <logo />

      <h1 class="subtitle">
        HR-TECH Training
      </h1>
      <div class="links">
        <NLink :to="{name:'student'}"><buttom class="btn btn-primary">Student list</buttom></NLink>
      </div>
    </div>
  </div>
</template>

<script>
import Logo from '~/components/Logo.vue'

export default {
  components: {
    Logo
  }
}
</script>
