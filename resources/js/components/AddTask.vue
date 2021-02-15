<template>
  <form name="new_form" class="add_task">
    <input type="text" name="newtask" id="new_task" v-model="item.name" />
    <font-awesome-icon
      icon="plus-square"
      v-on:click="addtask()"
      v-bind:class="item.name ? 'active' : 'plus'"
    />
    <!-- <add-category></add-category> -->
  </form>
</template>
<script>
// this is form template,
// add new task here.

// add category-modal
// import AddCategory from "./AddCategory";

export default {
  // mounted() {
  //   console.log("add task");
  // },
  // components: {
  //   AddCategory,
  // },
  data: function () {
    return {
      item: {
        name: "",
      },
    };
  },
  methods: {
    addtask() {
      if (this.item.name == "") {
        return;
      }
      // https://github.com/axios/axios
      axios
        .post("api/item/store", {
          // return item data on line 20
          item: this.item,
        })
        .then((response) => {
          if (response.status == 201) {
            this.item.name == "";
            // console.log(response);
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>

<style scoped>
.add_task {
  display: block;
  justify-content: center;
  align-items: center;
}
input {
  border: 1pt;
  border-color: #000000;
  padding: 5px;
  width: 60%;
  background: #e5e5e5;
}
.active {
  color: white;
}
</style>