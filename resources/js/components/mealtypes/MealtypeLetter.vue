<template>
  <span class="mealtype-letter" :style="`background-color: ${color}`">{{
    letter
  }}</span>
</template>

<script>
export default {
  props: {
    letter: {
      type: String,
      required: true,
      default: "",
    },
    color: {
      type: String,
      required: false,
    },
  },
};
</script>



