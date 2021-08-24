<template>
  <div id="todo_list">
    <add-task v-on:reloadlist="getListdata()"> </add-task>
    <task-view
      v-bind:tasks="item_data"
      v-on:reloadlist="getListdata()"
    ></task-view>
  </div>
</template>
<script>
// add task form
import AddTask from "./AddTask";
// lists of task
import TaskView from "./TaskView";
export default {
  mounted() {
    console.log("more info");
  },
  created() {
    this.getListdata();
  },
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
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
<style scoped>
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