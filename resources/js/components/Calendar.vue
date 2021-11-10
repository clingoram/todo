<template>
  <div>
    <FullCalendar v-bind:options="calendarOptions" v-bind:class="getAlldata" />

    <open-modal
      v-bind:id="todoTask.id"
      v-bind:start="todoTask.dateTimeStart"
      v-bind:end="todoTask.dateTimeEnd"
      v-bind:openmodal="modalOpen"
      v-bind:eventisset="checkEventIsset"
    ></open-modal>
  </div>
</template>
<script>
// FullCalendar
// import "@fullcalendar/core/vdom";
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
// import momentPlugin from "@fullcalendar/moment";
import interactionPlugin from "@fullcalendar/interaction";
// click date to open modal to add new task.
import OpenModal from "./TaskModal";

export default {
  components: {
    FullCalendar,
    OpenModal,
  },
  props: {
    id: {
      tpye: Number,
    },
    start: {
      type: String,
    },
    end: {
      type: String,
    },
    openmodal: {
      type: Boolean,
    },
    eventisset: {
      type: Boolean,
    },
  },
  data() {
    let weekDay = {
      Mon: "星期一",
      Tue: "星期二",
      Wed: "星期三",
      Thu: "星期四",
      Fri: "星期五",
      Sat: "星期六",
      Sun: "星期日",
    };
    let monthShort = {
      JAN: "1",
      FEB: "2",
      MAR: "3",
      APR: "4",
      May: "5",
      JUN: "6",
      JUL: "7",
      AUG: "8",
      SEP: "9",
      OCT: "10",
      NOV: "11",
      DEC: "12",
    };

    return {
      date: this.dateData,
      // modal
      modalOpen: this.openmodal,
      // 確認是點擊到event還是date，若是event，則顯示該event資訊(update);反之，則顯示新增待辦事項(insert)
      checkEventIsset: this.eventisset,
      todoTask: {
        id: this.id ? this.id : "",
        // 項目名稱
        title: this.title ? this.title : "",
        // 開始時間
        dateTimeStart: this.start ? this.start : "",
        // 結束時間
        dateTimeEnd: this.end ? this.end : "",
      },
      // Full calendar
      calendarOptions: {
        timeZone: "local",
        plugins: [dayGridPlugin, interactionPlugin],
        initialView: "dayGridMonth",
        events: [],
        // eventColor: "antiquewhite",
        // eventTextColor: "#000000",
        // 事件顯示時間格式
        eventTimeFormat: {
          hour: "2-digit",
          minute: "2-digit",
          second: "2-digit",
          hour12: false,
        },
        dateClick: function (arg) {
          this.modalOpen = true;
          this.checkEventIsset = false;
          this.todoTask.dateTimeStart = arg.date.toString();
          this.todoTask.dateTimeEnd = arg.date.toString();
          // this.todoTask.dateTimeStart = arg.dateStr;
        }.bind(this),
        eventClick: function (info) {
          if (info.event.id !== "") {
            this.modalOpen = true;
            this.checkEventIsset = true;
            this.todoTask.id = info.event.id;
            // remove part of datetime
            for (var key in monthShort) {
              if (monthShort[info.event.start.getMonth()]) {
                console.log(monthShort[key]);
              }
            }
            // console.log(info.event.start.getMonth());
            this.todoTask.dateTimeStart = info.event.start.toDateString();

            this.todoTask.dateTimeEnd = info.event.end.toDateString(); //.toString();

            // const findStrPosition = info.event.startStr.indexOf("T");
            // this.todoTask.dateTimeStart = info.event.startStr.substr(
            //   0,
            //   findStrPosition
            // );
          }
        }.bind(this),
      },
    };
  },
  computed: {
    // 取得table所有該月份的資料
    getAlldata: {
      // 讀取
      get() {
        axios
          .get("api/items")
          .then((response) => {
            if (response.data.legth !== 0) {
              this.calendarOptions.events = response.data;
              // this.$emit("changedata");
            }
          })
          .catch((error) => {
            console.log(error);
          });
      },
      // 寫入
      set(value) {
        return (this.calendarOptions.events = value);
      },
    },
  },
  watch: {},
};
</script>