<template>
  <div class="main">
      <header>
          <Header/>
      </header>
      <router-view/>
  </div>
</template>

<script>
import Header from '../components/Header'
export default {
    name: 'MainLayout',
    components: { Header }
}
</script>

<style>

</style>