<template>
  <div>
    <div v-for="(item, index) in items" :key="index">
        <task-list :item="item" class="item"></task-list>
    <div>
  </div>
</template>
<script>
// show view of tasks
import TaskList from "./TaskList";

export default {
  mounted() {
    console.log("List View");
  },
  props: ["items"],
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