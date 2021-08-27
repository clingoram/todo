<template>
  <div>
    <b-row>
      <b-col md="auto">
        <b-calendar
          block
          :date-info-fn="dateClass"
          :start-weekday="weekday"
          locale="local"
          :min="min"
          :max="max"
          v-model="task.dateTime"
          @context="onContext"
        ></b-calendar>
      </b-col>
      <modal></modal>
      <!-- <button v-on:click="openModal()">Go</button> -->

      <!-- <b-col md="auto">
        <b-calendar
          v-model="task.value"
          @context="onContext"
          block
          locale="en-US"
          v-b-modal.modal-prevent-closing
        ></b-calendar>
      </b-col> -->

      <!-- Modal -->
      <!-- <b-modal
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
      </b-modal> -->

      <!-- <more-info></more-info> -->
    </b-row>
  </div>
</template>
<script>
// import Modalinfo from "./MoreInfo";

import Modal from "./ModalInfo";

export default {
  mounted() {
    console.log("calendar");
  },
  created() {
    this.getAlldatas();
  },
  components: {
    Modal,
  },
  // props: ["dateValue"],
  data() {
    /**
     * 設定月曆能顯示的最小日期和最大日期
     */
    const now = new Date();
    const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());
    // min
    const minDate = new Date(today);
    minDate.setMonth(minDate.getMonth() - 1);
    minDate.setDate(5);
    // max
    const maxDate = new Date(today);
    maxDate.setMonth(maxDate.getMonth() + 2);
    maxDate.setDate(5);
    return {
      /* 
        calendar set
      */

      local: "zh-TW",
      weekday: 0,
      context: null,
      min: minDate,
      max: maxDate,
      /*
        insert datas into table
      */
      task: {
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
  },
  methods: {
    onContext(ctx) {
      this.context = ctx;
      // let getID = document.getElementsByClassName("col p-0 table-info");
      // let getRole = $(this).attr("role");
      // if (getRole === "button") {
      //   this.openModal();
      // }
    },
    // // 檢查input
    // checkFormValidity() {
    //   const valid = this.$refs.form.checkValidity();
    //   this.taskState = valid;
    //   return valid;
    // },
    // // cancel
    // resetModal() {
    //   this.task.addtaskName = "";
    //   this.task.taskState = null;
    // },
    // handleOk(bvModalEvt) {
    //   // Prevent modal from closing
    //   bvModalEvt.preventDefault();
    //   // Trigger submit handler
    //   // this.handleSubmit();

    //   // 沒有填上任何task就save
    //   if (!this.checkFormValidity()) {
    //     return;
    //   } else {
    //     this.submitData();
    //   }
    //   // this.$nextTick(() => {
    //   //   this.$bvModal.hide("modal-prevent-closing");
    //   // });
    // },
    /* 
    css style
    要取得table created_at時間，並在該日期 mark
    */
    dateClass(ymd, date) {
      const day = date.getDate();
      return day >= 10 && day <= 20 ? "table-info" : "";
    },
    // 點擊日期開啟modal
    // openModal() {
    //   let getID = document.getElementById("__BVID__5__cell-2021-08-20_");
    //   let getRole = getID.getAttribute("role");
    //   if (getRole === "button") {
    //     console.log("method");
    //   }
    //   // const getModalid = document.getElementById("modal-prevent-closing");
    // },
    // 取得table所有該月份的資料
    getAlldatas() {
      axios
        .get("api/item")
        .then((response) => {
          this.item_data = response.data;
          console.log(this.item_data);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // save data
    // submitData() {
    //   axios
    //     .post("api/item/store", {
    //       task: this.task,
    //     })
    //     .then((response) => {
    //       if (response.status === 201) {
    //         this.task.addtaskName = "";
    //         this.$emit("reloadlist");
    //       }
    //     })
    //     .catch((error) => {
    //       console.log(error.response.data);
    //     });
    // },

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