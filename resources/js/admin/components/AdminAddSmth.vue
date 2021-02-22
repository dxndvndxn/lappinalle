<template>
  <div class="wrap-add-new-sizes width-300">
       <input type="text" :placeholder="myPlaceholder" v-model="str" class="input-transp">
       <button @click="addFunc(str)" class="input-transp"><img src="../../../img/krest-btn.png"></button>
  </div>
</template>

<script>
export default {
    props: {
        myPlaceholder: String,
        addFunc: Function
    },
    data: () => ({
        str: null
    })
}
</script>

<style>

</style>