<template>
  <!-- Modal -->
  <b-modal
    id="modal-prevent-closing"
    ref="showModal"
    title="新增代辦事項"
    v-model="showModal"
    v-on:show="resetModal"
    v-on:hidden="resetModal"
    v-on:ok="handleOk"
    v-on:click="toOpenModal()"
  >
    <form ref="form" v-on:submit.stop.prevent="handleOk">
      <b-form-group
        label="代辦事項:"
        label-for="task-input"
        invalid-feedback="必填"
        v-bind:state="task.taskState"
      >
        <b-form-input
          id="task-input"
          v-model="task.addtaskName"
          v-bind:state="task.taskState"
          required
        ></b-form-input>
      </b-form-group>
    </form>
  </b-modal>
</template>
<script>
export default {
  mounted() {
    console.log("Modal component is ready");
  },
  data() {
    return {
      showModal: false,
      /*
        insert datas into table
      */
      task: {
        addtaskName: "",
        // taskState: null,
        // submittedNames: [],
        dateTimeStart: "",
        dateTimeEnd: "",
      },
    };
  },
  computed: {},
  methods: {
    toOpenModal: function () {
      if (this.taskEvents) {
        this.showModal = true;
      }
      console.log("open");
    },
    // onContext(ctx) {
    //   this.context = ctx;
    // },
    // 檢查input
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.taskState = valid;
      return valid;
    },
    // cancel
    resetModal() {
      this.task.addtaskName = "";
      this.task.taskState = null;
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
        this.submitData();
      }
      // this.$nextTick(() => {
      //   this.$bvModal.hide("modal-prevent-closing");
      // });
    },
    // save data
    submitData() {
      console.log(this.task);
      axios
        .post("api/item/store", {
          task: this.task,
        })
        .then((response) => {
          if (response.status === 201) {
            this.task.addtaskName = "";
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error.response.data);
        });
    },
  },
};
</script>