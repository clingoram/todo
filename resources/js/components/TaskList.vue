<template>
  <div class="item">
    <input type="checkbox" @change="updateTask()" v-model="item.status" />
    <span v-bind:class="[item.status ? 'completed' : '', 'itemText']">
      {{ item.description }}</span
    >
    <button v-on:click="removeitem()" class="trash">
      <font-awesome-icon icon="trash" />
    </button>
  </div>
</template>
<script>
export default {
  props: ["item"],
  methods: {
    // completed
    updateTask: function () {
      axios
        .put("api/item/" + this.item.id, {
          item: this.item,
        })
        .then((response) => {
          if (response.status == 200) {
            this.$emit("changeddata");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // move it to trash
    removeitem: function () {
      axios
        .delete("api/item/" + this.item.id, {
          item: this.item,
        })
        .then((response) => {
          if (response.status == 200) {
            this.$emit("changeddata");
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
* {
  font-size: 1.1rem;
}
.completed {
  text-decoration: line-through;
  color: #000000;
}
.itemText {
  color: white;
  width: 100%;
  margin-left: 15px;
}
.item {
  justify-content: center;
  margin: 5px;
}
.trash {
  border: none;
  background: transparent;
}
</style>