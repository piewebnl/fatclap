<template>
  <button @click="buttonClick()" :class="setClass(type)" :disabled="disable">
    <ion-icon :name="ionIcon" v-if="ionIcon"></ion-icon>
    <span v-if="title">{{ title }}</span>
  </button>
</template>

<script>
export default {
  props: {
    title: {
      type: String,
    },
    ionIcon: {
      type: String,
    },
    type: {
      type: String,
    },
    disable: {
      type: Boolean,
      default: false,
    },
  },
  methods: {
    buttonClick() {
      this.$emit("emitClicked", true);
    },
    setClass(type) {
      let color = "text-lg gray"; // default
      if (type == "save") {
        color = "green";
      }
      if (type == "delete") {
        color = "red";
      }
      return (
        "rounded-xl border text-" +
        color +
        "-600 border-" +
        color +
        "-600 my-4 p-4 bg-" +
        color +
        "-100"
      );
    },
  },
};
</script>
