<template>
  <div id="todo_list">
    <h1>ToDo List</h1>
    <span>Get things done</span>
    <add-task v-on:reloadlist="getListdata()"> </add-task>
    <task-view
      v-bind:tasks="item_data"
      v-on:reloadlist="getListdata()"
    ></task-view>

    <!-- <button v-on:click="$emit('test')">6</button> -->
  </div>
</template>
<script>
// this is entry file.

// import components
// add task form
import AddTask from "./AddTask";
// lists of task
import TaskView from "./TaskView";

export default {
  // mounted() {
  //   console.log("index reload");
  // },
  components: {
    AddTask,
    TaskView,
  },
  data: function () {
    return {
      item_data: [],
    };
  },
  methods: {
    getListdata() {
      axios
        .get("api/item")
        .then((response) => {
          this.item_data = response.data;
          // console.log(this.item_data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  created() {
    this.getListdata();
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
  border-bottom: 1px solid #e5e5e5;
}
</style>