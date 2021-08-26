<template>
  <div>
    <b-row>
      <b-col md="auto">
        <b-calendar
          block
          :date-info-fn="dateClass"
          :start-weekday="weekday"
          locale="local"
          v-model="item.dateTime"
          v-b-modal.modal-prevent-closing
        ></b-calendar>
      </b-col>

      <!-- <b-col md="auto">
        <b-calendar
          v-model="item.value"
          @context="onContext"
          block
          locale="en-US"
          v-b-modal.modal-prevent-closing
        ></b-calendar>
      </b-col> -->

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
            :state="item.taskState"
          >
            <b-form-input
              id="name-input"
              v-model="item.addtaskName"
              :state="item.taskState"
              required
            ></b-form-input>
          </b-form-group>
        </form>
      </b-modal>

      <!-- <p>
        Value: <b>'{{ item.dateTime }}'</b>
      </p>
      <p class="mb-0">Context:</p>
      <pre class="small">{{ context }}</pre> -->

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
// import Modalinfo from "./MoreInfo";
export default {
  mounted() {
    console.log("calendar");
  },
  // components: {
  //   Modalinfo,
  // },
  // props: ["dateValue"],
  data() {
    return {
      /* 
        calendar set
      */
      local: "zh-TW",
      weekday: 0,
      context: null,
      /*
        insert datas into table
      */
      item: {
        addtaskName: "",
        // taskState: null,
        // submittedNames: [],
        dateTime: "",
      },
      /* 
        取得table所有資料，並標示在月曆上
      */
      each_item_data: [],
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
      this.item.addtaskName = "";
      this.item.taskState = null;
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
    /* 
    css style
    要取得table created_at時間，並在該日期 mark
    */
    dateClass(ymd, date) {
      const day = date.getDate();
      return day >= 10 && day <= 20 ? "table-info" : "";
    },
    // 取得table所有資料
    getAlldatas() {
      axios
        .get("api/item")
        .then((response) => {
          this.item_data = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // save data
    submitData() {
      // const date = new Date();
      // console.log(`項目名稱: ${this.item.addtaskName}`);
      // console.log(`項目時間: ${this.item.dateTime}`);
      axios
        .post("api/item/store", {
          itemName: this.item.addtaskName,
          createdTime: this.item.dateTime,
        })
        .then((response) => {
          if (response.status === 201) {
            this.item.addtaskName = "";
            this.$emit("reloadlist");
          }
        })
        .catch((error) => {
          console.log(error.response.data);
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