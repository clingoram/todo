<template>
  <!-- Modal -->
  <b-modal
    id="modal-prevent-closing"
    ref="modal"
    title="新增代辦事項"
    @show="resetModal"
    @hidden="resetModal"
    @ok="handleOk"
  >
    <form ref="form" @submit.stop.prevent="handleOk">
      <b-form-group
        label="事項:"
        label-for="name-input"
        invalid-feedback="必填"
        :state="task.taskState"
      >
        <b-form-input
          id="name-input"
          v-model="task.addtaskName"
          :state="task.taskState"
          required
        ></b-form-input>
      </b-form-group>
    </form>
  </b-modal>
</template>
<script>
export default {
  mounted() {
    console.log("modal is ready");
  },
  data() {
    return {
      /*
        insert datas into table
      */
      task: {
        addtaskName: "",
        // taskState: null,
        // submittedNames: [],
        dateTime: "",
      },
    };
  },
  methods: {
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
    // 點擊日期開啟modal
    openModal() {
      console.log("method");
      // const getModalid = document.getElementById("modal-prevent-closing");
    },
    // save data
    submitData() {
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