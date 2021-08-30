<template>
  <div>
    <FullCalendar :options="calendarOptions" />

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
  </div>
</template>
<script>
// FullCalendar
import "@fullcalendar/core/vdom";
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
// click date to open modal to add new task.
// import Modal from "./ModalInfo";

export default {
  components: {
    FullCalendar,
    // Modal,
  },
  created() {
    this.getAlldatas();
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
      /*
        getAlldatas()的all datas
      */
      // item_data: [],
      /*
       FullCalendar
       */
      calendarOptions: {
        timeZone: "local",
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        dateClick: this.handleDateClick,
        // 要把getAlldatas()的資料塞進這個events，才能顯示在calendar
        events: [],
        // eventSources: [
        //   {
        //     url: "api/item",
        //     method: "GET",
        //     dataType: "JSON",
        //     color: "#65a9d7",
        //     textColor: "#3c3d3d",
        //     data: {
        //       start: "start",
        //       end: "end",
        //       id: "id",
        //       title: "title",
        //     },
        //     success: function (response) {
        //       // response type is object
        //       // let toArray = JSON.stringify(response);
        //       // let events = [];
        //       // events.push({
        //       //   title: toArray.description,
        //       // });
        //     },
        //     failure: function (err) {
        //       alert(err);
        //     },
        //   },
        // ],
      },
    };
  },
  methods: {
    // 取得table所有該月份的資料
    getAlldatas() {
      axios
        .get("api/item")
        .then((response) => {
          if (response.data.legth !== 0) {
            this.calendarOptions.events = response.data;
            // console.log(this.calendarOptions.events);
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    handleDateClick: function (arg) {
      alert("點到了 " + arg.dateStr);
    },
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
    // openModal() {
    //   console.log("method");
    //   // const getModalid = document.getElementById("modal-prevent-closing");
    // },
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
