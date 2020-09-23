<template>
  <div class="main">
      <header>
          <Header/>
      </header>
          <router-view></router-view>
      <footer>
          <Footer/>
      </footer>
  </div>
</template>

<script>
import Header from '../components/Header'
import Footer from "../components/Footer";
export default {
    name: 'MainLayout',
    components: { Header, Footer }
}
</script>

<style lang="scss">
    .main{
        height: 100vh;
    }
</style>
