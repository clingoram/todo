<template>
  <div id="area">
    <b-button variant="primary" id="add_category_button" v-b-modal.category_area
      >分類</b-button
    >
    <add-category v-bind:openCategoryModal="cmodalOpen"></add-category>

    <h1>ToDo List</h1>
    <span>Get things done!!!</span>
    <show-calendar></show-calendar>
  </div>
</template>
<script>
// import components
import ShowCalendar from "./Calendar";
import AddCategory from "./CategoryModal";

export default {
  components: {
    ShowCalendar,
    AddCategory,
  },
  props: {
    openCategoryModal: {
      type: Boolean,
    },
  },
  data() {
    return {
      cmodalOpen: this.openCategoryModal,
    };
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
#area {
  padding: 15px;
  width: 100%;
}
#add_category_button {
  padding: 5px;
}
</style>