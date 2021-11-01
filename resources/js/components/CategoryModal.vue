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
          <div :id="'tag_' + index.id" v-bind:style="styleObject">
            {{ index.name }}
          </div>
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
      // show category list on modal
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
      // Push the name to submitted names
      // this.categoryName.push(this.name);

      this.addCategory();

      // Hide the modal manually
      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-closing");
      });
    },
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
    allCategories() {
      console.log("get classification");
      axios
        .get("/api/items/categories")
        .then((response) => {
          console.log(response.data);
          this.categoryNameList = response.data;
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
/* .tagbutton {
  color: white;
  background: blue;
  border-radius: 5px;
  padding: 6px;
  margin: 8px;
} */
</style>