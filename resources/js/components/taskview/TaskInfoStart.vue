<template>
  <div>
    <label for="startDate-datepicker">開始:</label>
    <b-input-group class="mb-3">
      <b-form-input
        id="datestart-input"
        v-model="todoTask.start"
        type="text"
        placeholder="YYYY-MM-DD"
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
  </div>
</template>