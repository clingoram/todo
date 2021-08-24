<template>
  <div>
    <!-- <b-button v-b-modal.modal-1>新增代辦事項</b-button>

    <b-modal id="modal-1" title="BootstrapVue">
      <p class="my-4">Hello from modal!</p>
    </b-modal> -->
    <b-row>
      <b-col md="auto">
        <b-calendar
          v-model="value"
          @context="onContext"
          block
          locale="en-US"
          v-b-modal.modal-prevent-closing
        ></b-calendar>
      </b-col>

      <b-modal
        id="modal-prevent-closing"
        ref="modal"
        title="新增代辦事項"
        @show="resetModal"
        @hidden="resetModal"
        @ok="handleOk"
      >
        <form ref="form" @submit.stop.prevent="handleSubmit">
          <b-form-group
            label="事項:"
            label-for="name-input"
            invalid-feedback="Name is required"
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
    </b-row>
    <!-- <modal-info></modal-info> -->
  </div>
</template>
<script>
import Modalinfo from "./MoreInfo";
export default {
  mounted() {
    console.log("calendar");
  },
  components: {
    Modalinfo,
  },
  props: ["dateValue"],
  data() {
    return {
      value: "",
      context: null,
      name: "",
      nameState: null,
      submittedNames: [],
    };
  },
  methods: {
    onContext(ctx) {
      this.context = ctx;
    },
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
      this.submittedNames.push(this.name);
      // Hide the modal manually
      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-closing");
      });
    },
  },
};
</script>