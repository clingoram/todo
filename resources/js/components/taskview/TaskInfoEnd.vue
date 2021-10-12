<template>
  <div>
    <label for="endDate-datepicker">結束:</label>
    <b-input-group class="mb-3">
      <b-form-input
        id="endDate-input"
        v-model="todoTask.end"
        type="text"
        placeholder="YYYY-MM-DD"
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

    <b-form-group
      label="待辦事項:"
      label-for="task-input"
      invalid-feedback="必填"
    >
      <b-form-input
        id="task-input"
        v-model="todoTask.name"
        v-bind:state="todoTask.state"
        placeholder="輸入待辦事項"
        required
      ></b-form-input>
    </b-form-group>
  </div>
</template>