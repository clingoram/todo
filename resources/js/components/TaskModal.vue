<template>
  <!-- Modal -->
  <b-modal
    size="xl"
    id="modal-prevent-closing"
    title="待辦事項"
    v-model="showModal"
    v-bind:class="getAllClassification"
    v-on:hidden="resetModal"
    v-on:show="resetModal"
    v-on:ok="handleOk"
    modal-footer
  >
    <!-- <b-modal
    size="xl"
    id="modal-prevent-closing"
    title="待辦事項"
    v-model="showModal"
    v-bind:class="getAllClassification"
    v-on:show="resetModal"
    v-on:hidden="resetModal"
    v-on:ok="handleOk"
    modal-footer
  > -->
    <template #modal-footer="{ ok, cancel, deleteData }">
      <b-button lg="4" class="pb-2" variant="success" v-on:click="ok()"
        >儲存</b-button
      >
      <b-button
        lg="4"
        class="pb-2"
        variant="outline-primary"
        v-on:click="cancel()"
        >取消</b-button
      >
      <b-button
        lg="4"
        class="pb-2"
        variant="danger"
        v-on:click="deleteData(id)"
      >
        刪除
      </b-button>
    </template>

    <!-- <task-data></task-data> -->

    <form ref="form" v-on:submit.stop.prevent="handleSubmit">
      <label>{{ clickDateChecked }}</label>
      <br />
      <label for="startDate-datepicker">開始(24小時制):</label>
      <b-input-group class="mb-3">
        <b-form-input
          id="datestart-input"
          v-model.trim="todoTask.start"
          type="text"
          placeholder="YYYY-MM-DD HH:mm"
          autocomplete="off"
        ></b-form-input>

        <b-input-group-append>
          <b-form-datepicker
            id="startDate-datepicker"
            v-model="todoTask.start"
            v-bind:min="min"
            button-only
            right
            aria-controls="datestart-input"
          ></b-form-datepicker>
        </b-input-group-append>
      </b-input-group>

      <label for="endDate-datepicker">結束(24小時制):</label>
      <b-input-group class="mb-3">
        <b-form-input
          id="endDate-input"
          v-model.trim="todoTask.end"
          type="text"
          placeholder="YYYY-MM-DD HH:mm"
          autocomplete="off"
        ></b-form-input>
        <b-input-group-append>
          <b-form-datepicker
            id="endDate-datepicker"
            v-model="todoTask.end"
            v-bind:max="max"
            button-only
            right
            aria-controls="endDate-input"
          ></b-form-datepicker>
        </b-input-group-append>
      </b-input-group>

      <b-form-select v-model="selected" v-bind:options="myOptions">
        <template v-slot:first>
          <b-form-select-option :value="null" disabled
            >- 請選擇分類 -</b-form-select-option
          >
        </template>
      </b-form-select>

      <b-form-group
        label="待辦事項:"
        label-for="task-input"
        invalid-feedback="必填"
      >
        <b-form-input
          id="task-input"
          v-model.trim="todoTask.name"
          v-bind:state="todoTask.state"
          placeholder="輸入待辦事項"
          required
        ></b-form-input>
      </b-form-group>
    </form>
  </b-modal>
</template>
<script>
export default {
  props: ["id", "start", "end", "openmodal", "eventisset"],
  created() {
    this.getAllClassification();
  },
  data() {
    // modal calendar
    const now = new Date();
    const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

    // 1個月前又10天
    const minDate = new Date(today);
    minDate.setMonth(minDate.getMonth() - 1);
    minDate.setDate(10);

    // 1個月後又10天
    const maxDate = new Date(today);
    maxDate.setMonth(maxDate.getMonth() + 1);
    maxDate.setDate(20);

    return {
      // 是否顯示modal
      showModal: false,
      // 月曆，最小、最大可選日期
      min: minDate,
      max: maxDate,
      // 分類，下拉式選單
      selected: null,
      categoryOptions: [],
      myOptions: [],
      // 現有分類ID
      existCategoryId: [],
      /*
        儲存與顯示資料
      */
      todoTask: {
        id: this.id ? this.id : "",
        // 項目名稱
        name: this.name ? this.name : "",
        // 開始時間
        start: this.start ? this.start : "",
        // 結束時間
        end: this.end ? this.end : "",
        // classification: this.selected ? this.selected : "",
        // 狀態
        state: this.status,
      },
    };
  },
  computed: {
    // 檢查月曆上的日期是否有點擊
    clickDateChecked: function () {
      this.openmodal === true
        ? (this.showModal = true)
        : (this.showModal = false);

      // 若有ID，拿ID做搜尋以及確認是否有點擊到event
      if (this.id !== "" && this.eventisset === true) {
        this.getSpecificTask(this.id);
      } else {
        this.resetModal();
      }
      return this.start !== null ? this.start : "";
    },
  },
  methods: {
    // 檢查input
    checkFormValidity() {
      const valid = this.$refs.form.checkValidity();
      this.todoTask.state = valid;
      return valid;
    },
    // 離開modal就清除input
    resetModal() {
      this.todoTask.name = "";
      this.todoTask.start = "";
      this.todoTask.end = "";
      this.todoTask.state = null;
      this.todoTask.category = "";
      this.selected = null;
    },
    handleOk(bvModalEvt) {
      // Prevent modal from closing
      bvModalEvt.preventDefault();

      // Trigger submit handler
      this.handleSubmit();
    },
    handleSubmit() {
      // 沒有填上任何task就save
      if (!this.checkFormValidity()) {
        return;
      }
      this.$nextTick(() => {
        this.$bvModal.hide("modal-prevent-closing");
      });
      if (this.id === "" && this.eventisset === false) {
        this.insertTask();
      } else {
        this.updateData();
      }
    },
    // Insert
    insertTask() {
      // console.log(this.todoTask);
      // console.log(this.selected);
      if (this.myOptions.length === 0 || this.selected === null) {
        alert("請先新增分類!!");
      } else {
        axios
          .post("api/items/", {
            todoTask: this.todoTask,
            classificationSelected: this.selected,
          })
          .then((response) => {
            if (response.status === 201) {
              // this.resetModal();
              confirm("新增成功!");
              window.location.reload();
            }
          })
          .catch((error) => {
            console.log(error.response.data);
          });
      }
    },
    // Read
    // Get all categories
    getAllClassification: function () {
      axios
        .get("api/items/categories")
        .then((response) => {
          this.categoryOptions = response.data;
          for (let i = 0; i < this.categoryOptions.length; i++) {
            let option = [];
            for (var key in this.categoryOptions[i]) {
              if (key === "id") {
                option["value"] = this.categoryOptions[i][key];
              } else if (key === "name") {
                option["text"] = this.categoryOptions[i][key];
              }
            }
            // push存在的分類ID
            this.existCategoryId.push(option["value"]);
            // push顯示所有分類
            this.myOptions.push(Object.assign({}, option));
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
    // Get specific task
    getSpecificTask(id) {
      axios
        .get("api/items/" + this.id)
        .then((response) => {
          console.log(response);
          // this.todoTask.id = response.data.id;
          this.todoTask.name = response.data.description;
          this.todoTask.start = this.start;
          this.todoTask.end = this.end;
          this.todoTask.state = response.data.status ? false : true;

          // for (let i = 0; i < this.existCategoryId.length; i++) {
          // console.log(this.existCategoryId[i]);
          // this.selected =
          //   this.existCategoryId[i] !== response.data.cId
          //     ? [
          //         ...new Set(
          //           this.myOptions.push("分類已被刪除，請重新選擇!!")
          //         ),
          //       ]
          //     : response.data.cId;

          // this.selected =
          //   this.existCategoryId[i] !== response.data.cId
          //     ? "分類已被刪除，請重新選擇!!"
          //     : response.data.cId;
          // }
          this.selected = response.data.cId;
        })
        .catch((error) => {
          console.log("Error!!!");
          console.log(error.response.data);
        });
    },
    // Update
    updateData() {
      if (this.myOptions.length === 0 || this.selected === null) {
        alert("請先新增分類!!");
      } else {
        axios
          .put("api/items/" + this.id, {
            todoTask: this.todoTask,
            classification: this.selected,
          })
          .then((response) => {
            // console.log(response);
            if (response.status === 200) {
              // this.resetModal();
              confirm("儲存成功");
              window.location.reload();
            }
          })
          .catch((error) => {
            console.log(error.response.data);
          });
      }
    },
    // Delete
    deleteData(id) {
      axios
        .delete("api/items/" + id)
        .then((response) => {
          if (response.status === 200) {
            confirm("已刪除!");
            window.location.reload();
          }
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
};
</script>
<style scoped>
#modal-prevent-closing {
  background: black;
  color: white;
}
</style>