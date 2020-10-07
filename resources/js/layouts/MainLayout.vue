<template>
  <div class="main">
      <header>
          <Header></Header>
      </header>
          <router-view></router-view>
      <footer>
          <Footer></Footer>
      </footer>
      <CookieBar/>
  </div>
</template>

<script>
import Header from '../components/Header'
import Footer from "../components/Footer";
import CookieBar from "../components/CookieBar";
export default {
    name: 'MainLayout',
    components: { Header, Footer, CookieBar }
}
</script>

<style lang="scss">
    .main{
        height: 100vh;
    }
</style>
