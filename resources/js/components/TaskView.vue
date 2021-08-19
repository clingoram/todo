<template>
  <div>
    <div v-for="(item, index) in tasks" v-bind:key="index">
      <task-list
        v-bind:item="item"
        class="item"
        v-on:changeddata="$emit('reloadlist')"
      />
    </div>
  </div>
</template>
<script>
// show view of tasks
// import data
import TaskList from "./TaskList";

export default {
  props: ["tasks"],
  components: {
    TaskList,
  },
};
</script>

<style scoped>
* {
  color: #000000;
}
</style>