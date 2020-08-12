<template>
  <div class="main">
      <header>
          <Header/>
      </header>
<!--      <transition>-->
<!--          <keep-alive>-->
<!--              <router-view></router-view>-->
<!--          </keep-alive>-->
<!--      </transition>-->
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

<style>

</style>
