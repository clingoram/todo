<template>
  <!-- Modal -->
  <!-- <b-modal
    id="modal-prevent-closing"
    ref="modal"
    title="新增代辦事項"
    v-on:show="resetModal"
    v-on:hidden="resetModal"
    v-on:ok="handleOk"
  > -->
  <b-modal
    id="modal-prevent-closing"
    ref="my-modal"
    title="新增代辦事項"
    v-on:show="resetModal"
    v-on:hidden="resetModal"
    v-on:ok="handleOk"
    v-bind:class="show ? 'show' : ''"
    v-bind:style="show ? 'display:block;' : ''"
    aria-hidden="true"
  >
    <form ref="form" v-on:submit.stop.prevent="handleOk">
      <!-- 開始日期為在月曆上點擊到的日期 -->
      <b-form-group
        label="事項:"
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
        <!-- 結束日期需要另外自行填寫，預設為開始日期的一整天 -->
      </b-form-group>
    </form>
  </b-modal>
</template>
<script>
export default {
  mounted() {
    this.title = "";
    console.log("Modal component is ready");
  },
  props: {
    show: Boolean,
    save: Function,
    info: Object,
  },
  data() {
    return {
      title: "",
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