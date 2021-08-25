<template>
  <div>
    <b-row>
      <b-col md="auto">
        <b-calendar
          v-model="item.value"
          @context="onContext"
          block
          locale="en-US"
          v-b-modal.modal-prevent-closing
        ></b-calendar>
      </b-col>

      <!-- Modal -->
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
            invalid-feedback="必填"
            :state="item.taskState"
          >
            <b-form-input
              id="name-input"
              v-model="item.addtask"
              :state="item.taskState"
              required
            ></b-form-input>
          </b-form-group>
        </form>
      </b-modal>

      <!-- <b-modal
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
            invalid-feedback="必填"
            :state="taskState"
          >
            <b-form-input
              id="name-input"
              v-model="addtask"
              :state="taskState"
              required
            ></b-form-input>
          </b-form-group>
        </form>
      </b-modal> -->
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
      item: {
        addtask: "",
        taskState: null,
        submittedNames: [],
        value: "",
      },
    };
    // return {
    //   value: "",
    //   context: null,
    //   addtask: "",
    //   taskState: null,
    //   submittedNames: [],
    // };
  },
  methods: {
    onContext(ctx) {
      this.context = ctx;
    },
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.taskState = valid;
      return valid;
    },
    // cancel
    resetModal() {
      this.addtask = "";
      this.taskState = null;
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();
      // Trigger submit handler
      // this.handleSubmit();

      // 沒有填上任何task就save
      if (!this.checkFormValidity()) {
        return;
      } else {
        this.submit();
      }
    },
    submit() {
      axios
        .post("api/item/store", {
          item: this.addtask,
        })
        .then((response) => {
          if (response.status === 201) {
            this.item.addtask = "";
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // OK
    // handleSubmit() {
    //   alert("here");
    //   // Exit when the form isn't valid
    //   if (!this.checkFormValidity()) {
    //     return;
    //   }
    //   // Push the name to submitted names
    //   this.submittedNames.push(this.name);
    //   // Hide the modal manually
    //   this.$nextTick(() => {
    //     this.$bvModal.hide("modal-prevent-closing");
    //   });
    // },
  },
};
</script>