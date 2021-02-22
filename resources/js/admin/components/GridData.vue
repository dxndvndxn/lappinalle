<template>
  <div class="wrap-new-size-grid" v-if="dataGrid !== null">
            <span v-for="(item, i) in dataGrid" :key="i" @dblclick="funcDel(item[id])">
                    {{item[afterDot]}}
            </span>
  </div>
</template>

<script>
export default {
    props: ['dataGrid', 'afterDot', 'funcDel', 'id']
}
</script>

<style>

</style>