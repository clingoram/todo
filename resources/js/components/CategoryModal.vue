<template>
  <!-- Bootstrap-Vue Modal -->
  <div>
    <b-modal
      id="category_area"
      ref="modal"
      title="分類"
      v-on:show="resetModal"
      v-on:hidden="resetModal"
      v-on:ok="handleOk"
    >
      <form ref="form" @submit.stop.prevent="handleSubmit">
        <b-form-group
          label="名稱"
          label-for="name-input"
          invalid-feedback="名稱必填"
        >
          <b-form-input
            id="name-input"
            v-model="category.name"
            required
          ></b-form-input>
        </b-form-group>
      </form>

      <div class="category_tags">
        <div v-for="index in categoryNameList" v-bind:key="index.id">
          <b-button
            variant="outline-primary"
            :id="'tag_' + index.id"
            v-bind:style="styleObject"
            v-on:click="deleteCategory(index.id)"
            title="刪除"
          >
            {{ index.name }}
          </b-button>
        </div>
      </div>
    </b-modal>
  </div>
</template>
<script>
export default {
  props: ["openCategoryModal"],
  created() {
    this.allCategories();
  },
  data() {
    return {
      showModal: false,
      // tags style
      styleObject: {
        color: "white",
        background: "cadetblue",
        "border-radius": "5px",
        fontSize: "13px",
        padding: "6px",
        margin: "8px",
      },
      category: {
        name: "",
      },
      // category list
      categoryNameList: [],
    };
  },
  computed: {
    modal() {
      if (this.openCategoryModal === true) {
        this.showModal = true;
      } else {
        this.showModal = false;
      }
    },
  },
  methods: {
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.nameState = valid;
      return valid;
    },
    resetModal() {
      this.name = "";
      this.nameState = null;
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      // Trigger submit handler
      this.handleSubmit();
    },
    handleSubmit() {
      // Exit when the form isn't valid
      if (!this.checkFormValidity()) {
        return;
      }

      if (this.category.name !== "") {
        this.addCategory();
      }

      // Hide the modal manually
      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-closing");
      });
    },
    // Create
    addCategory() {
      axios
        .post("/api/items/categories", {
          category: this.category,
        })
        .then((response) => {
          if (response.status === 201) {
            alert("新增成功");
          }
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
    // Read
    allCategories() {
      axios
        .get("/api/items/categories")
        .then((response) => {
          this.categoryNameList = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // Delete
    deleteCategory(id) {
      axios
        .delete("/api/items/categories/" + this.id)
        .then((response) => {
          alert("已刪除!");
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
<style scoped>
.category_tags {
  display: flex;
}
</style>