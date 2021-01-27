<template>
  <!-- Bootstrap-Vue Modal -->
  <div>
    <div>
      <b-button v-b-modal.modal-prevent-closing variant="primary"
        >新增分類</b-button
      >

      <div class="mt-3">
        <div v-if="categoryName.length === 0">--</div>
        <ul v-else class="mb-0 pl-3">
          <li v-bind-for="name in categoryName">{{ name }}</li>
        </ul>
      </div>

      <b-modal
        id="modal-prevent-closing"
        ref="modal"
        title="新增分類"
        @show="resetModal"
        @hidden="resetModal"
        @ok="handleOk"
      >
        <form ref="form" @submit.stop.prevent="handleSubmit">
          <b-form-group
            label="名稱"
            label-for="name-input"
            invalid-feedback="名稱必填"
            :state="nameState"
          >
            <b-form-input
              id="name-input"
              v-model="name"
              :state="nameState"
              required
            ></b-form-input>
          </b-form-group>
        </form>
      </b-modal>
    </div>
  </div>
</template>
<script>
export default {
  mounted() {
    console.log("hi");
  },
  data() {
    return {
      name: "",
      nameState: null,
      categoryName: [],
    };
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
      this.categoryName.push(this.name);
      // Hide the modal manually
      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-closing");
      });
    },
  },
};
</script>