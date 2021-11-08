/**
 * 把API統一放在這裡，方便管理
 */

// File:TaskModal、CategoryModal
// 檢查input
function checkFormValidity(todoTask) {
  const valid = this.$refs.form.checkValidity();
  this.todoTask.state = valid;
  return valid;
}
// 離開modal就清除input
function resetModal(todoTask) {
  this.todoTask.name = "";
  this.todoTask.start = "";
  this.todoTask.end = "";
  this.todoTask.state = null;
  this.todoTask.category = "";
  this.selected = null;
};
function handleOK() {

}

// TaskModal
// Create,to insert data.
function insertTask(todoTask, start, classification) {
  axios
    .post("api/items/", {
      todoTask: this.todoTask,
      start: this.start,
      classification: this.selected,
    })
    .then((response) => {
      if (response.status === 201) {
        confirm("新增成功!");
        window.location.reload();
      }
    })
    .catch((error) => {
      console.log(error.response.data);
    });
}
// Read,to get all category.
function getAllClassification(categoryOptions, myOptions) {
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
        this.myOptions.push(Object.assign({}, option));
      }
    })
    .catch((error) => {
      console.log(error);
    });

  return myOptions;
}