<template>
  <div class="error text-red-600 mt-2" v-if="formErrors">
    <span v-for="error in filteredErrors" v-if="error[0] !== ''">{{
      error[0]
    }}</span>
  </div>
</template>

<script>
export default {
  props: {
    formErrors: {
      type: Array,
      required: false,
    },
  },

  computed: {
    filteredErrors: function () {
      let newErrors = [];
      this.formErrors.forEach(function (error, key) {
        newErrors.push({ [key]: error });
      });
      return newErrors;
    },
  },
};
</script>
