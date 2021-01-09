<template>
  <div id="todo_list">
    <h1>ToDo List</h1>
    <span>Get things done</span>
    <add-task></add-task>
    <task-list></task-list>
    <!-- <task-view></task-view> -->
  </div>
</template>
<script>
// this is entry file.

// import components
// add task form
import AddTask from "./AddTask";
// lists of task
// import TaskView from "./TaskView";
import TaskList from "./TaskList";

export default {
  mounted() {
    console.log("index reload");
  },
  components: {
    AddTask,
    // TaskView,
    TaskList,
  },
};
</script>
<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}
html,
body {
  background: #f7f1f1;
  font-size: 1.1rem;
  font-family: sans-serif;
  height: 100%;
}
#todo_list {
  margin: 4rem auto;
  padding: 2rem 3rem 3rem;
  max-width: 500px;
  background: #ff6666;
  color: #000000;
}
#todo_list h1 {
  font-weight: normal;
  font-size: 2.6rem;
  letter-spacing: 0.05em;
  border-bottom: 1px solid rgba(255, 255, 255, 0.3);
}
</style>