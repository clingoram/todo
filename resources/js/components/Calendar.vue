<template>
  <div>
    <FullCalendar :options="calendarOptions" />

    <!-- Modal -->
    <modal
      v-if="showModal"
      :info="clickEvents.info"
      :show="showModal"
      :save="addEvent"
      @close="showModal = false"
    ></modal>
  </div>
</template>
<script>
// FullCalendar
import "@fullcalendar/core/vdom";
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import interactionPlugin from "@fullcalendar/interaction";
// click date to open modal to add new task.
import Modal from "./ModalInfo";

export default {
  components: {
    FullCalendar,
    Modal,
  },
  created() {
    this.getAlldatas();
  },
  // props: ["clickDate"],
  data() {
    return {
      showModal: false,
      clickEvents: { info: "" },
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
      /*
       FullCalendar
       */
      calendarOptions: {
        timeZone: "local",
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        dateClick: this.handleDateClick,
        eventClick: this.handleEventClick,
        events: [],
        // backgroundColor: "red",
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
    handleEventClick() {
      console.log("click");
      this.showModal = true;
    },
    /*  
    觸發modal
    並把點擊到的日期傳到modal
    */
    handleDateClick: function (arg) {
      // alert("點到了 " + arg.dateStr);

      // 日期
      this.dateTimeStart = arg.dateStr;
      // console.log(this.dateTimeStart);

      // 取第二個table內的tbody內的tr內的td的data-date(日期)
      // let findModalId = document
      //   .getElementsByClassName("fc-scrollgrid-sync-table")[0]
      //   .getAttribute("class");

      // let findModalId = $(".fc-scrollgrid-sync-table > tbody").children();

      // console.log(findModalId);
      // return this.clickDate;
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
      bvModalEvt.preventDefault();

      // 沒有填上任何task就save
      if (!this.checkFormValidity()) {
        return;
      } else {
        this.submitData();
      }
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
    // 取得table所有該月份的資料
    getAlldatas() {
      axios
        .get("api/item")
        .then((response) => {
          if (response.data.legth !== 0) {
            this.calendarOptions.events = response.data;
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
